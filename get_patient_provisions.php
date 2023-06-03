<?php 

    $provisionsList = new ProvisionsList();
    $provisionsList->load();

    class ProvisionsList {
        var $provisions = array();

        function load(){
            $host = "localhost";
            $uname = "root";
            $pass = "root";
            $dbname = "physiohut";

            $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
			$dbh->set_charset("utf8");

            mysqli_select_db($dbh, $dbname);
            

            $data = array();
            $sql = "select * from provisions;";
            $result = mysqli_query($dbh,$sql);
            $counter = 0;
            while ($row = mysqli_fetch_array($result)) { 
				$patient_id = $row["patient_id"];
				$provision_id = $row["provision_id"];
                $timestamp_str = $row["timestamp"];
                $data[$counter] = array();
                $data[$counter]["provision"] = mysqli_query($dbh, "select * from products where id = $provision_id;")->fetch_assoc();
                $data[$counter]["timestamp"] = $timestamp_str;
                $counter++;
                echo "$row";
			}
            echo "<h2>Provisions</h2>";
            header('Content-Type: application/json');
            echo json_encode($data);
            my_sql_close($dbh);



        }
    }



?>