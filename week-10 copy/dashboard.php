<?php 

    $page_title = "Dashboard";

?>
<?php require_once('components/header.php'); ?>


<?php
if(!isset($_SESSION['id']))
{
    header("Location: login.php"); // Redirect to login page if the user is not authenticated
    exit();
}    
?>

<?php

// get blog posts for the logged-in user from database
$query = 'SELECT id, title, date_created, date_published FROM blog_posts WHERE user_id = ?';
$stmt = $db->prepare($query); 
$stmt->bind_param('i', $_SESSION['id']);
if($stmt->execute() == false)
    {
        echo "Execute failed: " . $stmt->error;
    }
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);
var_dump($posts); // Output the retrieved blog posts for debugging purposes

?>

<h1>Welcome to the Dashboard</h1>
<p>Welcome, <?= $_SESSION['email'] ?>!</p> <!-- Display the logged-in user's email from the session -->

<h2>Your Blog Posts</h2>
<div class="mb-3">
    <a href="add-post.php" type="button" class="btn btn-primary">Add Blog Post</a> <!-- Button to add a new blog post -->
</div>

<table class="table"> <!-- Bootstrap table class for styling -->
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Date Created</th>
      <th scope="col">Date Published</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if(empty($posts)) : ?>
        <tr>
            <td class="text-center" colspan="4">You have no blog posts yet.</td> <!-- Message displayed when there are no blog posts -->
        </tr>
    <?php else : ?>
        <?php foreach($posts AS $key => $value) : ?>
            <tr>
                <td><?= $value['title'] ?></td> 
                <td><?= $value['date_created'] ?></td>
                <td><?= $value['date_published'] ?></td>
                <td>
                    <a href="post-details.php?id=<?= $value['id'] ?>" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
            
  </tbody>
</table>

<p>You can manage your blog posts here.</p>

<?php require_once('components/footer.php'); ?>