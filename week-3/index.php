<?php

    // phpinfo(); // Display PHP configuration information

    //Turn these on to see PHP errors for debugging
    // ini_set('display_errors', 1); // Show errors
    // ini_set('display_startup_errors', 1); // Show startup errors
    // error_reporting(E_ALL); // Report all types of errors

    //variables
    $myNumber = 5;
    $myArray = array('first', 'second', 'third');

    if ($myNumber == 5) {
        echo 'The number today is 5.';
    } else {
        echo 'The number is not 5.';
    }

    $myString = 'second';

    $day = date('N'); // Numeric representation of the day of the week (1 for Monday, 7 for Sunday)
    // var_dump($day);
    
    $dailyMessage = '';
    switch ($day) {
        case 1:
            $dailyMessage = 'Today is Monday.';
            break;
        case 2:
            $dailyMessage = 'Today is Tuesday.';
            break;
        case 3:
            $dailyMessage = 'Today is Wednesday.';
            break;
        default:
            $dailyMessage = 'Today is not Monday, Tuesday, or Wednesday.';
            break;
    }

    // global variable for storing session information 
    session_start();
    $_SESSION['username'] = 'sam123';
    $_SESSION['is_admin'] = true;

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 3 - Control Structures</title>
    </head>
    <body>
        <h1>Week 3 - Control Structures</h1>

        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

        <p>
            <?php echo $dailyMessage; ?>
        </p>    

        <h3>Blog Post Title</h3>

        <?php // this is a secret comment for admins only ?>
        <?php if($_SESSION['is_admin'] == true) : ?>
            <button>Edit Post</button>
            <button>Delete Post</button>
        <?php endif; ?>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <button>Share Post</button>

        <!-- HTML Printing If Statement -->
        <?php if ($_SESSION['is_admin'] == true) : ?>
            <div>
                <h3>Admin Section</h3>

                <p>All User Information</p>

                <table>
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Login</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Alice</td>
                            <td>2024-06-01 10:00:00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bob</td>
                            <td>2024-06-01 11:30:00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Charlie</td>
                            <td>2024-06-01 12:15:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </body>
</html> 