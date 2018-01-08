<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM contest");

$outp = array();
$contests =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $contest['id'] = $rs["id"];
	$contest['location'] = $rs["location"];
	$contest['date'] = $rs["date"];
	$contest['file'] = $rs["file"];
	$contest['file1'] = $rs["file1"];
	
	$contests[] = $contest;
}
$outp['contests'] =$contests;
$conn->close();

echo(json_encode($outp));
?>