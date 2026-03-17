<?php

session_start();

var_dump($_SESSION);

if(!isset($_SESSION['id']))
{   
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Dashboard</h1>
        <p>Welcome, <?= $_SESSION['email'] ?></p>
    </body>

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</html>