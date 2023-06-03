<?php
    $data= array();
    $id = $_GET["id"];
    $CODE = $_GET["CODE"];
    $description = $_GET["description"];
	$price = $_GET["price"];

    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="physiohut";

    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh,$dbname);

    $sql = "INSERT INTO provisions VALUES('" .$id. "','" .$CODE. "','" .$description. "','" .$price."')";
    echo $sql;
    mysqli_query($dbh, $sql);
    mysqli_close($dbh);
?>