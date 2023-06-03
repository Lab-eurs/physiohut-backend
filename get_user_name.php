<?php 
        
    $data = array();
    
    $host = "localhost";
    $uname = "root";
    $pass = "";
    $dbname = "physiohut";

    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh, $dbname);

    //$Name = $_GET["Name"];

    $sql = "SELECT Name, GROUP_CONCAT(doctor_id) as doctors,
    GROUP_CONCAT(patient_id) as ids,
    GROUP_CONCAT(comment) as pcomments,
    GROUP_CONCAT(created_at) as created_at FROM comments GROUP BY Name";

    $result = mysqli_query($dbh, $sql);
    while($row = mysqli_fetch_array($result)){
		$nested_data = array();
		$nested_data['doctors'] = $row['doctors'];
		$nested_data['ids'] = $row['ids'];
		$nested_data['pcomments'] = $row['pcomments'];
		$nested_data['created_at'] = $row['created_at'];
		$data[$row['Name']] = $nested_data;
	}
   // $data = $row[0];      
                
    header("Content-Type: application/json");
    echo json_encode($data);
    mysqli_close($dbh);

?>