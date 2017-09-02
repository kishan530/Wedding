<?php
include('config.php');

$result = $conn->query("SELECT * FROM Wedding_Fashion");

$outp = array();
$fashions =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)){

    $fashion['Id'] = $rs["Id"];
	$fashion['Tittle'] = $rs["Tittle"];
	$image = $rs["Image"];
	$fashion['imagePath'] = $image;
	$fashions[] = $fashion;
}
$outp['fashions'] =$fashions;
$conn->close();

echo(json_encode($outp));
?>
