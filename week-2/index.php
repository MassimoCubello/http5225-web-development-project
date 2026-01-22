<?php

    // Variables
    $myNumber = 5;
    $myString = "Hello";
    $myBool = true;
    $myNull = null;
    $emptyVariable;
    $emptyVariable = 100; // Declaring an empty variable and then assigning a value later.
    $myDateTime = new DateTime();
    // echo $emptyVariable; // Output to the browser
    // var_dump($myDateTime); // var_dump prints detailed variable information to the page

    // Arrays
    $myArray = array('Apple', 'Banana', 'Orange');
    // echo $myArray[0]; // Outputs 'Apple'
    $myAssociativeArray = array('code' => '5225', 'program' => 'HTTP');
    // echo $myAssociativeArray['code']; // Outputs '5225'

    /* GLOBAL ARRAYS */
    // $_GLOBALARRAY - format for global arrays

    // Cookies
    setcookie('course', '5225', time() + (86400 * 30)); // 86400 = 1 day
    setcookie('course', '5225', time() - (86400 * 30)); // Deleting a cookie by setting its expiration time in the past
    // var_dump($_COOKIE['course']); // Accessing cookie value

    session_start(); // Start the session. You need this on every page that uses sessions.
    $_SESSION['username'] = 'student123';
    var_dump($_SESSION);

    $link = 'https://w3schools.com';
    $imageURL = 'https://picsum.photos/202';

    var_dump($_GET); // To see URL parameters if any
    var_dump($_POST); // To see form data when submitted


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 2 - PHP Variables and Arrays</title>
    </head>
    <body>
        <h1>Week 2 - PHP Variables and Arrays</h1>
        <?php echo $myString; ?>
        <?php echo "<b>Hello in bold</b>"; ?>
        <p>Welcome to <?php echo $myAssociativeArray['program']; ?> <?php echo $myAssociativeArray['code']; ?></p>

        <div>
            <a href="<?php echo $link; ?>" target="_blank">Go to W3Schools</a>
        </div>

        <div>
            <img src="<?php echo $imageURL; ?>" alt="Example Image">
        </div>

        <div style="margin-top:20px;">
            <form action="#" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <input type="submit">
            </form>
        </div>


    </body>
</html>