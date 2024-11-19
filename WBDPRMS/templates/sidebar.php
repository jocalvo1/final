<div class="sidebar" data-color="white">
  <div class="logo" style="text-align: center">
    <a href="../../user/main/index.php" class="simple-text logo-normal">Barangay Rizal</a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav flex-column">
      <li>
        <a href="../../user/main/index.php" style="font-size: 15px">
            <i class="fas fa-home m-0" style="font-size:small"></i>
            <p class="ml-1" style="font-size: 15px">Home</p>
        </a>
      </li>
      <li>
        <a href="../../user/events/index.php" style="font-size: 15px">
            <i class="fas fa-newspaper m-0" style="font-size:small"></i>
            <p class="ml-1" style="font-size: 15px">Events</p>
        </a>
      </li>
      <li>
        <a href="../../user/announcements/index.php" style="font-size: 15px">
            <i class="fas fa-bullhorn m-0" style="font-size:small"></i>
            <p class="ml-1" style="font-size: 15px">Announcements</p>
        </a>
      </li>
      <li>
        <a href="../../user/appointment/index.php" style="font-size: 15px">
            <i class="fas fa-calendar-check m-0" style="font-size:small"></i>
            <p class="ml-1" style="font-size: 15px">Appointments</p>
        </a>
      </li>

      <?php if (isset($_SESSION['user_username'])): ?>
        <li>
          <a href="../../user/profile/index.php" style="font-size: 15px">
            <i class="fas fa-user m-0" style="font-size:small"></i>
            <p class="ml-1" style="font-size: 15px">Profile</p>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</div>