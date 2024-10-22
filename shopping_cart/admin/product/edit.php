<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include '../../includes/db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $product_result = $conn->query("SELECT * FROM products WHERE id='$product_id'");
    $product = $product_result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $category_id = $_POST['category_id'];

        // Handle file upload if a new image is provided
        if ($_FILES['product_image']['name']) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
            $image_sql = ", image='$target_file'";
        } else {
            $image_sql = ""; // No change to the image
        }

        
        $conn->query("UPDATE products SET name='$product_name', price='$product_price', category_id='$category_id' $image_sql WHERE id='$product_id'");

        
        header('Location: index.php');
        exit();
    }
} else {
    
    header('Location: index.php');
    exit();
}


$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        input[type="text"], input[type="number"], select {
            width: 200px; 
            padding: 10px;
            margin-right: 5px; 
        }
        input[type="submit"] {
            padding: 10px 15px; 
        }
    </style>
</head>
<body>

<h1>Edit Product</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="product_name" placeholder="Product Name" value="<?= htmlspecialchars($product['name']) ?>" required>
    <input type="number" name="product_price" placeholder="Price" value="<?= htmlspecialchars($product['price']) ?>" required>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while ($category = $categories->fetch_assoc()): ?>
        <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="file" name="product_image"> 
    <input type="submit" value="Update Product">
</form>

<a href="index.php">Back to Manage Products</a>

</body>
</html>
