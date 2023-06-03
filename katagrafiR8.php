<?php
	$data = array();
	$ap_id = $_GET["ap_id"];
	$provision = $_GET["provision"];
	
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	
	$sql = "INSERT into finalappoint values('" .$ap_id. "','" .$provision. "')"; 
	echo $sql;
	mysqli_query($dbh, $sql);
	mysqli_close($dbh);
?>