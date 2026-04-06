<?php
    if(isset($page_title)) {
        $title = $page_title;
    } else {
        $title = "Blog";
    }

    session_start(); // Start the session to manage user authentication and other session data

    $db = new mysqli("localhost", "root", "root", "cms-blog", 8889);
    if($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-3"> <!-- Bootstrap container class for responsive layout. mt-3 adds margin-top for spacing -->

    <?php if(isset($_SESSION['success'])) : ?>
        <div class="alert alert-success" role="alert"> <!-- Bootstrap alert class for success messages -->
        <?= $_SESSION['success'] ?> <!-- Display the success message stored in the session -->
    </div>
    <?php 
        endif;
        unset($_SESSION['success']);  // Clear the success message from the session after displaying it