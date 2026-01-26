<!DOCTYPE html>
<html>
<head>
    <title>PHP Exercise 1: Links and Variables</title>
</head>
<body>
    <h1>PHP Exercise 1: Links and Variables</h1>

    <p>Use PHP echo and variables to output the following link information:</p>

    <hr>

    <?php
    $linkName = 'Codecademy';
    $linkURL = 'https://www.codecademy.com/';
    $linkImage = 'https://upload.wikimedia.org/wikipedia/sco/b/b9/New_England_Patriots_logo.svg';
    $linkDescription = 'Learn to code interctively, for free.';

    ?>

    
    <h2><?php echo "<b>$linkName</b>"; ?></h2>

    <div>
        <?php echo $linkDescription; ?>
    </div>

    <div>
        <img src="<?php echo $linkImage; ?>" alt="Logo">
    </div>

    <div>
        <a href="<?php echo $linkURL; ?>" target="_blank">Visit Codecademy</a>
    </div>



</body>
</html>