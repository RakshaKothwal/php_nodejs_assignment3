<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Shopping Cart</title>
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
        .button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .user-button {
            background-color: #4CAF50; /* Green */
            color: white;
        }
        .admin-button {
            background-color: #008CBA; /* Blue */
            color: white;
        }
    </style>
</head>
<body>

    <h1>Welcome to Shopping Cart</h1>
    <a href="user/login.php">
        <button class="button user-button">Login as User</button>
    </a>
    <a href="admin/login.php">
        <button class="button admin-button">Login as Admin</button>
    </a>

</body>
</html>
