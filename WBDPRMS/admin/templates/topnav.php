<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand">Welcome, <?php echo $_SESSION['admin_username']; ?>!</a>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <a href="../../includes/logout.php" class="nav-link mr-5 ml-3">
        <i class="fas fa-power-off mr-2" style="font-size:small"></i>Logout
      </a>
    </div>
  </div>
</nav>