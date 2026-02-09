<?php

$connection = new mysqli('localhost', 'root', 'root', 'classic_cars', 8889);

// Check if connection is working
if ($connection->connect_errno) { // same as dot notaton in javascript (ex. $connection.connect_errno)
    echo 'Error connecting to database.';
}
// } else {
   // echo 'Connection successful.';
// }

$query = "SELECT 
    productCode, 
    productName, 
    productLine, 
    quantityInStock, 
    MSRP FROM products";
$stmt = $connection->query($query); // same thing as connection.query in javascript
$result = $stmt->fetch_all(MYSQLI_ASSOC);

// var_dump($result); // same thing as console.log in javascript. It will show you the array of products retrieved from the database.

?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Week 5 - PHP and MySQL</h1>
        <h2>Classic Car Model List</h2>

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Product Name</th>
                    <th>Product Line</th>
                    <th>Quantity In Stock</th>
                    <th>MSRP</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key=>$product) : ?>
                <tr>
                    <td><?= $product['productCode'] ?></td>
                    <td><?= $product['productName'] ?></td>
                    <td><?= $product['productLine'] ?></td>
                    <td><?= $product['quantityInStock'] ?></td>
                    <td><?= $product['MSRP'] ?></td>
                    <td>
                        <a href="/details.php?id=<?= $product['productCode'] ?>"><button>Details</button></a>
                    </td>
                </tr>    
                <?php endforeach; ?>    
            </tbody>
        </table>

    </body>
</html>  