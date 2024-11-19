<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../index.php");
    exit();
}

include('../../includes/admin/appointmentController.php');
include('../../admin/appointment/downloadController.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBDPRMS - Appointment Records</title>
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
        .reason {
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
                            <button class="btn btn-info btn-round" id="downloadAppointment" name="download_csv">
                                Download as CSV <i class="fa fa-download"></i>
                            </button>
                        </form>
                        <button class="btn btn-secondary btn-round" id="printAppointment" onclick="printTable()">
                            Print <i class="fa fa-print"></i>
                        </button>
                        <a href="../../admin/appointment/index.php" class="btn btn-danger btn-round">Back <i class="fa fa-arrow-left-long"></i></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="../../pictures/Sunn.png" alt="SUNN Logo" class="img-fluid" style="width: 100px; height: 100px; object-fit: contain;">
                                    </div>
                                    <div class="col text-center">
                                        <h1 class="h1 mb-0">Appointment Records</h1>
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
                                 <table class="table table-responsive" id="printTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center col-1">#</th>
                                            <th class="col-2">Full Name</th>
                                            <th class="col-2">Appointment Date</th>
                                            <th class="col-1">Sex</th>
                                            <th class="col-1">Age</th>
                                            <th class="col-2">Address</th>
                                            <th class="col-3">Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($approvedAppointments)) {
                                            echo '<tr><td colspan="7" class="text-center">No pending appointments!</td></tr>';
                                        } else {
                                            $counter = 1;
                                            foreach ($approvedAppointments as $appointment):
                                                $formattedAppointmentDate = (new DateTime($appointment['appointment_date']))->format('F j, Y');
                                                $fullName = trim($appointment['user_firstName'] . ' ' . $appointment['user_midInitial'] . ' ' . $appointment['user_lastName'] . ($appointment['user_suffix'] ? ' ' . $appointment['user_suffix'] : ''));
                                                $age = date_diff(date_create($appointment['user_birthDate']), date_create('today'))->y;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $counter++; ?></td>
                                            <td><?php echo $fullName; ?></td>
                                            <td><?php echo $formattedAppointmentDate; ?></td>
                                            <td><?php echo $appointment['user_sex']; ?></td>
                                            <td><?php echo $age; ?></td>
                                            <td><?php echo $appointment['user_address']; ?></td>
                                            <td class="reason"><?php echo nl2br($appointment['appointment_reason']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../templates/footer.php'; ?>
        </div>
    </div>

    <script src="../../admin/print/printAppointment.js"></script>
</body>
</html>
