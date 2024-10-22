<?php
// db.php - Handles database connection
$host = 'localhost';
$user = 'root';
$password = 'root'; // Leave empty if using XAMPP
$dbname = 'shopping_cart_db';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
