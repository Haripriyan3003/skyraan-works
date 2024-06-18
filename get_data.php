<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
     crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form id="dataForm" method="POST" enctype="multipart/form-data">
            <h1>Fill the Details</h1>
            <div class="input-group mb-3">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" required>
            </div>
            <div class="input-group mb-3">
                <label class="form-label" for="image">Image</label>
                <input class="form-control" type="file" id="image" name="image" required>
            </div>
            <div class="input-group mb-3">
                <label class="form-label" for="url"> portfolio link</label>
                <input class="form-control" type="url" id="url" name="url" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('dataForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = document.getElementById('dataForm');
            const formData = new FormData(form);

            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                alert(data);
                form.reset(); // Reset form fields after submission
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
