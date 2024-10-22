<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "college";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$xml = simplexml_load_file('students.xml') or die("Error: Cannot create object");


foreach ($xml->student as $student) {
    $student_id = $student->student_id;
    $name = $student->name;
    $age = $student->age;
    $class = $student->class;

  
    $stmt = $conn->prepare("INSERT INTO students (student_id, name, age, class) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $student_id, $name, $age, $class);

  
    if ($stmt->execute()) {
        echo "Student data inserted successfully: $name <br>";
    } else {
        echo "Error inserting data: " . $stmt->error . "<br>";
    }
}


$conn->close();
?>
