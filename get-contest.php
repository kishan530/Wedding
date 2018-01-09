<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM contest");

$outp = array();
$contests =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $contest['id'] = $rs["id"];
	$contest['name'] = $rs["name"];
	$contest['email'] = $rs["email"];
	$contest['mobile'] = $rs["mobile"];
	
	$contests[] = $contest;
}
$outp['contests'] =$contests;
$conn->close();

echo(json_encode($outp));
?>



/*include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM contest");

$outp = array();
$contests =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $contest['id'] = $rs["id"];
	$contest['name'] = $rs["name"];
	$contest['email'] = $rs["email"];
	$contest['file'] = $rs["file"];
	$contest['location'] = $rs["location"];
	$contest['message'] = $rs["message"];
	$contest['date'] = $rs["date"];
	$contest['events'] = $rs["events"];
	$contest['day_or_night'] = $rs["day_or_night"];
	$contests[] = $contest;
}
$outp['contests'] =$contests;
$conn->close();

echo(json_encode($outp));
?>*/