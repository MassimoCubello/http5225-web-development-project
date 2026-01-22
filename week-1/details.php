<?php

    $hostname = "localhost";
    $username = "root";
    $password = "root";

    try {
    $pdo = new PDO("mysql:host=".$hostname.";dbname=blockbuster", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfullly";

    $query = "SELECT 
        games.id,
        games.name,
        games.console_is,
        games.release_date,
        games.rental_price,
        consoles.name AS console_name
        FROM games
        INNER JOIN consoles ON games.console_id = consoles.id 
        WHERE id = :id";
    // This is the samething as $pdo.prepare in JavaScript
    $stm = $pdo->prepare($query);
    $stm->execute(array(':id' => $_GET['id']));
    $result = $stm->fetch(PDO::FETCH_ASSOC); // fetchALl means get all of them and put them in an array
    
    var_dump($_GET);
    // var_dump($result); // Anything you put in here wil be printed to the page

    } catch (PDOException $e) {
        echo "database connection error ".$e->getMessage();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Blockbuster</title>
    </head>
    <body>
            <h1> Blockbuster</h1>
            <h2><?php echo $result['name'] ?></h2>

            <ul>
                <li><?php echo $result['console_name'] ?></li>
                <li><?php echo $result['release_date'] ?></li>
                <li><?php echo $result['rental_price'] ?></li>
            </ul>
            <a href="/index.php">Go Back</a>
    </body>
</html>


            