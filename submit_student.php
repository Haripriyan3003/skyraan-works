<?php
$user = 'root';
$pass = '';
$db = 'students';

// Connect to the database
$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get student details from the form
    $stud_name = $_POST['name'];
    $stud_email_id = $_POST['email_id'];
    $stud_address = $_POST['address'];
    $stud_phone_no = $_POST['phone_no'];

    // Insert into students table (assuming Stud_id is auto-increment)
    $sql = "INSERT INTO students (name, email_id, address, phone_no) 
             VALUES ('$stud_name', '$stud_email_id', '$stud_address', '$stud_phone_no')";
    $result = $connection->query($sql);

    if ($result) {
        $student_id = $connection->insert_id; // Get the ID of the last inserted record

        // Get education details from the form
        $education_qualification = $_POST['eduction_qualification'];
        $institute_Name = $_POST['instute_Name'];
        $year_of_passing = $_POST['year_of_passing'];
        $percentage = $_POST['percentage'];

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
                echo "Error: " . $sql . "<br>" . $connection->error;
                exit;
            }
        }
          echo '<script> alert("Data inserted successfully!!!");  </script>'; 
         echo '<script>window.location.href ="new_task.php" ;</script>';
        // Redirect after successful submission
       // header("Location: new_task.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
?>

