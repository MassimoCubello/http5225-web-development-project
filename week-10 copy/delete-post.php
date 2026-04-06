<?php 
    $page_title = "Delete Blog Post";
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

// end of post authentication and retrieval logic





if(isset($_POST['title']) || empty($_POST['post']))
{
    $isValid = true;
    if(empty($_POST['title']) || empty($_POST['post']))
    {
        $isValid = false;
    }
    elseif(empty($_POST['image']) || filter_var($_POST['image'], FILTER_VALIDATE_URL) == false)
    {
        $isValid = false;
    }

    if($isValid)
        {
            $imageurl = null;
            if(!empty($_POST['image'])) $imageurl = trim($_POST['image']);
            $query = "UPDATE blog_posts SET title = ?, image_href = ?, post = ? WHERE user_id = ? AND id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sssii',
                trim($_POST['title']),
                $imageurl,
                trim($_POST['post']),
                $_SESSION['id'],
                $_GET['id']
            );
            if($stmt->execute() == false)
                {
                    echo "Execute failed: " . $stmt->error;
                }
            else
                {
                    $_SESSION['success'] = "Blog post has been updated successfully!"; // Set a success message in the session
                    header("Location: post-details.php?id=" . $_GET['id']);
                    
                }
        }
}
?>

<h1>Delete Blog Post</h1>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="post-details.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></li>
    <li class="breadcrumb-item active" aria-current="page">Delete</li>
  </ol>
</nav>

<div class="mb-3">
    <?php if(isset($isValid) && $isValid == false) : ?>
        <div class="alert alert-danger" role="alert"> 
            There was an error deleting the blog post. 
        </div>
    <?php endif; ?>

    <p>Use the form below to delete your blog post. This action cannot be undone.</p>
</div>
<form action="delete-post.php?id=<?= $post['id'] ?>" method="post">

    <div class="alert alert-danger" role="alert"> 
        Are you sure you want to delete the blog post titled "<?= $post['title'] ?>"? This action cannot be undone.
    </div>

    <a href="/post-details.php?id=<?= $post['id'] ?>" class="btn btn-secondary">Cancel</a>     
    <input type="submit" class="btn btn-danger" value="Delete" name="submit">
</form>

<?php require_once('components/footer.php'); ?>