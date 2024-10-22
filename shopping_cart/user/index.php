<?php
session_start();
include '../includes/db.php';

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");

// Initialize products array
$products = [];

// Check if a category is selected
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch products in the selected category
    $products = $conn->query("SELECT * FROM products WHERE category_id = '$category_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 40px;
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        .sidebar {
            width: 20%;
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 20px;
        }
        ul {
            padding: 0;
            list-style: none;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li a {
            display: block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            font-weight: bold;
        }
        ul li a:hover {
            background-color: #45a049;
        }
        .main-content {
            flex-grow: 1;
        }
        #products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            justify-content: flex-start;
        }
        .product-item {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            max-width: 200px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .product-item:hover {
            transform: translateY(-5px);
        }
        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .product-item h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }
        .product-item p {
            font-size: 1rem;
            color: #555;
        }
        .header-right {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .welcome {
            font-size: 1.0rem;
            color: #333;
        }
        .logout {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="header-right">
    <span class="welcome">Welcome, <?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Guest' ?></span>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <div class="sidebar">
        <h2>Categories</h2>
        <ul>
            <?php while ($category = $categories->fetch_assoc()): ?>
            <li>
                <a href="?category_id=<?= $category['id'] ?>"><?= htmlspecialchars($category['category_name']) ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="main-content">
        <div id="products">
            <?php if ($products && $products->num_rows > 0): ?>
                <?php while ($product = $products->fetch_assoc()): ?>
                    <div class="product-item">
                       <img src="/shopping_cart/admin/product/<?= !empty($product['image']) ? htmlspecialchars($product['image']) : 'uploads/default.png' ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="100">

                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>Price: <?= htmlspecialchars($product['price']) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
