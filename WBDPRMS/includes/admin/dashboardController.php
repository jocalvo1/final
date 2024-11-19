<?php
if (session_id() == '') {
  session_start();
}
if (!isset($_SESSION['admin_username'])) {
  header("Location: ../index.php");
  exit();
}
include __DIR__ . '/../conn.php';


//USER ACCOUNTS
$queryPendingUsers = "SELECT COUNT(*) AS countPendingUsers FROM tbl_user WHERE user_status = 'pending' ";
$pendingUsers = $mysqli->query($queryPendingUsers);
$countPendingUsers = $pendingUsers->fetch_assoc()['countPendingUsers'];

$queryApprovedUsers = "SELECT COUNT(*) AS countApprovedUsers FROM tbl_user WHERE user_status = 'approved' ";
$approvedUsers = $mysqli->query($queryApprovedUsers);
$countApprovedUsers = $approvedUsers->fetch_assoc()['countApprovedUsers'];

$totalUsers = $countPendingUsers + $countApprovedUsers;



//STAFF ACCOUNTS
$queryPendingStaffs = "SELECT COUNT(*) AS countPendingStaffs FROM tbl_staff WHERE staff_status = 'pending' ";
$pendingStaffs = $mysqli->query($queryPendingStaffs);
$countPendingStaffs = $pendingStaffs->fetch_assoc()['countPendingStaffs'];

$queryApprovedStaffs = "SELECT COUNT(*) AS countApprovedStaffs FROM tbl_staff WHERE staff_status = 'approved' ";
$approvedStaffs = $mysqli->query($queryApprovedStaffs);
$countApprovedStaffs = $approvedStaffs->fetch_assoc()['countApprovedStaffs'];

$totalStaffs = $countPendingStaffs + $countApprovedStaffs;



//POSTS
$queryEvents = "SELECT COUNT(*) AS countEventPost FROM tbl_post";;
$allEvents = $mysqli->query($queryEvents);
$countEvents = $allEvents->fetch_assoc()['countEventPost'];

$queryAnnouncements = "SELECT COUNT(*) AS countAnnouncementPost FROM tbl_announcement";;
$allAnnouncements = $mysqli->query($queryAnnouncements);
$countAnnouncements = $allAnnouncements->fetch_assoc()['countAnnouncementPost'];

$totalPosts = $countEvents + $countAnnouncements;



//PATIENTS
$queryPendingPatients = "SELECT COUNT(*) AS countPendingPatients FROM tbl_patients WHERE patient_status = 'Pending' ";
$pendingPatients = $mysqli->query($queryPendingPatients);
$countPendingPatients = $pendingPatients->fetch_assoc()['countPendingPatients'];

$queryApprovedPatients = "SELECT COUNT(*) AS countApprovedPatients FROM tbl_patients WHERE patient_status = 'Approved'";
$approvedPatients = $mysqli->query($queryApprovedPatients);
$countApprovedPatients = $approvedPatients->fetch_assoc()['countApprovedPatients'];

$totalPatients = $countPendingPatients + $countApprovedPatients;



//APPOINTMENTS
$queryPendingAppointments = "SELECT COUNT(*) AS countPendingAppointments FROM tbl_appointment WHERE appointment_status = 'pending' ";
$pendingAppointments = $mysqli->query($queryPendingAppointments);
$countPendingAppointments = $pendingAppointments->fetch_assoc()['countPendingAppointments'];

$queryApprovedAppoinments = "SELECT COUNT(*) AS countApprovedAppointments FROM tbl_appointment WHERE appointment_status = 'approved'";
$approvedAppointments = $mysqli->query($queryApprovedAppoinments);
$countApprovedAppointments = $approvedAppointments->fetch_assoc()['countApprovedAppointments'];

$totalAppointments = $countPendingAppointments + $countApprovedAppointments;



// Fetch today's appointments from the database
$queryTodayAppointments = "SELECT a.*, 
                                u.user_firstName, 
                                u.user_lastName, 
                                u.user_midInitial, 
                                u.user_suffix, 
                                u.user_username, 
                                u.user_sex, 
                                u.user_birthDate, 
                                u.user_contactNumber, 
                                u.user_address 
                           FROM tbl_appointment a 
                           JOIN tbl_user u ON a.user_id = u.user_id 
                           WHERE a.appointment_date = CURDATE() 
                           ORDER BY a.appointment_date ASC
                           LIMIT 5";

$resultTodayAppointments = $mysqli->query($queryTodayAppointments);

// Initialize an array to hold today's appointments
$todayAppointments = [];

// Fetch today's appointments into the array
if ($resultTodayAppointments && $resultTodayAppointments->num_rows > 0) {
  while ($row = $resultTodayAppointments->fetch_assoc()) {
      $todayAppointments[] = $row;
  }
} else {
  // Debugging output
  echo "No appointments found for today or query failed.";
  echo "Error: " . $mysqli->error; // Show SQL error if any
}