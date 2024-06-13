<?php
$user = 'root';
$pass = '';
$db = 'students';

// Connect to the database
$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get student details from the form
    $stud_name = $_POST['name'];
    $stud_email_id = $_POST['email_id'];
    $stud_address = $_POST['address'];
    $stud_phone_no = $_POST['phone_no'];

    // Validate student details
    if (empty($stud_name)) {
        $errors['name'] = 'Name is required';
    }
    if (empty($stud_email_id) || !filter_var($stud_email_id, FILTER_VALIDATE_EMAIL)) {
        $errors['email_id'] = 'Valid email ID is required';
    }
    if (empty($stud_address)) {
        $errors['address'] = 'Address is required';
    }
    if (empty($stud_phone_no) || !preg_match('/^\d{10}$/', $stud_phone_no)) {
        $errors['phone_no'] = 'Valid phone number is required';
    }

    // Get education details from the form
    $education_qualification = $_POST['eduction_qualification'];
    $institute_Name = $_POST['instute_Name'];
    $year_of_passing = $_POST['year_of_passing'];
    $percentage = $_POST['percentage'];

    // Validate education details
    foreach ($education_qualification as $index => $value) {
        if (empty($value)) {
            $errors["eduction_qualification_$index"] = 'Education qualification is required';
        }
        if (empty($institute_Name[$index])) {
            $errors["instute_Name_$index"] = 'Institute Name is required';
        }
        if (empty($year_of_passing[$index])) {
            $errors["year_of_passing_$index"] = 'Year of Passing is required';
        }
        if (empty($percentage[$index])) {
            $errors["percentage_$index"] = 'Percentage is required';
        }
    }

    // If there are errors, output them and stop the script
    if (!empty($errors)) {
        include 'new_task.php';
        exit;
    }

    // Insert into students table
    $sql = "INSERT INTO students (name, email_id, address, phone_no) VALUES ('$stud_name', '$stud_email_id', '$stud_address', '$stud_phone_no')";
    $result = $connection->query($sql);

    if ($result) {
        $student_id = $connection->insert_id; // Get the ID of the last inserted record

        // Loop through the education details and insert them into the eductions table
        for ($i = 0; $i < count($education_qualification); $i++) {
            $edu_qual = $education_qualification[$i];
            $inst_name = $institute_Name[$i];
            $year_pass = $year_of_passing[$i];
            $perc = $percentage[$i];

            $sql = "INSERT INTO eductions (student_id, eduction_qualification, instute_Name, year_of_passing, percentage) 
                    VALUES ('$student_id', '$edu_qual', '$inst_name', '$year_pass', '$perc')";
            $result = $connection->query($sql);

            if (!$result) {
                $errors['database'] = $connection->error;
                include 'new_task.php';
                exit;
            }
        }

        // Redirect after successful submission
        echo '<script>alert("Data inserted successfully!!!");</script>'; 
        echo '<script>window.location.href="new_task.php";</script>';
        exit;
    } else {
        $errors['database'] = $connection->error;
        include 'new_task.php';
    }
} else {
    $errors['request'] = 'Invalid request method';
    include 'new_task.php';
}
?>
