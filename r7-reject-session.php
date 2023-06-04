<?php

$data = array();

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$connection = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$connection->set_charset("utf8");
mysqli_select_db($connection, $dbname);

$session_id = $_GET['session_id'];

$query = "
UPDATE doctor_sessions
SET sess_state = 'rejected'
WHERE doc_session_id = $session_id;
";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the update was successful
if ($result) {
    // Session marked as completed
    echo "Session marked as rejected.";
} else {
    // Error occurred during the update
    echo "Error updating session status: " . mysqli_error($connection);
}
