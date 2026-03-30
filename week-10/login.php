<?php 
    $page_title = "Login";
?>
<?php require_once('components/header.php'); ?>

<?php 
      if(isset($_POST['login'])) // Check if the form was submitted
    { 
        $isValid = true;
        $errorMessage = '';
        // Validate form inputs
        if(!isset($_POST['email']) || empty($_POST['email']))
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
        if ($isValid == true) 
        {
            // Start login logic here (e.g., check user credentials against the database)
            $query = "SELECT id, email, password FROM users WHERE email = ? LIMIT 1";
            $stmt = $db->prepare($query);
            $validatedEmail = trim($_POST['email']);
            $stmt->bind_param("s", $validatedEmail);
            if($stmt->execute() == false)
                {
                    echo "Execute failed: " . $stmt->error;
                }
            else
                {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc(MYSQLI_ASSOC);
                    var_dump($user); 

                    if(empty($user)) 
                    {
                        $errorMessage = "Incorrect email or password.";
                    }
                    else
                    {
                      if (password_verify(trim($_POST['password']), $user['password']) == true)
                        {
                          $_SESSION['id'] = $user['id']; // Store user ID in session for authentication
                          $_SESSION['email'] = $user['email']; // Store user email in session for authentication
                          
                          header("Location: index.php"); // Redirect to homepage after successful login

                        }
                      else
                        {
                          $errorMessage = "Incorrect email or password.";
                        }
                    }
                }
        }
    }
?>


  <h1>Blog Login</h1>
  
  <form action="login.php" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" id="email" name="email" class="form-control">
    </div>  

    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>  
    
    <div class="mb-3 form-check">
      <input type="submit" value="Login" class="btn btn-primary">
    </div>  
  </form>

  <div>
    <a href="register.php">Register for a new account</a>
  </div>

<?php require_once('components/footer.php'); ?>