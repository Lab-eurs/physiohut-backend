<?php 

    $pendingAppointmentList = new PendingAppointmentsList();
    $pendingAppointmentList->load();

    class PendingAppointmentsList {
        var $pendingAppointments = array();

        function load(){
            $host = "localhost";
            $uname = "root";
            $pass = "";
            $dbname = "physiohut";

            $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
            $dbh->set_charset("utf8");

            mysqli_select_db($dbh, $dbname);
        
            $data = array();
            $url = ($_SERVER)["REQUEST_URI"];
            $doc_id = $_GET['doctor_id'];
            $sql = "SELECT * FROM pending WHERE doctor_id = $doc_id;";
            $result = mysqli_query($dbh,$sql);
            $counter = 0;

            while ($row = mysqli_fetch_array($result)) {
                $pending_id = $row["pending_id"];
                $data[$counter] = array();
                $data[$counter]["pending"] = array();
                $sql1 = "SELECT pending.pending_id, pending.patient_id, pending.doctor_id, pending.patient_name, pending.created_at, pending.location , patients.NAME FROM pending INNER JOIN patients ON pending.patient_id = patients.id WHERE pending_id = $pending_id AND doctor_id = $doc_id;";
                $pending_row = mysqli_query($dbh, $sql1)-> fetch_assoc();
                $data[$counter]["pending"]["pending_id"] = $pending_row["pending_id"];
                $data[$counter]["pending"]["patient_id"] = $pending_row["patient_id"];
                $data[$counter]["pending"]["doctor_id"] = $pending_row["doctor_id"];
                $data[$counter]["pending"]["NAME"] = $pending_row["NAME"];
                $data[$counter]["pending"]["created_at"] = $pending_row["created_at"];
                $data[$counter]["pending"]["location"] = $pending_row["location"];
                $data[$counter]["pending"]["created_at_time"] = $row["created_at_time"];
                
                
                $counter++;
                
            }
            header('Content-Type: application/json');
            echo json_encode($data);
            mysqli_close($dbh);



        }
    }



?>