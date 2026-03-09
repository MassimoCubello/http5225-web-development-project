<?php

$emailError = '';
$subjectError = '';
$messageError = '';

$conn = new mysqli("localhost","root","root","blockbuster", 3306);

// Check connection
if ($conn->connect_error) {
  echo("Connection failed: " . $conn->connect_error);
  //exit();

  // Don't run other code if the database connection fails
}

if(count($_POST) > 0) {
  var_dump($_POST);

  $isValid = true;

  // Validate form fields here
  if(empty($_POST['email'])) {
    $isValid = false;    
    $emailError = 'Please include your email address.';
  }
  elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

    //invalid email address
    $isValid = false;
    $emailError = 'Please include a valid email address.';
  }
  
  if(empty($_POST['subject'])) {
    $isValid = false;    
    $subjectError = 'Please include the subject.';
  }

  if(empty($_POST['message'])) {
    $isValid = false;
    $messageError = 'Please include a message.';
  }

  // Submit functionality goes here
  if($isValid == true) {
    
    $exampleName = 'Example';
    // submit to database
    $stmt = $conn->prepare('INSERT INTO contact_log (name, email, subject, message) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $exampleName, $_POST['email'], $_POST['subject'], $_POST['message']); // 's' = string
    $isStatementSuccessful = $stmt->execute();
    if($isStatementSuccessful == false) {
      echo 'Error running insert query: ' . $stmt->error;
    } else {
      $result = $stmt->insert_id; // Get the ID of the newly inserted record
      echo '<div style="color: green;">Form is valid.</div>';
    }
  }
}

$query = 'SELECT * FROM contact_log';
$stmt = $conn->query($query);
$contactForms = $stmt->fetch_all(MYSQLI_ASSOC);

$conn->close(); // Close the database connection when we're done with it

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Week 6 - PHP Form Validation</title>
</head>
<body>
  <h1>Week 6 - PHP Form Validation</h1>
  <h2>Contact Log</h2>

  <form action="#" method="post">
    <div style="margin-bottom: 0.75em;">
      <label form="email">Email Address:</label>
      <input type="email" name="email" id="email">
      <div style="color: red;"><?php echo $emailError; ?></div>
    </div>

    <div style="margin-bottom: 0.75em;">
      <label form="subject">Subject:</label>
      <input type="text" name="subject" id="subject">
      <div style="color: red;"><?php echo $subjectError; ?></div>
    </div>

    <div style="margin-bottom: 0.75em;">
      <label form="message">Message:</label>
      <textarea name="message" id="message"></textarea>
      <div style="color: red;"><?php echo $messageError; ?></div>
    </div>

    <button type="submit">Submit</button>

  </form>

    <hr>

  <h2>Contact Form Log</h2>
  <!-- Display contact form log here -->
  <?php
    foreach($contactForms AS $key=>$value) : ?>
      <div>ID# <?= $value['id']; ?> - <?= $value['subject']; ?> - <?= $value['email']; ?></div>
  <?php endforeach; ?>

</body>
</html>