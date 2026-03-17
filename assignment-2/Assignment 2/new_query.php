<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new mysqli("localhost", "root", "root", "personal_query_tracker", 8889);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $agent_name = trim($_POST['agent_name']);
    $agency_name = trim($_POST['agency_name']);
    $submission_date = $_POST['submission_date'];
    $status = $_POST['status'];
    $notes = trim($_POST['notes']);
    $user_id = $_SESSION['id'];

    // Basic validation
    if (empty($agent_name) || empty($agency_name) || empty($submission_date)) {
        $error = "Please fill in all required fields.";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO queries (user_id, agent_name, agency_name, submission_date, status, notes)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("isssss", $user_id, $agent_name, $agency_name, $submission_date, $status, $notes);

        if ($stmt->execute()) {
            // Redirect back to dashboard after success
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error saving query.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Query</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Add New Query</h1>

<?php if (!empty($error)) : ?>
    <div class="error-message">
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="post">
    <div>
        <label>Agent Name:</label>
        <input type="text" name="agent_name" required>
    </div>

    <div>
        <label>Agency Name:</label>
        <input type="text" name="agency_name" required>
    </div>

    <div>
        <label>Submission Date:</label>
        <input type="date" name="submission_date" required>
    </div>

    <div>
        <label>Status:</label>
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="Accepted">Accepted</option>
            <option value="Rejected">Rejected</option>
        </select>
    </div>

    <div>
        <label>Notes:</label>
        <textarea name="notes"></textarea>
    </div>

    <button type="submit">Save Query</button>
</form>

<div class="back-link">
    <a class="btn-link" href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>