<?php 

function db(): mysqli {
    static $conn = null; // only create one instance of this variable across every time this function is called.

    if($conn === null) {
        $conn = new mysqli('localhost', 'root', 'root', 'classic_cars', 8889);
        if ($conn->connect_errno) { 
            echo 'Error connecting to database.';
        } // else {
            // echo 'Connection successful.';
        // }
    }
    return $conn;
}