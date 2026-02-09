<?php

// var_dump($_GET); 
// // this will show you the query parameters in the URL. 
// In this case, it will show you the productCode that was passed from the index.php when you click on the Details button.

// include 'db.php'; 
// this is another way to import the contents of a specified php file. 
// Include will only give you a warning if the file is not found. 
// Require will give you a fatal error and stop the execution of the script. 

require_once 'db.php'; // this imports the contents of a specified php file.

$connection = db();
$query = 'SELECT * FROM products WHERE productCode = ?';
$stmt = $connection->prepare($query);
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_all(MYSQLI_ASSOC)[0];

//var_dump($product);

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= $product['productName'] ?></title>
    </head>
    <body>
        <h1>Week 5 - PHP and MySQL</h1>
        <h2><?= $product['productName'] ?></h2>
        <div>
            <a href="/index.php"><button>Go Back to List</button></a>
        </div>
        <p><?= $product['productDescription'] ?></p>
        <ul>
            <li>Vendor: <?= $product['productVendor'] ?></li>
            <li>Product Line: <?= $product['productLine'] ?></li>
            <li>In Stock: <?= $product['quantityInStock'] ?></li>
            <li>MSRP: $<?= $product['MSRP'] ?></li>
        </ul>    
    </body>
</html>