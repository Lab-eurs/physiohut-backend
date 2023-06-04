<?php
$data = array();
$CODE = $_GET["CODE"];
$description = $_GET["description"];
$price = $_GET["price"];

$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$datenow = date("Y/m/d");
$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
mysqli_select_db($dbh, $dbname);

$sql = "INSERT INTO provisions VALUES(DEFAULT,'" . $datenow . "','" . $CODE . "','" . $description . "','" . $price . "')";
mysqli_query($dbh, $sql);
mysqli_close($dbh);
echo json_encode($description);
