<?php

    $myArray = ['Basketball', 'Hockey', 'Tennis', 'Football'];
    array_push($myArray, 'Boxing'); // adds an element to the end of the array
    // array_search('Hockey', $myArray); // returns the index of the searched element
    // echo array_search('Golf', $myArray);


    /**
     * This function bolds a string and changes its color to red
     * @param String $stringToBeBolded The string to be bolded
     * @return String The bolded string
     */
    function boldString($stringToBeBolded)
    {
        return '<strong style="color: red;">' .$stringToBeBolded. '</strong>';
    }

    function printHelloMessage()
    {
        echo 'Hello World!';
    }



?>

<!DOCTYPE html>
<html>
    <head>
        <header>Week 4 - Loops and Functions</header>
    </head>
    <body>
        <h1>Week 4 - Loops and Functions</h1>

        <?php

            $myArray = ['Basketball', 'Hockey', 'Tennis', 'Football'];

            for ($x = 1; $x <= 40; $x++)
            {
                if ($x % 5 == 0 && $x % 4 == 0 )
                {
                    echo '<span style= "color: purple;">The current number is ' .$x. '</span><br/>';
                }
                elseif ($x % 5 == 0 )
                {
                    echo '<span style= "color: red;">The current number is ' .$x. '</span><br/>';
                }
                elseif ($x % 4 == 0 )
                {
                    echo '<span style= "color: blue;">The current number is ' .$x. '</span><br/>';
                }
                else 
                {
                    echo '<span>The current number is ' .$x. '</span><br/>';
                }    
            } 

            echo '<br/>';

            // for($x = 0; $x < count($myArray); $x++) // count() function returns the number of elements in an array just like .length() in JavaScript
            // {
               // echo 'The current sport is ' .$myArray[$x]. '<br/>';
            // }

            foreach($myArray as $key => $value)
            {
                echo 'The current sport is ' .$value. ' with key ' .$key. '<br/>';
                // if($key == 1)
                // {
                   // break; // stops the loop when key is 1
                //}
            }

        ?>

        <hr />

        <?php if( $myArray[0] == 'Basketball') : ?>
            <p>The first element is Basketball</p>
        <?php elseif( $myArray[0] == 'Hockey'): ?>
            <p>The first element is Hockey</p>        
        <?php endif; ?>




        <?php foreach($myArray as $value) : ?>
            <div style="border: 1px solid purple; border-radius: 5px; padding: 1rem; margin-bottom: 1rem;">
                <h3><?php echo boldString($value); ?></h3>
                <hr />
                <p>This is the sport description.</p>
            </div>
        <?php endforeach; ?>

        <?php 
            for($x = 0; $x < 5; $x++) {
                printHelloMessage();
            }
        ?>    




    </body>
</html>