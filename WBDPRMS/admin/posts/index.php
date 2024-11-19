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
    <link rel="stylesheet" href="./style.css">
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
                        <form action="../../includes/admin/postEventController.php" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                <h4 class="card-title">Post an Event!</h4>
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" name="post_title" placeholder="Write something..." id="floatingTextarea1"></textarea>
                                    <label for="floatingTextarea1">Add a title...</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" name="post_description" placeholder="Write something..." id="floatingTextarea2"></textarea>
                                    <label for="floatingTextarea2">Write a description...</label>
                                </div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <img id="imagePreview" src="" alt="Image Preview" class="img-fluid">
                                </div>
                                <div class="mt-4">
                                    <label for="imgUpload">Upload a Photo!</label>
                                    <br>
                                    <div class="p-2.5 file-input">
                                        <input type="file" name="post_image" id="imgUpload" accept="image/*" required>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-round" name="submit_post" value="Post">
                            </div>
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
     
    <script>
        document.getElementById('imgUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the image if a file is selected
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none'; // Hide the image if no file is selected
                imagePreview.src = ""; // Clear the src attribute
            }
        });
    </script>
</div>

</body>
</html>