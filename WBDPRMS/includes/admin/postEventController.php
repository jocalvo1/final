<?php
if (session_id() == '') {
  session_start();
}
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
    $title = $_POST['post_title'];
    $description = $_POST['post_description'];
    $image = null;

    // Handling image upload if provided
    if (!empty($_FILES['post_image']['name'])) {
        $image_name = time() . '_' . $_FILES['post_image']['name'];
        $target_dir = '../../pictures/events/';
        $target_file = $target_dir . $image_name;
        
        // Validate and move the uploaded file
        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $target_file)) {
            $image = $image_name;
        }
    }

    // Insert post into the database
    $query = "INSERT INTO tbl_post (post_title, post_description, post_image) VALUES ('$title', '$description', '$image')";
    mysqli_query($mysqli, $query);
    header('Location: ../../admin/posts/index.php');
}
?>
