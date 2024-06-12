<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>






<?php
$user = 'root';
$pass = '';
$db = 'students';

$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");

// Fetch student details
$sql_students = "SELECT * FROM students";
$result_students = $connection->query($sql_students);

// Fetch education details
$sql_education = "SELECT * FROM eductions";
$result_education = $connection->query($sql_education);
?>

<div class="container my-5">
  <h2>Student Management System</h2>
  <a class="btn btn-primary" role="button" href="create.php">New Student</a>
  <br>
  <h3>Student Details</h3>
  <table class="table">
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

    <tbody>
      <?php while ($row = $result_students->fetch_assoc()) {?>
      <tr>
        <td><?php echo $row['stud_id'];?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['email_id'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['phone_no'];?></td>
        <td>
          <a class='btn btn-primary btn-sm' href='edit.php?id=<?php echo $row['stud_id'];?>'>Edit</a>
          <a class='btn btn-danger btn-sm' href='delete.php?id=<?php echo $row['stud_id'];?>'>Delete</a>
        </td>
      </tr>

           



      <?php }?>

    </tbody>
  
  </table>




 <!--
  <h3>Education Details</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>	Eduction_qualification</th>
        <th>Instute_Name</th>
        <th>Percentage</th>
        <th>Year of passing</th>
      </tr>
    </thead>
    <tbody>
      <?php /* while ($row = $result_education->fetch_assoc()) {?>
      <tr>
        <td><?php echo $row['Stud_id'];?></td>
        <td><?php echo $row['Eduction_qualification'];?></td>
        <td><?php echo $row['Instute_Name'];?></td>
        <td><?php echo $row['Year_of_passing'];?></td>
        <td><?php echo $row['percentage'];?></td>
      </tr>
      --> 
      <?php }
      */ 
      
      ?> -->
    </tbody>
  </table>
</div>



</body>
</html>
