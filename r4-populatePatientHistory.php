<?php
$data = array();
$host = "localhost";
$uname = "root";
$pass = "";
$dbname = "Physiohut";
$dbh = mysqli_connect($host, $uname, $pass) or die("cannot connect");
mysqli_select_db($dbh, $dbname);
$sql = "SELECT CODE, GROUP_CONCAT(id) AS ids,
 GROUP_CONCAT(date) AS dates,
GROUP_CONCAT(description) AS descriptions,
GROUP_CONCAT(price) AS prices FROM provisions GROUP BY 
CODE";
$result = mysqli_query($dbh, $sql);
if (!$result) {
    mysqli_close($dbh);
    echo json_encode("Error");
}
// echo json_encode($result);
while ($row = mysqli_fetch_array($result)) {
    $nested_data = array();
    $nested_data['dates'] = $row['dates'];
    $nested_data['ids'] = $row['ids'];
    $nested_data['descriptions'] = $row['descriptions'];
    $nested_data['prices'] = $row['prices'];
    $data[$row['CODE']] = $nested_data;
}
mysqli_close($dbh);
header("Content-Type: application/json");
echo json_encode($data);
