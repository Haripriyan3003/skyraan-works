<?php
$user = 'root';
$pass = '';
$db = 'students';

$connection = new mysqli('localhost', $user, $pass, $db) or die("Database not connected");

// Check if student ID is provided and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $student_id = $_GET['id'];
    
    // Delete the student record from the database
    $sql = "DELETE FROM students WHERE Stud_id = $student_id";
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo "Invalid student ID.";
}

// Close database connection
$connection->close();
?>
