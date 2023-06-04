<?php
$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);

$doctor_id = $_GET['doctor_id'];
// Assuming you have established a database connection
$doctorId = 123; // Replace with the desired doctor ID

// Query to fetch the data for a specific doctor
// Assuming you have established a database connection
$doctorId = 123; // Replace with the desired doctor ID

// Query to fetch the data for a specific doctor with provision details
$query = "
SELECT
    appointments.ap_state,
    patients.NAME,
    appointments.scheduled_for,
    doctor_sessions.doc_session_id,
    doctor_sessions.provision_id,
    doctor_sessions.appon_id,
    doctor_sessions.sess_state,
    doctor_sessions.completed_at_time,
    provisions.CODE,
    provisions.description,
    provisions.price
FROM
    appointments
JOIN
    patients ON appointments.patient_id = patients.id
LEFT JOIN
    doctor_sessions ON appointments.ap_id = doctor_sessions.appon_id
JOIN
    provisions ON doctor_sessions.provision_id = provisions.id
WHERE
    appointments.doc_id = $doctor_id
    AND appointments.ap_state = 'pending';
";

$result = mysqli_query($connection, $query);

// Fetching the data into an array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appon_id = $row['appon_id'];

    // Checking if the appointment already exists in the $data array
    if (!isset($data[$appon_id])) {
        $data[$appon_id] = [
            'ap_state' => $row['ap_state'],
            'name' => $row['NAME'],
            'scheduled_for' => $row['scheduled_for'],
            'sessions' => [],
        ];
    }

    // Adding the session details to the corresponding appointment
    if ($row['doc_session_id'] !== null) {
        $sessionData = [
            'doc_session_id' => $row['doc_session_id'],
            'provision_id' => $row['provision_id'],
            'sess_state' => $row['sess_state'],
            'completed_at_time' => $row['completed_at_time'],
            'provision' => [
                'code' => $row['CODE'],
                'description' => $row['description'],
                'price' => $row['price'],
            ],
        ];

        $data[$appon_id]['sessions'][] = $sessionData;
    }
}

// Converting the $data array to JSON
$jsonData = json_encode(array_values($data));

echo $jsonData;
// $sql = "select scheduled_for,ap_state,patients.name,provisions.description,doctor_sessions.* from appointments 
//  INNER JOIN doctor_sessions ON appointments.ap_id = doctor_sessions.appon_id 
//  INNER JOIN patients ON appointments.patient_id = patients.id
//  INNER JOIN provisions ON provisions.id = doctor_sessions.provision_id where appointments.doc_id=$doctor_id;";
// $result = mysqli_query($dbh, $sql);
// $data = array();
// while ($row = mysqli_fetch_array($result)) {
//     $nested_data = array();
//     $nested_data['ap_state'] = $row['ap_state'];
//     $nested_data['name'] = $row['name'];
//     $nested_data['description'] = $row['description'];
//     // $nested_data['price'] = $row['price'];
//     // $nested_data['start_time'] = $row['start_time'];
//     // $nested_data['end_time'] = $row['end_time'];
//     $nested_data['scheduled_for'] = $row['scheduled_for'];
//     $data[] = $nested_data;
// }
// header("Content-Type: application/json");
// echo json_encode($data);
// mysqli_close($dbh);
