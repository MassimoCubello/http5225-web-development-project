<?php

$conn = new mysqli('localhost', 'root', 'root', 'classic_cars', 8889);

// Check connection
if ($conn -> connect_errno) {
    echo "Connection failed: " . $conn -> connect_error;
    // exit();
}

$query = 'SELECT * FROM products';
$stmt = $conn -> query ($query);
$rows = $stmt -> fetch_all(MYSQLI_ASSOC);

$conn -> close();

//var_dump($rows);

$resultSetArray = array('id' =>$_GET['id']);
$resultSetArray['data'] = $rows;

header('Content-Type: application/json');
echo json_encode($resultSetArray);

