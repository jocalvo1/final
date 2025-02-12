<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include('../../includes/admin/staffManagementController.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WBDPRMS - Account Management | Registered Staff Accounts</title>
  <?php include '../../templates/links.php'; ?>
</head>

<body>
  <div class="wrapper">
    <?php include '../templates/sidebar.php'; ?>
    <div class="main-panel">
      <?php include '../templates/topnav.php'; ?>
      <div class="content">
        <div class="row">
          <div class="card table-with-links">
            <div class="card-header">
              <div>
                <h4 class="card-title float-start">Registered Staff Accounts</h4>
                <div class="float-end">
                  <a href="../../admin/accounts/staffPending.php" class="btn btn-info btn-round">Show Pending Accounts</a>
                </div>
              </div>
              <input type="text" id="staffSearchApproved" class="form-control" placeholder="Search by name.">
            </div>
            <div class="card-body table-full-width">
              <table class="table" id="approvedStaffTable">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="m-0 p-0">Profile</th>
                    <th>Full Name</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $counter = 1;
                  while ($row = $resultApproved->fetch_assoc()) {
                    $fullName = $row['staff_firstName'] . ' ' . $row['staff_midInitial'] . ' ' . $row['staff_lastName'] . ' ' . ($row['staff_suffix'] ? $row['staff_suffix'] : '');
                    $age = date_diff(date_create($row['staff_birthDate']), date_create('today'))->y;

                    $formattedDate = (new DateTime($row['created_at']))->format('F j, Y');
                    echo "<tr>";
                    echo "<td class='text-center'>$counter</td>";
                    echo "<td class='m-0 p-0'><img src='{$row['staff_photo']}' class='img-fluid rounded-circle' style='object-fit:cover; height: 40px; width: 40px'></td>";
                    echo "<td>$fullName</td>";
                    echo "<td>{$row['staff_sex']}</td>";
                    echo "<td>$age</td>";
                    echo "<td>$formattedDate</td>";
                    echo "<td class='td-actions'>
                            <a href='#' data-toggle='modal' data-target='#viewModalApproved{$row['staff_id']}' class='btn btn-info btn-link btn-xs'><i class='fa fa-eye'></i></a>
                            <a href='./editstaff.php?staff_id={$row['staff_id']}' class='btn btn-success btn-link btn-xs'><i class='fa fa-edit'></i></a>
                            <a href='#' data-toggle='modal' data-target='#deleteModal{$row['staff_id']}' class='btn btn-danger btn-link btn-xs'><i class='fa fa-trash'></i></a>
                          </td>";
                    echo "</tr>";

                    // Modal for viewing staff details
                    echo "<div class='modal fade' id='viewModalApproved{$row['staff_id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title'>Staff Details - {$row['staff_username']}</h5>
                                <button type='button'  class='close btn btn-danger btn-sm' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'><i class='fa fa-xmark'></i></span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <img src='{$row['staff_photo']}' class='img-fluid mb-2' style='object-fit: cover'>
                                <p><strong>Full Name:</strong> $fullName</p>
                                <p><strong>Sex:</strong> {$row['staff_sex']}</p>
                                <p><strong>Age:</strong> $age</p>
                                <p><strong>Birthdate:</strong> {$row['staff_birthDate']}</p>
                                <p><strong>Contact Number:</strong> {$row['staff_contactNumber']}</p>
                                <p><strong>Address:</strong> {$row['staff_address']}</p>
                                <p><strong>Date Registered:</strong> $formattedDate</p>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                              </div>
                            </div>
                          </div>
                        </div>";

                    // Modal for delete confirmation
                    echo "<div class='modal fade' id='deleteModal{$row['staff_id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'>Confirm Deletion</h5>
                                <button type='button'  class='close btn btn-danger btn-sm' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'><i class='fa fa-xmark'></i></span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                Are you sure you want to delete <strong>$fullName</strong>? This action cannot be undone.
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                <a href='?action=delete&staff_id={$row['staff_id']}' class='btn btn-danger'>Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>";

                    $counter++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php include '../../templates/footer.php'; ?>
    </div>
  </div>

  <script>
    document.getElementById('staffSearchApproved').addEventListener('keyup', function() {
      var searchValue = this.value.toLowerCase();
      var tableRows = document.querySelectorAll('#approvedStaffTable tbody tr');
      tableRows.forEach(function(row) {
        var fullName = row.cells[1].textContent.toLowerCase();
        if (fullName.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>