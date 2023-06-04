<?php

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);

$doctor_id = $_GET["doctor_id"];
$patient_id = $_GET["patient_id"];
// not sure yet about the hours thing
$date = $_GET['date'];
$scheduled_for = DateTime::createFromFormat("Y-m-d", $date)->format("Y-m-d");


$state = "pending";
// $scheduled_for = date('Y-m-d H:i:s'); // Replace with the desired scheduled date and time

// Insert the appointment
$query = "
INSERT INTO appointments (patient_id, doc_id, scheduled_for, ap_state)
VALUES ($patient_id, $doctor_id, '$scheduled_for', '$state');
";

$result = mysqli_query($connection, $query);

// Check if the insertion was successful
if ($result) {
    // Appointment created
    echo "Appointment created with a pending state.";
} else {
    // Error occurred during the insertion
    echo "Error creating appointment: " . mysqli_error($connection);
}
