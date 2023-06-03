<?php
    $data= array();
    $id = $_GET["id"];
    $doc_id = $_GET["doc_id"];
    $NAME = $_GET["NAME"];
	$address = $_GET["address"];
    $amka = $_GET["amka"];
	
    $host="localhost";
    $uname="root";
    $pass="";
    $dbname="physiohut";

    $dbh = mysqli_connect($host,$uname,$pass) or die("cannot connect");
    mysqli_select_db($dbh,$dbname);
	
	$doctorExists = mysqli_query($dbh, "SELECT id FROM doctors WHERE id = $doc_id");
	if (!$doctorExists || mysqli_num_rows($doctorExists) === 0) {
		echo "Referenced doctor does not exist.";
		exit;
	}

	$sql = "INSERT INTO patients VALUES ('$id', '$doc_id', '$NAME', '$address', '$amka')";
	echo $sql;

	if (mysqli_query($dbh, $sql)) {
		echo "Record inserted successfully.";
	} else {
		echo "Error inserting record: " . mysqli_error($dbh);
	}

    mysqli_query($dbh, $sql);
    mysqli_close($dbh);
?>
