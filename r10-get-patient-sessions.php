<?php

$data = array();

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);

$patient_id = $_GET['patient_id'];

// ama thelw me ola ta status apla allazw edw
$query = "
SELECT
    doctor_sessions.doc_session_id,
    doctor_sessions.provision_id,
    doctor_sessions.sess_state,
    doctor_sessions.completed_at_time,
    provisions.CODE,
    provisions.description,
    provisions.price
FROM
    doctor_sessions
JOIN
    appointments ON doctor_sessions.appon_id = appointments.ap_id
JOIN
    provisions ON doctor_sessions.provision_id = provisions.id
WHERE
    appointments.patient_id = $patient_id
    AND doctor_sessions.sess_state = 'completed';
";

$result = mysqli_query($connection, $query);

// Fetching the data into an array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
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

    $data[] = $sessionData;
}

// Returning the array
echo json_encode($data);
return $data;
