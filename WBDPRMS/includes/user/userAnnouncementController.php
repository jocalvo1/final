<?php
include '../../includes/conn.php';

// Fetch announcements from the database
$result = mysqli_query($mysqli, "SELECT * FROM tbl_announcement ORDER BY created_at DESC");

if (!$result) {
    echo "Error fetching announcements: " . mysqli_error($mysqli);
    exit;
}
