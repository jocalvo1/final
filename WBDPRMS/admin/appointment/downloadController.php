<?php

if (isset($_POST['download_csv'])) {
    // Set the headers to force the download of the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="appointment_records_' . date('Y-m-d_H-i-s') . '.csv"');
    
    // Open PHP output as a file pointer
    $output = fopen('php://output', 'w');
    
    // Add CSV headers
    fputcsv($output, ['#', 'Full Name', 'Appointment Date', 'Sex', 'Age', 'Address', 'Reason']);
    
    // Add data to the CSV file
    $counter = 1;
    if (!empty($approvedAppointments)) {
        foreach ($approvedAppointments as $appointment) {
            $formattedAppointmentDate = (new DateTime($appointment['appointment_date']))->format('F j, Y');
            $fullName = trim($appointment['user_firstName'] . ' ' . $appointment['user_midInitial'] . ' ' . $appointment['user_lastName'] . ($appointment['user_suffix'] ? ' ' . $appointment['user_suffix'] : ''));
            $age = date_diff(date_create($appointment['user_birthDate']), date_create('today'))->y;
            
            // Write each row to the CSV file
            fputcsv($output, [
                $counter++,
                $fullName,
                $formattedAppointmentDate,
                $appointment['user_sex'],
                $age,
                $appointment['user_address'],
                $appointment['appointment_reason']
            ]);
        }
    }

    // Close the output stream
    fclose($output);
    exit();
}