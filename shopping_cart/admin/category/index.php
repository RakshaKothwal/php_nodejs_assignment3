<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $category_name = $_POST['category_name'];
        $conn->query("INSERT INTO categories (category_name) VALUES ('$category_name')");
    }
    if (isset($_POST['delete_category'])) {
        $category_id = $_POST['category_id'];
        $conn->query("DELETE FROM categories WHERE id='$category_id'");
    }
}

$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
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
            margin-bottom: 20px; /* Added margin for spacing */
        }
        table {
            width: 100%; /* Make table take full width */
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        input[type="text"] {
            width: 200px; 
            padding: 10px;
            margin-right: 5px; 
        }
        input[type="submit"] {
            padding: 10px 15px; 
        }
        a {
            display: inline-block; 
            margin-top: 20px; 
        }
    </style>
</head>
<body>

<h1>Manage Categories</h1>

<form method="POST">
    <input type="text" name="category_name" placeholder="New Category Name" required>
    <input type="submit" name="add_category" value="Add Category">
</form>

<table>
    <tr>
        <th>Category Name</th>
        <th>Action</th>
    </tr>
    <?php while ($category = $categories->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($category['category_name']) ?></td>
        <td>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                <input type="submit" name="delete_category" value="Delete">
            </form>
            <a href="edit.php?id=<?= $category['id'] ?>">Edit</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="../index.php">Back to Dashboard</a> 

</body>
</html>
