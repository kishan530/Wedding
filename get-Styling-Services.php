<?php
include('config.php');

$result = $conn->query("SELECT * FROM styling_service");

$outp = array();
$services =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)){

    $service['Id'] = $rs["Id"];
	$service['Tittle'] = $rs["Tittle"];
	$image = $rs["Image"];
	$service['imagePath'] = $image;
	$services[] = $service;
}

$outp['services'] =$services;
$conn->close();

echo(json_encode($outp));
?>
