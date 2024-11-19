<?php
if (session_id() == '') {
  session_start();
}
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && isset($_GET['appointment_id'])) {
        $appointmentId = $_GET['appointment_id'];
        $action = $_GET['action'];
        
        if ($action === 'approve') {
            // Update the appointment status to 'approved'
            $query = "UPDATE tbl_appointment SET appointment_status = 'Approved' WHERE appointment_id = ?";
        } elseif ($action === 'decline') {
            // Update the appointment status to 'declined'
            $query = "UPDATE tbl_appointment SET appointment_status = 'Declined' WHERE appointment_id = ?";
        }

        // Prepare and execute the statement if a valid action was provided
        if (isset($query) && $stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            $stmt->close();

            // Set a session message for feedback
            session_start();
            $_SESSION['status'] = "Appointment has been " . $action . "d.";
        }

        header("Location: ../../admin/appointment/pending.php"); // Redirect back to your appointments page
        exit();
    }
}

// Handle form submissions from the edit status modal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_id']) && isset($_POST['appointment_status'])) {
        $appointmentId = $_POST['appointment_id'];
        $appointmentStatus = $_POST['appointment_status'];

        // Update the appointment status based on the submitted form
        $query = "UPDATE tbl_appointment SET appointment_status = ? WHERE appointment_id = ?";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("si", $appointmentStatus, $appointmentId);
            $stmt->execute();
            $stmt->close();

            // Set a session message for feedback
            session_start();
            $_SESSION['status'] = "Appointment status has been successfully updated to " . ucfirst($appointmentStatus) . ".";
        }

        header("Location: ../../admin/appointment/index.php"); // Redirect back to your appointments page
        exit();
    }
}

// Fetch all appointments from the database
$queryAllAppointments = "SELECT a.*, 
                            u.user_firstName, 
                            u.user_lastName, 
                            u.user_midInitial, 
                            u.user_username, 
                            u.user_sex, 
                            u.user_birthDate, 
                            u.user_contactNumber, 
                            u.user_address 
                        FROM tbl_appointment a 
                        JOIN tbl_user u ON a.user_id = u.user_id 
                        ORDER BY a.appointment_date DESC";

$resultAllAppointments = $mysqli->query($queryAllAppointments);


// Fetch pending appointments from the database
$queryPendingAppointments = "SELECT a.*, u.user_firstName, u.user_lastName, u.user_midInitial, u.user_username, u.user_sex, u.user_birthDate, u.user_contactNumber, u.user_address 
                             FROM tbl_appointment a 
                             JOIN tbl_user u ON a.user_id = u.user_id 
                             WHERE a.appointment_status = 'Pending' 
                             ORDER BY a.appointment_date DESC";

$resultPendingAppointments = $mysqli->query($queryPendingAppointments);

// Initialize an array to hold all appointments
$appointments = [];

// Fetch all appointments into a single array
while ($row = $resultPendingAppointments->fetch_assoc()) {
    $appointments[] = $row;
}




$queryApprovedAppointments = "SELECT a.*, u.user_firstName, u.user_lastName, u.user_midInitial, u.user_suffix, u.user_username, u.user_sex, u.user_birthDate, u.user_contactNumber, u.user_address 
                             FROM tbl_appointment a 
                             JOIN tbl_user u ON a.user_id = u.user_id 
                             WHERE a.appointment_status = 'Approved' 
                             ORDER BY a.appointment_date DESC";

$resultApprovedAppointments = $mysqli->query($queryApprovedAppointments);

// Initialize an array to hold all appointments
$approvedAppointments = [];

// Fetch all appointments into a single array
while ($appointment = $resultApprovedAppointments->fetch_assoc()) {
    $approvedAppointments[] = $appointment;
}