<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}

include('../../admin/patient/downloadController.php');
include_once('../../includes/conn.php');

$query = "SELECT patient_id, patient_fName, patient_midInitial, patient_lName, patient_suffix, patient_sex, patient_age, patient_address, patient_complaint, patient_remarks, patient_referral, created_at
          FROM tbl_patients
          WHERE patient_status = 'Approved'
          ORDER BY created_at DESC";

$result = $mysqli->query($query);
if (!$result) {
    die("Query failed: " . $mysqli->error);
}

$approvedPatients = [];
while ($row = $result->fetch_assoc()) {
    $approvedPatients[] = $row;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Patient Records</title>
    <?php include '../../templates/links.php'; ?>
    <style>
            @media print {
            /* Hide the Actions column during printing */
            #downloadAppointment,
            #printAppointment {
                display: none;
            }
        }
        table {
            table-layout: fixed;
            width: 100%;
        }

        /* Allow long text in 'Reason' column to wrap */
        .patient_remark, .chief_complaint, .referral {
            word-wrap: break-word;
            white-space: normal;
            padding-right: 2px;
            margin-right: 3px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../templates/sidebar.php'; ?>
        <div class="main-panel">
            <?php include '../templates/topnav.php'; ?>
            <div class="content">
                <div class="row">
                    <div class="col text-end">
                        <form method="POST" action="" class="d-inline">
                            <button type="submit" class="btn btn-info btn-round" id="downloadPatient" name="download_csv">
                                Download as CSV <i class="fa fa-download"></i>
                            </button>
                        </form>

                        <button class="btn btn-secondary btn-round" id="printPatient" onclick="printPatient()">
                            Print <i class="fa fa-print"></i>
                        </button>
                        <a href="../../admin/patient/index.php" class="btn btn-danger btn-round">Back <i class="fa fa-arrow-left-long"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="card table-with-links">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="../../pictures/Sunn.png" alt="SUNN Logo" class="img-fluid" style="width: 100px; height: 100px; object-fit: contain;">
                                </div>
                                <div class="col text-center">
                                    <h1 class="h1 mb-0">Patient Records</h1>
                                </div>
                                <div class="col-auto">
                                    <img src="../../pictures/Sagay.png" alt="Sagay Logo" class="img-fluid" style="width: 100px; height: 100px; object-fit: contain;">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <div class="row">
                                        <p>Department of Health</p>
                                        <p>Barangay Rizal, Sagay City</p>
                                        <p>Negros Occidental, 6122</p>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                        <div class="card-body table-full-width">
                            <table class="table" id="printPatientTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>Date Added</th>
                                        <th class="col-2">Address</th>
                                        <th class="col-2">Chief Complaint</th>
                                        <th class="col-2">Referral</th>
                                        <th class="col-2">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody
                                    ><?php
                                        if (empty($approvedPatients)) {
                                            echo '<tr><td colspan="7" class="text-center">No pending appointments!</td></tr>';
                                        } else {
                                            $counter = 1;
                                            foreach ($approvedPatients as $row):
                                                $formattedDate = (new DateTime($row['created_at']))->format('M. j, Y');
                                                $Name = trim($row['patient_fName'] . ' ' . $row['patient_midInitial'] . ' ' . $row['patient_lName'] . ($row['patient_suffix'] ? ' ' . $row['patient_suffix'] : ''));
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter++; ?></td>
                                            <td><?php echo $Name; ?></td>
                                            <td><?php echo $row['patient_age']; ?></td>
                                            <td><?php echo $row['patient_sex']; ?></td>
                                            <td><?php echo $formattedDate ?></td>
                                            <td><?php echo $row['patient_address']; ?></td>
                                            <td class="chief_complaint"><?php echo nl2br($row['patient_complaint']); ?></td>
                                            <td class="referral"><?php echo nl2br($row['patient_referral']); ?></td>
                                            <td class="patient_remark"><?php echo nl2br($row['patient_remarks']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../templates/footer.php'; ?>
        </div>
    </div>
    <script src="../../admin/print/printPatientRecord.js"></script>
</body>

</html>
