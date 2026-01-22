<?php

    $hostname = "localhost";
    $username = "root";
    $password = "root";

    try {
    $pdo = new PDO("mysql:host=".$hostname.";dbname=blockbuster", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfullly";

    $query = "SELECT * FROM games";
    // This is the samething as $pdo.prepare in JavaScript
    $stm = $pdo->prepare($query);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    var_dump($result); // Anything you put in here wil be printed to the page

    } catch (PDOException $e) {
        echo "database connection error";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Blockbuster</title>
    </head>
    <body>
            <h1> Blockbuster</h1>
            <p>Games List</p>
            
            <ul>
                <?php foreach($result AS $key=>$value) : ?>
                    <li><a href="/details.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></li>         
                <?php endforeach; ?>
            </ul>

            <b>
            <?php
               // echo "Hello World!"; This means print to the HTML page //
            ?>
            </b>

    </body>
</html>