<?php

header("Content-Type: application/json");


$students = [
    ["student_id" => "S23041", "name" => "Raksha", "age" => 21, "class" => "ICT"],
    ["student_id" => "S23042", "name" => "Anjali", "age" => 24, "class" => "IT"],
    ["student_id" => "S23043", "name" => "Kajal", "age" => 25, "class" => "ICT"]
];


echo json_encode($students);
?>
