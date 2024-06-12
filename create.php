<?php
$user = 'root';
$pass = '';
$db = 'students';

// Connect to the database
$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
       // Get student details from the form
       $student_id = $_POST['student_id'];
       $stud_name = $_POST['stud_name'];
       $stud_email_id = $_POST['stud_email_id'];
        $stud_address = $_POST['stud_address'];
       $stud_phone_no = $_POST['stud_phone_no'];

  // Get education details from the form

  $education_qualification = $_POST['education_qualification'];
  $institute_name = $_POST['institute_name'];
  $year_of_passing = $_POST['year_of_passing'];
  $percentage = $_POST['percentage'];
  
  // ... (your existing code up to form submission)
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (get student details)
  
    // Insert into students_details table (assuming Stud_id is auto-increment)
    $sql = "INSERT INTO students (name, email_id, address, phone_no) 
             VALUES ('$stud_name', '$stud_email_id', '$stud_address', '$stud_phone_no')";
    $result = $connection->query($sql);
  
    if ($result)
     {
         $student_id = $connection->insert_id; // Get the ID of the last inserted record
   
         // Insert into education_details table using the retrieved student ID
         $sql = "INSERT INTO eductions (student_id, eduction_qualification, instute_Name, year_of_passing, percentage) 
               VALUES ('$student_id', '$education_qualification', '$institute_name', '$year_of_passing', '$percentage')";
         $result = $connection->query($sql);
     }
      if ($result) {
        // Redirect after successful submission
        header("Location: index.php");
        exit;
      } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
      }
    } else {
      echo "Error: " . $sql . "<br>" . $connection->error;
    }
  }

  ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
  <h2>Create Student</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <div class="form-group">
      <label for="student_id">Student ID</label>
      <input type="text" class="form-control" id="stud_id" name="student_id" >
    </div>

    <div class="form-group">
      <label for="stud_name">Name</label>
      <input type="text" class="form-control" id="stud_name" name="stud_name" required>
    </div>

    <div class="form-group">
      <label for="stud_email_id">Email ID</label>
      <input type="email" class="form-control" id="stud_email_id" name="stud_email_id" required>
    </div>

    <div class="form-group">
      <label for="stud_address">Address</label>
      <input type="text" class="form-control" id="stud_address" name="stud_address" required>
    </div>

    <div class="form-group">
      <label for="stud_phone_no">Phone Number</label>
      <input type="tel" class="form-control" id="stud_phone_no" name="stud_phone_no" required>
    </div>

    <div class="form-group">
      <label for="education_qualification">Education Qualification</label>
      <input type="text" class="form-control" id="education_qualification" name="education_qualification" required>
    </div>

    <div class="form-group">
      <label for="institute_name">Institute Name</label>
      <input type="text" class="form-control" id="institute_name" name="institute_name" required>
    </div>

    <div class="form-group">
      <label for="year_of_passing">Year of Passing</label>
      <input type="date" class="form-control" id="year_of_passing" name="year_of_passing" required>
    </div>

    <div class="form-group">
      <label for="percentage">Percentage</label>
      <input type="text" class="form-control" id="percentage" name="percentage" required>
    </div>

    <br>
    <button type="submit" class="btn btn-primary">Create Student</button>
  </form>
</div>

</body>
</html>
