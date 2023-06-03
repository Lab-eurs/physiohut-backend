<?php
	$host="localhost";
	$uname="root";
	$pass="";
	$dbname="physiohut";
	
	$dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
	mysqli_select_db($dbh, $dbname);
	
	$sqldoctors = "INSERT INTO doctors VALUES (DEFAULT,'Giannhs Karagiwrgos','Champs Elysee 32','123456789'),
			(DEFAULT,'Giwrgos Karagiannhs','Rue de Tour Eiffel 32','987654321'),
			(DEFAULT,'Giannhs xatzigiwrgos','Lion 15','123456788');";
	echo $sqldoctors;
	mysqli_query($dbh, $sqldoctors);
	mysqli_close($dbh);
?>