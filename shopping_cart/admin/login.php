<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username; 
        header('Location: index.php'); 
        exit();
    } else {
        $error_message = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            height: 100vh; 
            margin: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center;
        }
        form {
            background: white;
            padding: 30px; 
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px; 
            max-width: 90%; 
        }
        input {
            margin: 15px 0; 
            padding: 12px; 
            width: 100%; 
            box-sizing: border-box; 
        }
        .submit-button {
            padding: 12px; 
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; 
        }
        p.error {
            color: red;
        }
    </style>
</head>
<body>

    <form method="POST">
        <h1 style="text-align: center;">Admin Login</h1>
        <?php if (isset($error_message)): ?>
            <p class="error"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" class="submit-button" value="Login">
    </form>

</body>
</html>
