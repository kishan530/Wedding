<?php
include('config.php');

$result = $conn->query("SELECT * FROM makeup_artist");

$outp = array();
$artists =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)){

    $artist['id'] = $rs["id"];
	$artist['name'] = $rs["name"];
	$artist['description'] = $rs["description"];
	$image = $rs["image"];
	$artist['imagePath'] = $image;
	$artists[] = $artist;
}
$outp['artists'] =$artists;
$conn->close();

echo(json_encode($outp));
?>
