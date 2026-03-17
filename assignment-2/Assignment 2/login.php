<?php

// Login Crentials for Testing
// Email: author@email.com
// Password: books

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // Database connection
    $conn = new mysqli("localhost", "root", "root", "personal_query_tracker", 8889);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form values
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } 
    else {
        // Prepare query
        $query = "SELECT id, email, password, first_name FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user) {
                $error = "User not found.";
            } 
            else {
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Store session data
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['first_name'] = $user['first_name'];

                    // Redirect to dashboard
                    header("Location: dashboard.php");
                    exit();
                } 
                else {
                    $error = "Incorrect email or password.";
                }
            }
        } 
        else {
            $error = "Something went wrong. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <h1>Personal Query Tracker</h1>

    <p>Dreaming of being a published author? We're here to help! Track your literary agent queries in one place. Please log in to access your dashboard.</p>

    <h2>Login</h2>

    <!-- Error Message -->
    <?php if (!empty($error)) : ?>
        <div class="error-message">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post">
        <div>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <!-- <?php

    // echo password_hash('books', PASSWORD_DEFAULT);

    ?> -->

</body>
</html>
