<?php

session_start();

$isValid = true;

if(count($_POST) > 0)
{
    //var_dump($_POST);

    $conn = new mysqli("localhost","root","root","login", 3306);

    if(empty($_POST['email']) || empty($_POST['password']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $isValid = false;
    }

    if($isValid == true)
    {
        $query = 'SELECT id, email, password FROM users WHERE email = ? LIMIT 1';
        $stmt = $conn->prepare($query); 
        $stmt->bind_param('s', $_POST['email']); 
        if($stmt->execute() == false)
        {
            echo "Execute failed: " . $stmt->error;
        }
        else 
        {
            $result = $stmt->get_result();
            $user = $result->fetch_all(MYSQLI_ASSOC)[0];

            //var_dump($user);
            if(empty($user))
            {
                echo 'User not found';   
            }
            else 
            {
                if( password_verify($_POST['password'], $user['password'])  == true)
                {
                    //password is valid for the given email. We can now login 
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];

                    //redirect or change some other page settings
                    header('Location: dashboard.php');

                }
                else 
                {
                    echo 'Incorrect email address or password';
                }
            }
        }
    }
}

// $hash = password_hash('apples', PASSWORD_DEFAULT);

// var_dump( password_verify('apples', $hash) );





?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <h1>Week 7 - Login & Session Handling</h1>

        <div style="color:red;">
            <?php if($isValid == false) : ?>
                There was an error logging in
            <?php endif; ?>
        </div>

        <div>
            <form action="" method="post">
                <div>
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" name="submit" value="">Submit</button>
            </form>
        </div>
    </body>
</html>