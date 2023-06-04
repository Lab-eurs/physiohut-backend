<?php

$patientNames = new PatientNames();
$patientNames->getNames();

class PatientNames
{
    function getNames()
    {
        $host = "localhost";
        $uname = "root";
        $pass = "";
        $dbname = "physiohut";

        $dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
        $dbh->set_charset("utf8");

        mysqli_select_db($dbh, $dbname);

        // http://localhost/physiohut-backend/get_patient_names.php?doc_id=1
        $data = array();

        // Get the doctor ID from the URL parameters
        $doctor_id = $_GET["doc_id"];

        // Retrieve the patients
        $patients_sql = "SELECT * FROM patients WHERE doc_id = $doctor_id";
        $patients_result = mysqli_query($dbh, $patients_sql);

        if ($patients_result && mysqli_num_rows($patients_result) > 0) {
            $all_patients = array();

            while ($row = mysqli_fetch_assoc($patients_result)) {
                $patients = array();
                $patients["name"] = $row["NAME"];
                $patients["id"] = $row["id"];
                $patients["address"] = $row["address"];
                $patients["amka"] = $row["amka"];
                $patients["doc_id"] = $row["doc_id"];
                array_push($all_patients, $patients);
            }
            $data["patients"] = $all_patients;
        } else {
            $data["error"] = "No patients found for the doctor.";
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        mysqli_close($dbh);
    }
}
