<?php

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);
$patient_id = $_GET["patient_id"];
$query = "
SELECT
    doc_id AS doctor_id
FROM
    patients
WHERE
    id = $patient_id;
";
$result = mysqli_query($connection, $query);
if ($result) {
    // Check if a doctor's ID is found
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $doctor_id = $row['doctor_id'];

        // Use the $doctor_id for further processing or output

    } else {
        // No doctor found for the patient
        echo "No doctor found for the patient.";
    }
} else {
    // Error occurred during the query execution
    echo "Error fetching doctor's ID: " . mysqli_error($connection);
}


// $doctor_id = $_GET["doctor_id"];

// not sure yet about the hours thing
$date = $_GET['date'];

// $scheduled_for = DateTime::createFromFormat("d-m-Y", $date)->format("d-m-Y");
// $date = date_format($date, 'Y-m-d');
// $date = date_create_from_format('Y-m-d', $date);
echo "Date is:" . $date;
$state = "pending";
// $scheduled_for = date('Y-m-d H:i:s'); // Replace with the desired scheduled date and time


// Insert the appointment
$query = "
INSERT INTO appointments (patient_id, doc_id, scheduled_for, ap_state)
VALUES ($patient_id, $doctor_id, '$date', '$state');
";

echo $query;

$result = mysqli_query($connection, $query);

// Check if the insertion was successful
if ($result) {
    // Appointment created
    echo "Appointment created with a pending state.";
} else {
    // Error occurred during the insertion
    echo "Error creating appointment: " . mysqli_error($connection);
}
