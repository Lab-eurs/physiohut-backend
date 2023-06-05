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
$date = $_GET['date'];
$provision_code_list = $_GET['prov_codes'];
$patient_name = "george";
// $provision_code_list = json_decode($requestData, true);
echo "hello" . $provision_code_list[0] . "\n";
var_dump($provision_code_list);
$query = "
SELECT
    doc_id AS doctor_id
FROM
    patients
WHERE
    id = $patient_id;
";
$result = mysqli_query($dbh, $query);
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
    echo "Error fetching doctor's ID: " . mysqli_error($dbh);
}
// this is your data
// grab this from a simple select;

// patient,doctor
// INSERT INTO appointments VALUES (DEFAULT,1,2,NOW(),"accepted",null);
$sql = "INSERT INTO appointments VALUES (DEFAULT,$patient_id,$doctor_id,'$date','accepted',null);";
echo $sql;
$result = mysqli_query($dbh, $sql);
$appointment_id = $dbh->insert_id;

$length = count($provision_code_list);
for ($i = 0; $i < $length; $i++) {
    $provision_code = (int) $provision_code_list[$i];
    // INSERT INTO appointment_provisions VALUES (DEFAULT,1,1,1);
    $sql_insert_session = "INSERT INTO doctor_sessions VALUES(DEFAULT,$provision_code,$appointment_id,'accepted',null);";
    $result = mysqli_query($dbh, $sql_insert_session);
    echo $sql_insert_session;
}
