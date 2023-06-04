<?php
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
    // Update the appointment state to 'rejected'
    $appointmentQuery = "
    UPDATE appointments
    SET ap_state = 'rejected'
    WHERE ap_id = $appointment_id;
    ";

    // Execute the appointment update query
    mysqli_query($connection, $appointmentQuery);

    // Delete the associated sessions
    $sessionQuery = "
    DELETE FROM doctor_sessions
    WHERE appon_id = $appointment_id;
    ";

    // Execute the session deletion query
    mysqli_query($connection, $sessionQuery);

    // Commit the transaction
    mysqli_commit($connection);

    // Success message
    echo "Appointment marked as rejected and associated sessions removed.";
} catch (Exception $e) {
    // Rollback the transaction
    mysqli_rollback($connection);

    // Error message
    echo "Error marking appointment as rejected and removing associated sessions: " . mysqli_error($connection);
}
