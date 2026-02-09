<?php

// Connect to the MySQL database

// STEP 1 - REPLACE CONNECTION VALUES BELOW WITH YOUR DATABASE'S CONNECTION PARAMETERS
$conn = new mysqli(
    'localhost',
    'root',
    'root',
    'wdp_lab4',
    8889
);

// Create a query
$query = 'SELECT *
    FROM teams
    ORDER BY name';
$stmt = $conn -> query($query);
$rows = $stmt->fetch_all(MYSQLI_ASSOC);

// Output the number of rows
// echo count($rows);

// Loop through each record
foreach($rows AS $key=>$value)
{
    // STEP 2 - Output each record to the page in a manner of your choosing. Commented out below is one example
    // var_dump($value)

    echo '<h1>'.$value['name'].'</h1>';
    echo '<p>
        League: '.$value['league'].'
        <br>
        City: '.$value['city'].'
        <br>
        </p>';
    echo '<p>
        Ranking: '.$value['ranking'].'
        </p>';
    echo '<hr>';

    // echo '<h2>'.$value['name'].'</h2>';
    // echo '<p>
    //     League: '.$value['league'].'
    //     <br>
    //     Rank: '.$value['ranking'].'
    //     </p>';
   
    // echo '<hr>';
}
