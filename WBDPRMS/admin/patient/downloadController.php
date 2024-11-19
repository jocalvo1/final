<?php
if (isset($_POST['download_csv'])) {
    // Start output buffering to prevent accidental output
    ob_start();

    // Include database connection
    include_once('../../includes/conn.php');

    // Fetch approved patients
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

    // Set headers to force CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="patient_records_' . date('Y-m-d_H-i-s') . '.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Add CSV headers
    fputcsv($output, ['#', 'Full Name', 'Age', 'Sex', 'Date Added', 'Address', 'Chief Complaint', 'Referral', 'Remarks']);

    // Add patient data
    $counter = 1;
    foreach ($approvedPatients as $row) {
        $formattedDate = (new DateTime($row['created_at']))->format('M. j, Y');
        $Name = trim($row['patient_fName'] . ' ' . $row['patient_midInitial'] . ' ' . $row['patient_lName'] . ($row['patient_suffix'] ? ' ' . $row['patient_suffix'] : ''));

        fputcsv($output, [
            $counter++,
            $Name,
            $row['patient_age'],
            $row['patient_sex'],
            $formattedDate,
            $row['patient_address'],
            $row['patient_complaint'],
            $row['patient_referral'],
            $row['patient_remarks']
        ]);
    }

    // Close output stream
    fclose($output);
    exit();
}
?>
