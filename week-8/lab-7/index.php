<?php

/**
 * Lab 7 - APIs
 * Start by putting the URL for the API of your choice below.
 * Your API may require an API key. If the API takes GET requests, you can put the API key as a URL parameter at the end of the URL.
 * If your API requires a POST request, you may need to modify the example code to add a POST data parameter.
 * Whichever way, follow the API's documentation to help you out.
 */
$url = "https://ckan0.cf.opendata.inter.prod-toronto.ca/api/3/action/package_show?id=f5aa9b07-da35-45e6-b31f-d6790eb9bd9b"; // Replace with your API URL

$ch = curl_init($url);

//The two lines below are to prevent SSL errors when using cURL locally - for SSL security reasons, do not include on a hosted site!
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if ($result == false) {
    echo curl_error($ch);
}

$result = json_decode($result, true);

// var_dump($result);

?>

<!DOCTYPE html>
<html>
    <body>
        <!-- Next, print some or all of your API's result to the page! -->
         <h1>City of Toronto - Library Branch General Information</h1>

         <p><?= $result['result']['title'] ?></p>

         <p><?= $result['result']['notes'] ?></p>

         <ul>
             <?php foreach ($result['result']['resources'] as $resource) { ?>
                 <li><a href="<?= $resource['url'] ?>"><?= $resource['name'] ?></a></li>
             <?php } ?>
         </ul>
    </body>
</html>


