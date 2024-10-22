<?php

$url = "http://localhost:3000/api/students";


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);


if($response === false) {
    echo "Error: " . curl_error($ch);
} else {
    
    $students = json_decode($response, true);

 
    echo "<h2>Student Data from Express API</h2>";
    foreach($students as $student) {
        echo "Student ID: " . $student['student_id'] . "<br>";
        echo "Name: " . $student['name'] . "<br>";
        echo "Age: " . $student['age'] . "<br>";
        echo "Class: " . $student['class'] . "<br><br>";
    }
}


curl_close($ch);
?>

