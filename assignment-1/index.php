<?php

$connection = new mysqli('localhost', 'root', 'root', 'wdp_assign1', 8889);

// Check if connection is working
if ($connection->connect_errno) { // same as dot notaton in javascript (ex. $connection.connect_errno)
    echo 'Error connecting to database.';
 } // else {
    // echo 'Connection successful.';
 // }

$query = "SELECT 
    firstName, 
    lastName, 
    dateOfBirth, 
    hometown, 
    manufacturer,
    team,
    carNumber FROM drivers";
$stmt = $connection->query($query); // same thing as connection.query in javascript
$result = $stmt->fetch_all(MYSQLI_ASSOC);

// var_dump($result); // same thing as console.log in javascript. It will show you the array of products retrieved from the database.

?>

<!DOCTYPE html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment 1: PHP and MySQL</title>
        <style>
            body {
                margin: 20px;
                font-family: Arial, sans-serif;
                background-color: #dff0fa;
                padding: 20px;
            }
            h1 {
                color: #333;
            }
            h2 {
                color: #424242;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                border-radius: 5px;
                overflow: hidden;
            }
            th {
                background-color: #676565;
                color: white;
                padding: 10px;
                text-align: left;
            }
            td {
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Assignment 1: PHP and MySQL</h1>
        <h2>NASCAR Driver List</h2>

        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Hometown</th>
                    <th>Manufacturer</th>
                    <th>Team</th>
                    <th>Car Number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key=>$driver) : ?>
                <tr>
                    <td><?= $driver['firstName'] ?></td>
                    <td><?= $driver['lastName'] ?></td>
                    <td><?= $driver['dateOfBirth'] ?></td>
                    <td><?= $driver['hometown'] ?></td>
                    <td><?= $driver['manufacturer'] ?></td>
                    <td><?= $driver['team'] ?></td>
                    <td><?= $driver['carNumber'] ?></td>
                </tr>    
                <?php endforeach; ?>    
            </tbody>
        </table>
    </body>
</html>  