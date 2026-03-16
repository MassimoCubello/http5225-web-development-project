<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//https://ckan0.cf.opendata.inter.prod-toronto.ca/api/3/action/package_show?id=9425a29e-6b01-40f0-94c2-9a7b9efe8696

$url = "https://ckan0.cf.opendata.inter.prod-toronto.ca/api/3/action/package_show?id=9425a29e-6b01-40f0-94c2-9a7b9efe8696";

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$result = curl_exec($ch);

// Check for errors
if($result == false) {
    echo "Error: " . curl_error($ch); // gets the error message (if any) from the curl object
}

$data = json_decode($result, true); 
 
// var_dump($data);

// Tell browser to expect JSON (and not HTML) and output the data as JSON in a pretty-printed format (for easier reading).
// header('Content-Type: application/json');
// echo json_encode($data, JSON_PRETTY_PRINT);

?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>List of Toronto Green Roof Permit Resources</h1>

        <p><?= $data['result']['notes'] ?></p>

        <ul>
            <?php foreach($data['result']['resources'] AS $key => $value) : ?>
                <li><?= $value['name'] ?></li> - <a href="<?= $value['url'] ?>"><?= $value['url'] ?></a>
            <?php endforeach; ?>
        </ul>

    </body>
</html>