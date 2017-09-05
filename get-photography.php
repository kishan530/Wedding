
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM photography");

$outp = array();
$albums =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $album['id'] = $rs["id"];
	$album['name'] = $rs["name"];
	$album['description'] = $rs["description"];
	$image = $rs["image"];
	$album['imagePath'] = $image;
	
	$albums[] = $album;
}
$outp['albums'] =$albums;
$conn->close();

echo(json_encode($outp));
?>
