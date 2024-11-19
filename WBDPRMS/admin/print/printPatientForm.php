<?php
require('../../includes/admin/patientManagementController.php');


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
            /* Hide the Actions column and any elements you don't want to print */
            #printPatientForm, /* Hide print button */
            .btn-danger { /* Hide the back button */
                display: none;
            }

            /* Ensure that the content takes up the full page */
            body {
                margin: 0;
                padding: 0;
                font-size: 12px;
            }

            .wrapper {
                width: 100%;
                padding: 10px;
            }

            /* Optional: Customize the print styling for the form */
            .card-body {
                padding: 0;
            }

            .form-group label {
                font-weight: bold;
            }

            .form-control {
                width: 100%;
                border: 1px solid #000;
                padding: 5px;
            }
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
                        <button class="btn btn-secondary btn-round" id="printPatientForm" onclick="printForm()">
                            Print <i class="fa fa-print"></i>
                        </button>
                        <a href="../../admin/patient/addPatient.php" class="btn btn-danger btn-round">Back <i class="fa fa-arrow-left-long"></i></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col text-center">
                                        <h2 class="card-title">Patient Form</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label>Middle Initial</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label>Suffix</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Sex</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label>Chief Complaint</label>
                                        <input class="form-control" style="height: 100px">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Referral place</label>
                                        <input class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input class="form-control" style="height: 100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../templates/footer.php'; ?>
        </div>
    </div>

    <script src="../../admin/print/printPatientForm.js"></script>
</body>
</html>
