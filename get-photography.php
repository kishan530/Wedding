
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM photography");

$outp = array();
$albums =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $photography['id'] = $rs["id"];
	$photography['name'] = $rs["name"];
	$photography['description'] = $rs["description"];
	$image = $rs["image"];
	$photography['imagePath'] = $image;
	
	$albums[] = $photography;
}
$outp['albums'] =$albums;
$conn->close();

echo(json_encode($outp));
?>
