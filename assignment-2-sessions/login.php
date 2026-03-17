<?php

session_start();

if(!isset($_SESSION['username']))
{
    header('Location: dashboard.php');
    exit();
}

?>


<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Dashboard</h1>

        <div>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        </div>
    </body>
</html>