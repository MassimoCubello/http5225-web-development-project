<?php 
    $page_title = "Blog Post Details";
?>
<?php require_once('components/header.php'); ?>

<?php
if(!isset($_SESSION['id']))
{
    header("Location: login.php"); // Redirect to login page if the user is not authenticated
    exit();
}    
if(!isset($_GET['id']) ||!is_numeric($_GET['id']))
{
    header("Location: dashboard.php"); // Redirect to dashboard if the blog post ID is not provided or is not a valid number
    exit();
}

// get blog posts for the logged-in user from database
$query = 'SELECT id, title, date_created, date_published, post, image_href FROM blog_posts WHERE user_id = ? AND id = ? LIMIT 1';
$stmt = $db->prepare($query); 
$stmt->bind_param('ii', $_SESSION['id'], $_GET['id']);
if($stmt->execute() == false)
    {
        echo "Execute failed: " . $stmt->error;
    }
$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);

if(empty($posts)) {
    header("Location: dashboard.php"); // Redirect to dashboard if the blog post is not found
    exit();
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $post['title'] ?></li>
  </ol>
</nav>

<h1><?= $post['title'] ?></h1>
<ul>
    <li>Date Created: <?= $post['date_created'] ?></li>
    <li>Date Published: <?= $post['date_published'] ?></li>
</ul>

<div>
    <form action="" method="post">
        <?php if(empty($post['date_published'])) : ?>
            <button class="btn btn-success" name="publish">Publish Blog Post</button>
        <?php endif; ?>
    </form>

<div>
    <a href="edit-post.php?id=<?= $post['id'] ?>" class="btn btn-secondary">Edit Blog Post</a>
    <a href ="delete-post.php?id=<?= $post['id'] ?>" class="btn btn-danger">Delete Blog Post</a>
</div>


<hr />

<?php if(!empty($post['image_href'])) : ?>
    <img src="<?= $post['image_href'] ?>" class="img-fluid" alt="Blog Post Thumbnail">

<?php endif; ?>

<p><?= $post['post'] ?></p>

<?php require_once('components/footer.php'); ?>