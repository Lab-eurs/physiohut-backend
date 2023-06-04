<?php
$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "physiohut";
$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
$dbh->set_charset("utf8");
mysqli_select_db($dbh, $dbname);

$sql = "SELECT * FROM provisions";
$result = mysqli_query($dbh, $sql);
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $nested_data = array();
    $nested_data['id'] = $row['id'];
    $nested_data['CODE'] = $row['CODE'];
    $nested_data['description'] = $row['description'];
    $nested_data['price'] = $row['price'];
    $data[] = $nested_data;
}
header("Content-Type: application/json");
echo json_encode($data);
mysqli_close($dbh);
