<!DOCTYPE html>
<html>
<head>
    <title>PHP Exercise 2: Links and If Statements</title>
</head>
<body>  

    <h1>PHP Exercise 2: Links and If Statements</h1>

    <p>Use PHP echo and variables to output the
    following link information, use if statements
    to make sure everything outputs correctly:</p>

    <?php

    $randomNumber = ceil( rand( 1,3 ) );
    
    echo '<p>The random number is '.$randomNumber.'.</p>';
    
    if( $randomNumber == 1 )
    {
        $linkName = 'Codecademy';
        $linkURL = 'https://www.codecademy.com/';
        $linkImage =
        'https://d92mrp7hetgfk.cloudfront.net/images/sites/misc/codecademy_logo/original.png?1560209977';
        $linkDescription = 'Learn to code interactively, for free.';

    }
    elseif( $randomNumber == 2 )
    {
        $linkName = 'W3Schools';
        $linkURL = 'https://www.w3schools.com/';
        $linkImage = 'https://avatars.githubusercontent.com/u/77673807?v=4';
        $linkDescription = 'W3Schools is optimized for learning,
        testing, and training.';

    }
    else
    {

        $linkName = 'Mozilla Developer Network';
        $linkURL = 'https://developer.mozilla.org/';
        $linkImage = 'https://cdn.neowin.com/news/images/uploaded/2022/03/1648072109_mdn_medium.jpg';
        $linkDescription = 'The Mozilla Developer Network (MDN)
        provides information about Open Web technologies.';

    }

    // Outputting the link information
    echo '<h2>'.$linkName.'</h2>';

    echo '<p><a href="'.$linkURL.'">'.$linkURL.'</a></p>';

    echo '<img src="'.$linkImage.'" alt="Site Logo">';

    echo '<p>' .$linkDescription.'</p>';

    ?>

</body>
</html>