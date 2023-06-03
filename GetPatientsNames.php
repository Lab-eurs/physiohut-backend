<?php

$patientNames = new PatientNames();
$patientNames->getNames();

class PatientNames {
    function getNames() {
        $host = "localhost";
        $uname = "root";
        $pass = "";
        $dbname = "physiohut";

        $dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
        $dbh->set_charset("utf8");

        mysqli_select_db($dbh, $dbname);

        // http://localhost/physiohut_backend/get_patient_names.php?doc_id=1
        $data = array();

        // Get the doctor ID from the URL parameters
        $doctor_id = 1;

        // Retrieve the patients' names
        $patients_sql = "SELECT NAME FROM patients WHERE doc_id = $doctor_id";
        $patients_result = mysqli_query($dbh, $patients_sql);

        if ($patients_result && mysqli_num_rows($patients_result) > 0) {
            $patients = array();
            while ($row = mysqli_fetch_assoc($patients_result)) {
                $patients[] = $row["NAME"];
            }
            $data["patients"] = $patients;
        } else {
            $data["error"] = "No patients found for the doctor.";
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        mysqli_close($dbh);
    }
}

?>
