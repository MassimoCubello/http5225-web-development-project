<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "root", "personal_query_tracker", 8889);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch queries for this user
$user_id = $_SESSION['id'];
$stmt = $conn->prepare("
    SELECT agent_name, agency_name, submission_date, status, notes
    FROM queries
    WHERE user_id = ?
    ORDER BY submission_date DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$queries = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Welcome, <?= htmlspecialchars($_SESSION['first_name']) ?>!</h1>
<div class="dashboard-actions">
    <a class="btn-link" href="new_query.php">Add New Query</a>
</div>


<h2>Your Literary Agent Queries</h2>
<p>Keep track of your submissions and their status. Click "Add New Query" to log a new submission.</p>

<?php if (!empty($queries)) : ?>
    <table>
        <tr>
            <th>Agent Name</th>
            <th>Agency Name</th>
            <th>Submission Date</th>
            <th>Status</th>
            <th>Notes</th>
        </tr>
        <?php foreach ($queries as $query) : ?>
            <?php
                // Assign a class based on status
                $statusClass = '';
                switch ($query['status']) {
                    case 'Pending': $statusClass = 'status-pending'; break;
                    case 'Accepted': $statusClass = 'status-accepted'; break;
                    case 'Rejected': $statusClass = 'status-rejected'; break;
                }
            ?>
        <tr>
            <td data-label="Agent Name"><?= htmlspecialchars($query['agent_name']) ?></td>
            <td data-label="Agency Name"><?= htmlspecialchars($query['agency_name']) ?></td>
            <td data-label="Submission Date"><?= htmlspecialchars($query['submission_date']) ?></td>
            <td data-label="Status" class="<?= $statusClass ?>"><?= htmlspecialchars($query['status']) ?></td>
            <td data-label="Notes"><?= htmlspecialchars($query['notes']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>You have not submitted any queries yet.</p>
<?php endif; ?>

<!-- Logout Button -->
<form action="logout.php" method="post" class="logout-form">
    <button type="submit">Logout</button>
</form>

</body>
</html>