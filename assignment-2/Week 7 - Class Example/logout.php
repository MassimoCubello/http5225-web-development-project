<?php
// Below is copied from W3Schools - https://www.w3schools.com/php/php_sessions.asp

// Resume the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

header('Location: login.php');

?>