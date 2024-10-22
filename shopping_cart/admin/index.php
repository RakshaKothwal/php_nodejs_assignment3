<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f0f0f0;
        }
        h1 {
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50; /* Green */
            border-radius: 5px;
        }
        a.logout {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>

    <h1>Welcome Admin</h1>
    <a href="category/index.php">Manage Categories</a>
    <a href="product/index.php">Manage Products</a>
    <a href="logout.php" class="logout">Logout</a>

</body>
</html>
