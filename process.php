<?php
$user = "root";
$pass = '';
$db = "portfolio details"; // corrected the space in database name

$connection = new mysqli('localhost', $user, $pass, $db) or die("Problem in database connection");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer_name = $_POST['name'];
    $portfolioURL = $_POST['url'];

    // File upload path
    $targetDir = "C:/xampp/htdocs/uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $sql = "INSERT INTO customers (customer_name, image_path, portfolio_link) 
                    VALUES ('$customer_name', '$targetFilePath', '$portfolioURL')";
            $result = $connection->query($sql);

            if ($result) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
}
?>
