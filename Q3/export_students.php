<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "college";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT student_id, name, age, class FROM students";
$result = $conn->query($sql);

$xml = new DOMDocument("1.0", "UTF-8");
$xml->formatOutput = true;  // Format the output for better readability


$studentsElement = $xml->createElement("students");
$xml->appendChild($studentsElement);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Create <student> element for each row
        $studentElement = $xml->createElement("student");

        // Add child elements <student_id>, <name>, <age>, <class>
        $studentIdElement = $xml->createElement("student_id", $row['student_id']);
        $studentElement->appendChild($studentIdElement);

        $nameElement = $xml->createElement("name", $row['name']);
        $studentElement->appendChild($nameElement);

        $ageElement = $xml->createElement("age", $row['age']);
        $studentElement->appendChild($ageElement);

        $classElement = $xml->createElement("class", $row['class']);
        $studentElement->appendChild($classElement);

     
        $studentsElement->appendChild($studentElement);
    }
} else {
    echo "No records found in the students table.";
}


$xml->save("students.xml");

echo "Data has been exported to students.xml successfully.";


$conn->close();
?>
