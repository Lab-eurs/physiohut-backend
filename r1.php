<?php
    $data= array();
    $id = $_GET["id"];
    $afm = $_GET["afm"];
    $name = $_GET["name"];
    $address = $_GET["address"];
    
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="physiohut";
    
    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh,$dbname);
    
    $sql = "INSERT INTO doctors VALUES('" .$id. "','".$name. "','" .$address. "','" .$afm. "')";
    echo $sql;
    mysqli_query($dbh, $sql);
    mysqli_close($dbh);
?>