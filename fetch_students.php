<?php
$servername = "localhost";
$username = "root"; // use your MySQL username
$password = ""; // use your MySQL password
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['stud_id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email_id'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>" . $row['phone_no'] . "</td>
                <td>
                    <button class='btn btn-danger delete-btn' data-id='" . $row['stud_id'] . "'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No students found</td></tr>";
}

$conn->close();
?>
