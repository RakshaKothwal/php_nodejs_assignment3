<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle adding a new product
    if (isset($_POST['add_product'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $category_id = $_POST['category_id'];
        
        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
        
        $conn->query("INSERT INTO products (name, price, category_id, image) VALUES ('$product_name', '$product_price', '$category_id', '$target_file')");
    }
  
    if (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        $conn->query("DELETE FROM products WHERE id='$product_id'");
    }
}


$products = $conn->query("SELECT products.*, categories.category_name FROM products JOIN categories ON products.category_id = categories.id");


$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
            margin-bottom: 20px; /* Space between forms and table */
        }
        input[type="text"], input[type="number"], select {
            width: 200px; /* Fixed width for inputs */
            padding: 10px;
            margin-right: 5px; /* Spacing between fields */
        }
        input[type="submit"] {
            padding: 10px 15px; /* Padding for buttons */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Manage Products</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="product_name" placeholder="Product Name" required>
    <input type="number" name="product_price" placeholder="Price" required>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while ($category = $categories->fetch_assoc()): ?>
        <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="file" name="product_image" required>
    <input type="submit" name="add_product" value="Add Product">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php while ($product = $products->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($product['name']) ?></td>
        <td><?= htmlspecialchars($product['price']) ?></td>
        <td><?= htmlspecialchars($product['category_name']) ?></td>
        <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="50"></td>
        <td>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="submit" name="delete_product" value="Delete">
            </form>
            <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="../index.php">Back to Dashboard</a> 

</body>
</html>
