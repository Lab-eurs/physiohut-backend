<?php
	$data = array();
	
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	
	$sql = "SELECT NAME, GROUP_CONCAT(doc_id) AS doctors, 
	GROUP_CONCAT(id) as ids, 
	GROUP_CONCAT(address) as addresses,
	GROUP_CONCAT(amka) as amkas FROM patients GROUP BY NAME";
	$result = mysqli_query($dbh, $sql);
	while($row = mysqli_fetch_array($result)){
		$nested_data = array();
		$nested_data['doctors'] = $row['doctors'];
		$nested_data['ids'] = $row['ids'];
		$nested_data['addresses'] = $row['addresses'];
		$nested_data['amkas'] = $row['amkas'];
		$data[$row['NAME']] = $nested_data;
	}
	header("Content-Type: application/json");
	echo json_encode($data);
	mysqli_close($dbh);
?>