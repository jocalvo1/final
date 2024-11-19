<?php
if (session_id() == '') {
  session_start();
}
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_announcement'])) {
    $title = $_POST['announcement_title'];
    $description = $_POST['announcement_description'];

    // Insert post into the database
    $query = "INSERT INTO tbl_announcement (announcement_title, announcement_description) VALUES ('$title', '$description')";
    mysqli_query($mysqli, $query);
    header('Location: ../../admin/posts/announcement.php');
}
