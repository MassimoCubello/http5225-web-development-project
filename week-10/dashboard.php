<?php 

    $page_title = "Dashboard";

?>
<?php require_once('components/header.php'); ?>

<h1>Welcome to the Dashboard</h1>
<p>Welcome, <?= $_SESSION['email'] ?>!</p> <!-- Display the logged-in user's email from the session -->

<h2>Your Blog Posts</h2>
<div class="mb-3">
    <a href="add-post.php" type="button" class="btn btn-primary">Add Blog Post</a> <!-- Button to add a new blog post -->
</div>
<p>You can manage your blog posts here.</p>

<?php require_once('components/footer.php'); ?>