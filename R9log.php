<?php
	$data = array();
	$pending_id = $_GET["pending_id"];
	$patient_id = $_GET["patient_id"];
	$doctor_id = $_GET["doctor_id"];
	$comment = $_GET["comment"];
	$created_at = $_GET["created_at"];
	$created_at_time = $_GET["created_at_time"];
	 
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	 
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	 
	$sql = "INSERT into pending values('" .$pending_id. "','".$patient_id. "','" .$doctor_id. "','" .$comment. "','" .$created_at. "','".$created_at_time. "')";
	echo $sql;
	mysqli_query($dbh, $sql);
	mysqli_close($dbh);

?>