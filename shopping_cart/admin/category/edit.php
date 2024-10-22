<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';

$category_id = $_GET['id'];


$category_result = $conn->query("SELECT * FROM categories WHERE id='$category_id'");
$category = $category_result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $conn->query("UPDATE categories SET category_name='$category_name' WHERE id='$category_id'");
    header('Location: index.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 50%; /* Adjust width for the edit field */
            padding: 10px;
            margin-right: 5px; /* Add spacing between input and button */
        }
        input[type="submit"] {
            padding: 10px 15px; /* Padding for buttons */
        }
    </style>
</head>
<body>

<h1>Edit Category</h1>

<form method="POST">
    <input type="text" name="category_name" value="<?= htmlspecialchars($category['category_name']) ?>" required>
    <input type="submit" value="Update Category">
</form>

<a href="index.php">Back to Manage Categories</a>

</body>
</html>
