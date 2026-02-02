<!DOCTYPE html>
<html>
    <head>
        <title>HTTP 5225 - Lab 3</title>
        <style>
            body {padding-left: 10rem; padding-right: 10rem;}
            h1 {text-align: center;}
            .resourceCard {border: 1px solid black; border-radius: 5px; padding: 1rem; margin-bottom: 1rem;}
        </style>
    </head>
    <body>
        <h1>HTTP 5225 Lab 3 - For Loops</h1>




        <p>PART 1 - using the array declared below, print the contents out as a list in the 'ul' element below:</p>




        <?php
            $myFruits = array('Orange', 'Apple', 'Banana', 'Grapefruit', 'Pear', 'Pineapple');
        ?>




        <h2>My favorite fruits:</h2>
        <ul>
            <?php //HINT - your loop should go here. Since this is in a 'ul', the outputted data should be formatted as 'li' elements. ?>
           
        </ul>




        <hr />


        <p>PART 2 - create your own function that will print out each element of the $myVegetables array to the page using the PHP code below:</p>


        <h2>My favorite vegetables:</h2>


        <?php
       
            function printArray($userArray)
            {
                // HINT - your function code will go here - how do you loop through elements of a given array? How do you print elements to the page?
                // Remember you can create a new line/page break in html with <br />
            }


            $myVegetables = ['Potato', 'Squash', 'Carrot', 'Broccoli', 'Spinach'];


            printArray($myVegetables); // HINT - once your function code is complete, this function should print elements to the page wherever the function is called
       
        ?>


        <hr />


        <p>
            PART 3 - BONUS - The following associative array is a good example of how data from a database or API would be formatted.
            Print the contents of each object in the associative array into the example HTML template shown below.
        </p>




        <?php
            $myResourcesArray = array(
                array('id' => 1, 'name' => 'W3Schools', 'description' => 'The world\'s largest web developer site', 'href' => 'https://www.w3schools.com/', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/3/3e/W3Schools_logo.png'),
                array('id' => 1, 'name' => 'Codecademy', 'description' => 'Learn to code - for free', 'href' => 'https://www.codecademy.com/', 'image' => 'https://raw.githubusercontent.com/Codecademy/docs/main/media/html-image-example.png'),
                array('id' => 1, 'name' => 'Stack Overflow', 'description' => 'Communities for your favourite technologies', 'href' => 'https://stackoverflow.com/', 'image' => 'https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg'),
                array('id' => 1, 'name' => 'MDN', 'description' => 'Resources for developers, by developers', 'href' => 'https://developer.mozilla.org/en-US/', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/d/d2/MDN_Web_Docs_logo.svg'),
            );
        ?>




        <h2>My favorite code resources:</h2>




        <?php
        /**
         * HINT - copy the template div below into a loop that loops through the $myResourcesArray, and echos each value into the relevant spots in the template (you may not need every value in the array).
         * Comment out the template when you are done so the example is not shown on the page.
         */
        ?>