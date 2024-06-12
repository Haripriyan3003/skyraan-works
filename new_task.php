<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Student details</title>
</head>
<body>
    <div class="container">
        <h1>Student Details</h1>
        <form id="studentForm" method="post" action="submit_student.php">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"  >
                <div id="nameError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="email_id" class="form-label">Email ID</label>
                <input type="email" class="form-control" name="email_id" id="email_id"  >
                <div id="emailError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" >
                <div id="addressError" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_no" id="phone_no" >
                <div id="phoneError" class="invalid-feedback"></div>
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
                    <tr>
                        <td>
                            <input type="text" class="form-control education-input" name="eduction_qualification[]" >
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control education-input" name="instute_Name[]" >
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <input type="date" class="form-control education-input" name="year_of_passing[]" >
                            <div class="invalid-feedback"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control education-input" name="percentage[]" >
                            <div class="invalid-feedback"></div>
                        </td>
                        <td><button type="button" class="btn btn-secondary education-input" id="addEducationRow">Add</button></td>
                    </tr>
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
                          <input type="text" class="form-control education-input" name="eduction_qualification[]"  >
                          <div class="invalid-feedback"></div>
                    </td>
                    <td>
                         <input type="text" class="form-control education-input" name="instute_Name[]" >
                         <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="date" class="form-control education-input" name="year_of_passing[]" >
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                         <input type="text" class="form-control education-input" name="percentage[]"  >
                         <div class="invalid-feedback"></div>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
                </tr>`;
                $('#educationTable tbody').append(newRow);
            });
           
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Email validation
            $('#email_id').on('input', function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    $('#emailError').text('Invalid email address');
                    $(this).addClass('is-invalid');
                } else {
                    $('#emailError').text('');
                    $(this).removeClass('is-invalid');
                }
            });

            // Phone number validation
            $('#phone_no').on('input', function() {
                var phone = $(this).val();
                var phoneRegex = /^\d{10}$/;
                if (!phoneRegex.test(phone)) {
                    $('#phoneError').text('Invalid phone number');
                    $(this).addClass('is-invalid');
                } else {
                    $('#phoneError').text('');
                    $(this).removeClass('is-invalid');
                }
            });

            $('#name, #address').on('blur', function() {
                var value = $(this).val();
                if (value.trim() === '') {
                    $(this).addClass('is-invalid');
                    var fieldName = $(this).prev('label').text();
                    $('#' + $(this).attr('id') + 'Error').text(fieldName + ' is required');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#' + $(this).attr('id') + 'Error').text('');
                }
            });

            // Department, Institute Name, Year of Passing, and Percentage validation
            $(document).on('blur', '.education-input', function() {
                var value = $(this).val();
                if (value.trim() === '') {
                    $(this).addClass('is-invalid');
                    $(this).next('.invalid-feedback').text('This field is required');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').text('');
                }
            });

            $('#studentForm').on('submit', function(event) {
                var isValid = true;

                // Check all required fields
                $('#studentForm input').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('is-invalid');
                        var fieldName = $(this).prev('label').text() || $(this).closest('td').prev('th').text();
                        $(this).next('.invalid-feedback').text(fieldName + ' is required');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').text('');
                    }
                });

                // Prevent form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
