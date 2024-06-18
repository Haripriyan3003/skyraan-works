<?php
$user = 'root';
$pass = '';
$db = 'students';

$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");
$results_per_page = 10;

if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    $starting_limit = ($page - 1) * $results_per_page;

    $sql_students = "SELECT * FROM students LIMIT $starting_limit, $results_per_page";
    $result_students = $connection->query($sql_students);

    $students = [];
    while ($row = $result_students->fetch_assoc()) {
        $students[] = $row;
    }
    
    echo json_encode($students);
    exit;
}

if (isset($_POST['ajax']) && $_POST['ajax'] == 1 && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $student_id = isset($_POST['student_id']) && is_numeric($_POST['student_id']) ? $_POST['student_id'] : 0;

    if ($student_id) {
        // Begin transaction
        $connection->begin_transaction();

        try {
            // Delete the education records for the student
            $sql_education = "DELETE FROM eductions WHERE student_id = $student_id";
            if ($connection->query($sql_education) !== TRUE) {
                throw new Exception("Error deleting education records: " . $connection->error);
            }

            // Delete the student record
            $sql_student = "DELETE FROM students WHERE stud_id = $student_id";
            if ($connection->query($sql_student) !== TRUE) {
                throw new Exception("Error deleting student record: " . $connection->error);
            }

            // Commit the transaction
            $connection->commit();
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $connection->rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid student ID.']);
    }
    exit;
}

// For the initial page load
$sql_total = "SELECT COUNT(*) AS total FROM students";
$result_total = $connection->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_results = $row_total['total'];
$total_pages = ceil($total_results / $results_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Student Management System</title>
</head>
<body>
<center>
    <h2>Student Management System</h2>
</center>
<br>
<h3>Student Details</h3>
<button class="btn btn-success"><a href="new_task.php" style="text-decoration: none; color: inherit;">New Student</a></button>

<table class="table" id="studentTable">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email ID</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="studentData">
        <!-- Initial data will be loaded here via JavaScript -->
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination" id="pagination">
        <!-- Pagination links will be dynamically added here -->
    </ul>
</nav>

<script>
    let currentPage = 1;
    const resultsPerPage = 10;
    const totalResults = <?php echo $total_results; ?>;
    const totalPages = Math.ceil(totalResults / resultsPerPage);

    document.addEventListener('DOMContentLoaded', (event) => {
        loadMoreData(currentPage);

        window.addEventListener('scroll', () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadMoreData(currentPage);
                }
            }
        });
    });

    function loadMoreData(page) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `student_management.php?ajax=1&page=${page}`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                appendDataToTable(data);
            }
        };
        xhr.send();
    }

    function appendDataToTable(data) {
        const tableBody = document.getElementById('studentData');
        data.forEach(student => {
            const row = document.createElement('tr');
            row.id = `student-${student.stud_id}`;
            row.innerHTML = `
                <td>${student.stud_id}</td>
                <td>${student.name}</td>
                <td>${student.email_id}</td>
                <td>${student.address}</td>
                <td>${student.phone_no}</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='./student_works/edit.php?id=${student.stud_id}'>Update</a>
                    <button class='btn btn-danger btn-sm' onclick='confirmDelete(${student.stud_id})'>Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function confirmDelete(studentId) {
        const result = confirm("Are you sure you want to delete this student?");
        if (result) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'student_management.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert('Student deleted successfully.');
                        document.getElementById(`student-${studentId}`).remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            };
            xhr.send(`ajax=1&action=delete&student_id=${studentId}`);
        }
    }
</script>

</body>
</html>
