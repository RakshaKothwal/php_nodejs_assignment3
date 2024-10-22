<?php
session_start();

header('Content-Type: image/png');

// Generate a random string for the CAPTCHA
$captcha_text = '';
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$length = 6; // Length of the CAPTCHA
for ($i = 0; $i < $length; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

// Store the CAPTCHA text in a session variable
$_SESSION['captcha'] = $captcha_text;

// Create the image
$image = imagecreatetruecolor(120, 40);

// Set colors
$bg_color = imagecolorallocate($image, 255, 255, 255); // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text

// Fill the background
imagefill($image, 0, 0, $bg_color);

// Add the CAPTCHA text to the image
imagettftext($image, 20, 0, 10, 30, $text_color, __DIR__ . '/arial.ttf', $captcha_text); // Ensure you have arial.ttf in the same directory or specify the correct path

// Output the image
imagepng($image);
imagedestroy($image);
?>
