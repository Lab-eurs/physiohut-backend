<?php
$data = array();
$afm = $_GET["afm"];
$name = $_GET["name"];
$address = $_GET["address"];

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";

$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
mysqli_select_db($dbh, $dbname);

$sql = "INSERT INTO doctors VALUES(DEFAULT,'" . $name . "','" . $address . "','" . $afm . "')";


mysqli_query($dbh, $sql);
$result = $dbh->insert_id;
mysqli_close($dbh);
echo $result;
