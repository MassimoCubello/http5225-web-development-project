<?php

session_start();

if(count($_POST) > 0)
{
    if(empty($_POST['username']) || empty($_POST['password']))
    {
        $isValid = false;
    }

    $validUsername = 'user123';
    $validPassword = 'bananas';

    if($_POST['username'] === $validUsername && $_POST['password'] === $validPassword)
    {
        $_SESSION['username'] = $validUsername;
        header('Location: login.php');
        exit();
    }

}



?>



<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Login</h1>

        <div>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>