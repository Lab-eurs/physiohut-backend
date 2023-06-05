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
$query = "
SELECT
    ds.doc_session_id,
    ds.provision_id,
    ds.appon_id,
    ds.sess_state,
    ds.completed_at_time as sess_completed_at,
    a.ap_state,
    a.completed_at_time as ap_completed_at,
    p.NAME AS patient_name,
    p.id as patient_id,
    d.NAME AS doctor_name,
    d.id as doctor_id,
    pr.date,
    pr.CODE,
    pr.description,
    pr.price
FROM
    doctor_sessions AS ds
    JOIN appointments AS a ON ds.appon_id = a.ap_id
    JOIN patients AS p ON a.patient_id = p.id
    JOIN doctors AS d ON a.doc_id = d.id
    JOIN provisions AS pr ON ds.provision_id = pr.id
WHERE
    p.id = $patient_id;
";

$result = mysqli_query($connection, $query);
// Fetching the data into an array
$sessions = [];
if ($result) {
    // Fetch and process the result set
    $sessions = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $session = array(
            'doc_session_id' => $row['doc_session_id'],
            'provision_id' => $row['provision_id'],
            'appon_id' => $row['appon_id'],
            'sess_state' => $row['sess_state'],
            'ap_state' => $row['ap_state'],
            'patient_id' => $row['patient_id'],
            'doctor_id' => $row['doctor_id'],
            'sess_completed_at_time' => $row['sess_completed_at'],
            'ap_completed_at_time' => $row['ap_completed_at'],
            'patient_name' => $row['patient_name'],
            'doctor_name' => $row['doctor_name'],
            'date' => $row['date'],
            'code' => $row['CODE'],
            'description' => $row['description'],
            'price' => $row['price']
        );

        $sessions[] = $session;
    }

    // Use the $sessions array to construct your POJOs or perform further processing
} else {
    // Error occurred during the query execution
    echo "Error fetching patient sessions: " . mysqli_error($connection);
}
// Returning the array
echo json_encode($sessions);
return $sessions;
