<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Oswald:300,400,500|PT+Sans+Narrow:400,700|Play:400,700|Ubuntu+Condensed&display=swap&subset=cyrillic');



ul, li {
list-style: none;
}


.breadcrumb {
display: flex;
border-radius: 10px;
margin-left:30px;
margin-top:30px;
top: 50%;
width: 100%;
height: 40px;
transform: translateY(-50%);
z-index: 1;
}


.breadcrumb__item {
height: 100%;
background-color: white;
color: #252525;
font-family: 'Oswald', sans-serif;
border-radius: 7px;
letter-spacing: 1px;
transition: all 0.3s ease;
text-transform: uppercase;
position: relative;
display: inline-flex;
justify-content: center;
align-items: center;
font-size: 16px;
transform: skew(-21deg);
box-shadow: 0 2px 5px rgba(0,0,0,0.26);
margin: 5px;
padding: 0 40px;
cursor: pointer;
}


.breadcrumb__item:hover {
background: #490099;
color: #FFF;
}


.breadcrumb__inner {
display: flex;
flex-direction: column;
margin: auto;
z-index: 2;
transform: skew(21deg);  
}

.breadcrumb__title {
font-size: 16px;
text-overflow: ellipsis;  
overflow: hidden;
white-space: nowrap;  
}


@media all and (max-width: 1000px) {
.breadcrumb {
height: 35px;
}

.breadcrumb__title{
font-size: 11px;
}
.breadcrumb__item {
padding: 0 30px;
}
}

@media all and (max-width: 710px) {
.breadcrumb {
height: 30px;
}
.breadcrumb__item {
padding: 0 20px;
}

}
    </style>
    <title>Student details</title>
</head>
<body>
<div class="container">
<ul class="breadcrumb">
<li class="breadcrumb__item breadcrumb__item-firstChild">
<span class="breadcrumb__inner">
<span class="breadcrumb__title"><a  style="text-decoration: none; color: inherit;" href="student_management.php">Home </a></span>
</span>
</li>
<li class="breadcrumb__item">
<span class="breadcrumb__inner">
<span class="breadcrumb__title">New Student</span>
</span>
</li>


</ul>
</div>

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

 

   
    
</body>
</html>
