<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include "../../includes/admin/postEventController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Post Event</title>
    <?php
    include '../../templates/links.php';
    ?>
</head>
<body>
    
<div class="wrapper">
<!-- SIDEBAR Start -->
<?php
include '../templates/sidebar.php';
?>
<!-- SIDEBAR End -->
    <div class="main-panel">
    <!-- TOPNAV Start -->
    <?php
    include '../templates/topnav.php';
    ?>
    <!-- TOPNAV End -->
        <div class="content">
        <!-- CONTENT Start -->

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <form action="../../includes/admin/postAnnouncementController.php" method="post">
                        <div class="card-header">
                            <h4 class="card-title">Post an Announcement!</h4>
                            <div class="form-floating">
                                <textarea class="form-control" name="announcement_title" placeholder="Title..." id="announcement_title"></textarea>
                                <label for="announcement_title">Title...</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-floating">
                                <textarea class="form-control" name="announcement_description" placeholder="Title..." id="announcement_descrip" style="height: 100px"></textarea>
                                <label for="announcement_descrip">Write Something...</label>
                            </div>
                            <input type="submit" class="btn btn-round btn-primary" name="submit_announcement" value="Announce">
                        </div>
                    <!-- <textarea name="announcement_title" placeholder="Title..."></textarea><br>
                    <textarea name="announcement_description" placeholder="Description..." required></textarea><br>
                    <input type="submit" name="submit_announcement" value="Post"> -->
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <!-- CONTENT End -->
        </div>
    <?php
    include '../../templates/footer.php';
    ?>
    </div>
</div>

</body>
</html>