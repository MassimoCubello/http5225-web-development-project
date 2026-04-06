<?php 
    $page_title = "Add Blog Post";
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
            $query = "INSERT INTO blog_posts (user_id, title, post, image_href) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('isss',
                $_SESSION['id'], // Get the user ID from the session to associate the blog post with the logged-in user
                trim($_POST['title']),
                trim($_POST['post']),
                $imageurl
            );
            if($stmt->execute() == false)
                {
                    echo "Execute failed: " . $stmt->error;
                }
            else
                {
                    $result = $stmt->insert_id; // Get the ID of the newly inserted blog post
                    // var_dump($result);
                    $_SESSION['success'] = "New draft blog post has been added successfully!"; // Set a success message in the session
                    header("Location: dashboard.php"); // Redirect to dashboard page after successful addition
                    exit(); // Ensure no further code is executed after the redirect

                }
        }
}
?>

<h1>Add a New Blog Post</h1>

<a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a> <!-- Button to navigate back to the dashboard -->  
<div class="mb-3">
    <?php if(isset($isValid) && $isValid == false) : ?>
        <div class="alert alert-danger" role="alert"> <!-- Bootstrap alert class for error messages -->
            Please fill in all fields correctly, and use a valid URL for the image if your post includes one. <!-- Error message displayed when form validation fails -->
        </div>
    <?php endif; ?>

    <p>Use the form below to add a new blog post. All fields are required.</p>
</div>
<form action="add-post.php" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" required>
    </div>  

    <div class="mb-3">
        <label for="image" class="form-label">Image URL:</label>
        <input type="text" class="form-control" id="image" name="image" aria-describedby="imageHelp" required>
    </div>  

    <div class="mb-3">
        <label for="post" class="form-label">Blog Post Body:</label>
        <textarea class="form-control" id="post" name="post" rows="5" required></textarea>
    </div>

    <input type="submit" class="btn btn-primary" value="Add Post" name="submit">
</form>

<?php require_once('components/footer.php'); ?>