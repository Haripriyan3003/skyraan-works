<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Student details</title>
</head>
<body>
    <header>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">new Student</li>
  </ol>
</nav>
    </header>

    <div class="container">
        <h1>Student Details</h1>
        <form id="studentForm" method="post" action="submit_student.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?php echo isset($stud_name) ? $stud_name : ''; ?>">
                <div id="nameError" class="invalid-feedback"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></div>
            </div>
            <div class="mb-3">
                <label for="email_id" class="form-label">Email ID</label>
                <input type="email" class="form-control <?php echo isset($errors['email_id']) ? 'is-invalid' : ''; ?>" name="email_id" id="email_id" value="<?php echo isset($stud_email_id) ? $stud_email_id : ''; ?>">
                <div id="emailError" class="invalid-feedback"><?php echo isset($errors['email_id']) ? $errors['email_id'] : ''; ?></div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" name="address" id="address" value="<?php echo isset($stud_address) ? $stud_address : ''; ?>">
                <div id="addressError" class="invalid-feedback"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></div>
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control <?php echo isset($errors['phone_no']) ? 'is-invalid' : ''; ?>" name="phone_no" id="phone_no" value="<?php echo isset($stud_phone_no) ? $stud_phone_no : ''; ?>">
                <div id="phoneError" class="invalid-feedback"><?php echo isset($errors['phone_no']) ? $errors['phone_no'] : ''; ?></div>
            </div>

            <h2>Education Details</h2>
            <table class="table table-bordered" id="educationTable">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Institute Name</th>
                        <th>Year of Passing</th>
                        <th>Percentage</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($education_qualification)) {
                        foreach ($education_qualification as $index => $edu_qual) {
                            $inst_name = isset($institute_Name[$index]) ? $institute_Name[$index] : '';
                            $year_pass = isset($year_of_passing[$index]) ? $year_of_passing[$index] : '';
                            $perc = isset($percentage[$index]) ? $percentage[$index] : '';
                            ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control <?php echo isset($errors["eduction_qualification_$index"]) ? 'is-invalid' : ''; ?>" name="eduction_qualification[]" value="<?php echo $edu_qual; ?>">
                                    <div class="invalid-feedback"><?php echo isset($errors["eduction_qualification_$index"]) ? $errors["eduction_qualification_$index"] : ''; ?></div>
                                </td>
                                <td>
                                    <input type="text" class="form-control <?php echo isset($errors["instute_Name_$index"]) ? 'is-invalid' : ''; ?>" name="instute_Name[]" value="<?php echo $inst_name; ?>">
                                    <div class="invalid-feedback"><?php echo isset($errors["instute_Name_$index"]) ? $errors["instute_Name_$index"] : ''; ?></div>
                                </td>
                                <td>
                                    <input type="date" class="form-control <?php echo isset($errors["year_of_passing_$index"]) ? 'is-invalid' : ''; ?>" name="year_of_passing[]" value="<?php echo $year_pass; ?>">
                                    <div class="invalid-feedback"><?php echo isset($errors["year_of_passing_$index"]) ? $errors["year_of_passing_$index"] : ''; ?></div>
                                </td>
                                <td>
                                    <input type="text" class="form-control <?php echo isset($errors["percentage_$index"]) ? 'is-invalid' : ''; ?>" name="percentage[]" value="<?php echo $perc; ?>">
                                    <div class="invalid-feedback"><?php echo isset($errors["percentage_$index"]) ? $errors["percentage_$index"] : ''; ?></div>
                                </td>
                                <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="eduction_qualification[]">
                                <div class="invalid-feedback"></div>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="instute_Name[]">
                                <div class="invalid-feedback"></div>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="year_of_passing[]">
                                <div class="invalid-feedback"></div>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="percentage[]">
                                <div class="invalid-feedback"></div>
                            </td>
                            <td><button type="button" class="btn btn-secondary" id="addEducationRow">Add</button></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addEducationRow').click(function() {
                var newRow = `<tr>
                    <td>
                        <input type="text" class="form-control" name="eduction_qualification[]">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="instute_Name[]">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="date" class="form-control" name="year_of_passing[]">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="percentage[]">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
                </tr>`;
                $('#educationTable tbody').append(newRow);
            });
            
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

    <div class="container my-5">
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

    <h2>Student Management System</h2>
     
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
            <?php while ($row = $result_students->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['stud_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email_id']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td>
                    <a class='btn btn-primary btn-sm' href='edit.php?id=<?php echo $row['stud_id']; ?>'>Update</a>
                    <a class='btn btn-danger btn-sm' href='delete.php?id=<?php echo $row['stud_id']; ?>'>Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
