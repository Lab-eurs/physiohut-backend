<?php
	$data = array();
	// $ap_id = $_GET["ap_id"];
	$patient_id = $_GET["patient_id"];
	$doctor_id = $_GET["doctor_id"];
	$comment = $_GET["comment"];
	$provision = $_GET["provision"];
	$created_at = $_GET["created_at"];
	
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	
	$sql = "INSERT into comments values(DEFAULT,'" .$patient_id. "','" .$doctor_id. "','" .$comment. "','" .$provision. "','" .$created_at. "')"; 
	echo $sql;
	mysqli_query($dbh, $sql);
	mysqli_close($dbh);
