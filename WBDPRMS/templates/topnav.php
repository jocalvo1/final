<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <?php if (isset($_SESSION['user_username'])): ?>
        <a class="navbar-brand">Welcome back, <?php echo $title . " " . $_SESSION['user_lastname']; ?>!</a>
      <?php else: ?>
        <a class="navbar-brand">Welcome back, User!</a>
      <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <?php if (isset($_SESSION['user_username'])): ?>
        <a href="../../includes/logout.php" class="nav-link mr-5">
          <i class="fas fa-power-off mr-2" style="font-size:small"></i>Logout
        </a>
      <?php else: ?>
      <a href="../../user/index.php" class="nav-link mr-5">
        <i class="fas fa-power-off mr-2" style="font-size:small"></i>Login
      </a>
      <?php endif; ?>
    </div>
  </div>
</nav>