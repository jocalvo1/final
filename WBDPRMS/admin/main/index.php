<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
require ('../../includes/admin/dashboardController.php');


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Home</title>
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
        <!-- Your content goes here -->
        <div class="row">
          <div class="col-md-3">
            <div class="card card-user">
              <div class="image">
                <img src="../../pictures/admin/user_image.jpg" alt="...">
              </div>
              <div class="card-body mb-">
                <p class="text-primary fs-2 text-center mt-4">
                  User Accounts
                </p>
                <p class="text-center mb-4 fs-2">
                  <?php echo $totalUsers; ?>
                </p>
                <hr>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countPendingUsers ?></h5>
                    <a href="../../admin/accounts/userPending.php"><small>PENDING</small></a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countApprovedUsers ?></h5>
                    <a href="../../admin/accounts/index.php"><small>REGISTERED</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card card-user">
              <div class="image">
                <img src="../../pictures/admin/users.jpg" alt="...">
              </div>
              <div class="card-body mb-">
                <p class="text-primary fs-2 text-center mt-4">
                  Staff Accounts
                </p>
                <p class="text-center mb-4 fs-2">
                  <?php echo $totalStaffs; ?>
                </p>
                <hr>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countPendingStaffs ?></h5>
                    <a href="../../admin/accounts/staffPending.php"><small>PENDING</small></a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countApprovedStaffs ?></h5>
                    <a href="../../admin/accounts/staff.php"><small>REGISTERED</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card card-user">
              <div class="image">
                <img src="../../pictures/admin/users.jpg" alt="...">
              </div>
              <div class="card-body mb-">
                <p class="text-primary fs-2 text-center mt-4">
                  Patient Records
                </p>
                <p class="text-center mb-4 fs-2">
                  <?php echo $totalPatients; ?>
                </p>
                <hr>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countPendingPatients ?></h5>
                    <a href="../../admin/patient/pending.php"><small>PENDING</small></a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countApprovedPatients ?></h5>
                    <a href="../../admin/patient/index.php"><small>REGISTERED</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card card-user">
              <div class="image">
                <img src="../../pictures/admin/users.jpg" alt="...">
              </div>
              <div class="card-body mb-">
                <p class="text-primary fs-2 text-center mt-4">
                  Appointments
                </p>
                <p class="text-center mb-4 fs-2">
                  <?php echo $totalAppointments; ?>
                </p>
                <hr>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countPendingAppointments ?></h5>
                    <a href="../../admin/appointment/pending.php"><small>PENDING</small></a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countApprovedAppointments ?></h5>
                    <a href="../../admin/appointment/index.php"><small>APPROVED</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="card card-user">
              <div class="image">
                <img src="../../pictures/admin/users.jpg" alt="...">
              </div>
              <div class="card-body mb-">
                <p class="text-primary fs-2 text-center mt-4">
                  Posts
                </p>
                <p class="text-center mb-4 fs-2">
                  <?php echo $totalPosts; ?>
                </p>
                <hr>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countEvents; ?></h5>
                    <a href="../../admin/posts/index.php"><small>EVENTS</small></a>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto text-center">
                    <h5><?php echo $countAnnouncements; ?></h5>
                    <a href="../../admin/posts/announcement.php"><small>ANNOUNCEMENTS</small></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card table-with-links">
              <div class="card-header">
                  <div>
                      <h4 class="card-title float-start">Today's Appointments</h4>
                  </div>
              </div>
              <div class="card-body table-full-width">
                  <table class="table" id="appointmentTable">
                      <thead>
                          <tr>
                              <th class="text-center">#</th>
                              <th>Full Name</th>
                              <th>Appointment Date</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          if (!empty($todayAppointments)) {
                              foreach ($todayAppointments as $index => $appointment) {
                                  $appointmentDate = new DateTime($appointment['appointment_date']);
                                  $formattedDate = $appointmentDate->format('F j, Y');
                          ?>
                                  <tr>
                                      <td class="text-center"><?php echo $index + 1; ?></td>
                                      <td>
                                          <?php
                                          echo $appointment['user_firstName'] . ' ' . $appointment['user_midInitial'] . ' ' . $appointment['user_lastName'] . ' ' . $appointment['user_suffix'];
                                          ?>
                                      </td>
                                      <td><?php echo $formattedDate; ?></td>
                                      <td class="td-actions">
                                          <a href="#" data-toggle="modal" data-target="#viewModal<?php echo $appointment['appointment_id']; ?>" class="btn btn-info btn-link btn-xs" title="View">
                                              <i class="fa fa-eye"></i>
                                          </a>
                                      </td>
                                  </tr>
                                  <!-- Modal -->
                                  <div class="modal fade" id="viewModal<?php echo $appointment['appointment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">User Profile</h5>
                                                  <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true"><i class="fa fa-xmark"></i></span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <p><strong>Full Name:</strong> <?php echo $appointment['user_firstName'] . ' ' . $appointment['user_midInitial'] . ' ' . $appointment['user_lastName']; ?></p>
                                                  <p><strong>Sex:</strong> <?php echo $appointment['user_sex']; ?></p>
                                                  <p><strong>Age:</strong> <?php echo date_diff(date_create($appointment['user_birthDate']), date_create('today'))->y; ?></p>
                                                  <p><strong>Birthdate:</strong> <?php echo $appointment['user_birthDate']; ?></p>
                                                  <p><strong>Contact Number:</strong> <?php echo $appointment['user_contactNumber']; ?></p>
                                                  <p><strong>Address:</strong> <?php echo $appointment['user_address']; ?></p>
                                                  <p><strong>Date Registered:</strong> <?php echo $appointment['created_at']; ?></p>
                                                  <hr>
                                                  <p><strong>Appointment Date:</strong> <?php echo $formattedDate; ?></p>
                                                  <p><strong>Appointment Reason:</strong> <?php echo $appointment['appointment_reason']; ?></p>
                                                  <p><strong>Appointment Status:</strong> <?php echo ucfirst($appointment['appointment_status']); ?></p>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                          <?php
                              }
                          } else {
                              echo '<tr><td colspan="4" class="text-center">No appointments scheduled for today.</td></tr>';
                          }
                          ?>
                      </tbody>
                  </table>
              </div>
              <div class="card-footer text-center">
                <a href="../../admin/appointment/index.php" class="btn btn-round btn-secondary">View All</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include '../../templates/footer.php';
      ?>
    </div>
  </div>
</body>

</html>