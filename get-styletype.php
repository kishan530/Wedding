<?php
 include('config.php');

$styleType=$_GET['styleType'];
//$styleType='style board';
$result = $conn->query("SELECT * FROM styling_service WHERE type='$styleType'");

$outp = array();
$services =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)){

    $service['Id'] = $rs["Id"];
	$service['Tittle'] = $rs["Tittle"];
	$service['Type'] = $rs["type"];
	$image = $rs["Image"];
	$service['imagePath'] = $image;
	$services[] = $service;
}

$outp['services'] =$services;
$conn->close();

echo(json_encode($outp));
?>
