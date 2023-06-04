<?php

$provisionsList = new ProvisionsList();
$provisionsList->populateDB();
$provisionsList->load();

class ProvisionsList
{
    var $dbIsPopulated = false;
    var $provisions = array();

    function populateDB()
    {
        if ($this->dbIsPopulated) {
            return;
        }
        $host = "localhost";
        $uname = "root";
        $pass = "";
        $dbname = "physiohut";

        $dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
        $dbh->set_charset("utf8");

        mysqli_select_db($dbh, $dbname);

        $sqldoctors = "INSERT INTO doctors VALUES (DEFAULT,'Giannhs Karagiwrgos','Champs Elysee 32','123456789');";
        mysqli_query($dbh, $sqldoctors);
        $sqlpatients = "INSERT INTO patients VALUES (DEFAULT,1,'Dimitris xatzimitsos','Lion 15','123456789');";
        mysqli_query($dbh, $sqlpatients);


        $sql1 = 'INSERT INTO provisions VALUES (DEFAULT,"15/12/2023","CVCE123","HELLO WORLD",15.20);';
        $sql2 = 'INSERT INTO provisions VALUES (DEFAULT,"16/05/2023","hpk12$#","Treats mental illnesses",2.30)';
        $sql3 = 'INSERT INTO visits VALUES (1,1,"2021-12-12 12:12:12");';
        // $sql4 = 'INSERT INTO visits VALUES (1,2,"2022-12-12 12:12:12");';
        // $sql5 = 'INSERT INTO visits VALUES (2,2,"2023-12-12 12:12:12");';
        mysqli_query($dbh, $sql1);
        mysqli_query($dbh, $sql2);
        mysqli_query($dbh, $sql3);
        $this->dbIsPopulated = true;
        // mysqli_query($dbh, $sql4);
        // mysqli_query($dbh, $sql5);
    }


    function load()
    {
        $host = "localhost";
        $uname = "root";
        $pass = "";
        $dbname = "physiohut";

        $dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
        $dbh->set_charset("utf8");

        mysqli_select_db($dbh, $dbname);

        $patient_id = $_GET["patient_id"];
        $data = array();
        $sql = "select * from visits where id= $patient_id;";
        $result = mysqli_query($dbh, $sql);
        $counter = 0;
        while ($row = mysqli_fetch_array($result)) {
            $provision_id = $row["provision_id"];
            $timestamp_str = $row["time_stamp"];
            $data[$counter] = array();
            $data[$counter]["provision"] = mysqli_query($dbh, "select * from provisions where id = $provision_id;")->fetch_assoc();
            $data[$counter]["timestamp"] = $timestamp_str;
            $counter++;
            // echo "$row";
        }
        // echo "<h2>Provisions</h2>";
        header('Content-Type: application/json');
        echo json_encode($data);
        mysqli_close($dbh);
    }
}
