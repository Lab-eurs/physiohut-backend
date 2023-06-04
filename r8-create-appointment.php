<?php
$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$dbh->set_charset("utf8");
mysqli_select_db($dbh, $dbname);
$doctor_id = $_GET["doctor_id"];
$patient_id = $_GET["patient_id"];
$patient_name = "george";
$requestData = file_get_contents('php://input');
$provision_code_list = json_decode($requestData, true);
echo "hello" . $provision_code_list[0] . "\n";

$date_scheduled_for_appointment = "2020-12-12";

// this is your data
// grab this from a simple select;

// patient,doctor
// INSERT INTO appointments VALUES (DEFAULT,1,2,NOW(),"accepted",null);
$sql = "INSERT INTO appointments VALUES (DEFAULT," . $patient_id . "," . $doctor_id . ",'" . $date_scheduled_for_appointment . "','accepted',null);";
$result = mysqli_query($dbh, $sql);
$appointment_id = $dbh->insert_id;

$length = count($provision_code_list);
for ($i = 0; $i < $length; $i++) {
    $provision_code = $provision_code_list[$i];
    // INSERT INTO appointment_provisions VALUES (DEFAULT,1,1,1);
    $sql_insert_session = "INSERT INTO doctor_sessions VALUES(DEFAULT,$provision_code,$appointment_id,'accepted',null);";
    $result = mysqli_query($dbh, $sql_insert_session);
    echo $sql_insert_session;
}
