<?php 
    $page_title = "Login";
?>
<?php require_once('components/header.php'); ?>

<?php 
$isValid = true;
$errorMessage = '';

    if(isset($_POST['register'])) // Check if the form was submitted
    { 
        var_dump($_POST);

        // Validate form inputs
        if(!isset($_POST['agree'])) 
        {
            $isValid = false; // Set validation flag to false if the checkbox is not checked
            $errorMessage = "Please agree to the terms and conditions.";
        }
        elseif(empty($_POST['email']))
        {
            $isValid = false; // Set validation flag to false if email is empty
            $errorMessage = "Email is required.";
        }
        elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $isValid = false; // Set validation flag to false if email is not valid
            $errorMessage = "Please enter a valid email address.";
        }
        elseif(empty($_POST['password']))
        {
            $isValid = false; // Set validation flag to false if password is empty
            $errorMessage = "Password is required.";
        }
        // End of form validation
        if($isValid == true) 
        {
            // Start registration logic here (e.g., save user to database)
            $query = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            // Always hash the password before storing it in the database for security
            $hasedPassword = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $validatedEmail = trim($_POST['email']);
            $stmt->bind_param("ss", $validatedEmail, $hasedPassword);
            if($stmt->execute() == false)
                {
                    echo "Execute failed: " . $stmt->error;
                }
            else
                {
                    $result = $stmt->insert_id; // Get the ID of the newly inserted user
                    // var_dump($result);
                    $_SESSION['success'] = "Registration successful! You can now log in."; // Set a success message in the session
                    header("Location: login.php"); // Redirect to login page after successful registration
                }
        }
    }

?>

<h1>Register for a new account</h1>

<div class="mb-3">
    <a href ="login.php">Back to login</a>
</div>

<?php if(isset($isValid) && $isValid == false) : ?>
    <div class="alert alert-danger" role="alert"> <!-- Bootstrap alert class for error messages -->
        <?= $errorMessage ?>
    </div>
<?php endif; ?>

<form action="register.php" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control">
    </div>  

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>  

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="agree" name="agree">
        <label class="form-check-label" for="agree">I agree to the terms and conditions</label>
    </div>
  
        <input type="submit" value="Register" class="btn btn-primary" name="register">

</form>

<?php require_once('components/footer.php'); ?>