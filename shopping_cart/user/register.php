<?php
session_start();
include '../includes/db.php';

// Generate CAPTCHA
$captcha_code = '';
if (isset($_SESSION['captcha_code'])) {
    $captcha_code = $_SESSION['captcha_code'];
} else {
    $captcha_code = substr(md5(rand()), 0, 6); // Generate a random 6-character code
    $_SESSION['captcha_code'] = $captcha_code;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $captcha = $_POST['captcha'];

    // Validate CAPTCHA
    if ($captcha !== $_SESSION['captcha_code']) {
        $error_message = "Invalid CAPTCHA";
    } else {
        // Insert new user into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users (username, password, email, mobile) VALUES ('$username', '$hashed_password', '$email', '$mobile')");
        $success_message = "Registration successful. You can now login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
        }
        .container {
            width: 400px; 
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left; 
        }
        h1 {
            text-align: center; 
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
            width: calc(100% - 22px); 
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px; 
        }
        .submit-button {
            padding: 10px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; 
        }
        .submit-button:hover {
            background-color: #45a049; 
        }
        .message {
            text-align: center; 
            color: red; 
            margin: 10px 0; 
        }
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Registration</h1>
    
    <?php if (isset($error_message)): ?>
        <div class="message" style="color:red;"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif (isset($success_message)): ?>
        <div class="message" style="color:green;"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="mobile" placeholder="Mobile Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="captcha" placeholder="Enter CAPTCHA: <?= $captcha_code ?>" required>
        <input type="submit" class="submit-button" value="Register">
    </form>

    <a href="login.php">Already have an account? Login here.</a>
</div>

</body>
</html>
