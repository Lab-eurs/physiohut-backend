<?php

$data = array();

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);

$appointment_id = $_GET['ap_id'];


mysqli_begin_transaction($connection);

try {
    // Update the appointment state to 'completed'
    $appointmentQuery = "
    UPDATE appointments
    SET ap_state = 'completed', completed_at_time = NOW()
    WHERE ap_id = $appointment_id;
    ";

    // Execute the appointment update query
    mysqli_query($connection, $appointmentQuery);

    // Update the associated sessions state to 'completed'
    $sessionQuery = "
    UPDATE doctor_sessions
    SET sess_state = 'completed', completed_at_time = NOW()
    WHERE appon_id = $appointment_id;
    ";

    // Execute the session update query
    mysqli_query($connection, $sessionQuery);

    // Commit the transaction
    mysqli_commit($connection);

    // Success message
    echo "Appointment and associated sessions marked as completed.";
} catch (Exception $e) {
    // Rollback the transaction
    mysqli_rollback($connection);

    // Error message
    echo "Error marking appointment and associated sessions as completed: " . mysqli_error($connection);
}
