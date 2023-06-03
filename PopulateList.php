<?php
	$data = array();
	
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	
	$sql = "SELECT CODE, GROUP_CONCAT(id) AS ids,
	GROUP_CONCAT(CODE) as codes,
	GROUP_CONCAT(description) as descriptions,
	GROUP_CONCAT(price) as prices FROM provisions GROUP BY id";
	
	$result = mysqli_query($dbh, $sql);
	while($row = mysqli_fetch_array($result)){
		$nested_data = array();
		$nested_data['ids'] = $row['ids'];
		$nested_data['codes'] = $row['codes'];
		$nested_data['descriptions'] = $row['descriptions'];
		$nested_data['prices'] = $row['prices'];
		$data[$row['CODE']] = $nested_data;
	}
	header("Content-Type: application/json");
	echo json_encode($data);
	mysqli_close($dbh);
?>