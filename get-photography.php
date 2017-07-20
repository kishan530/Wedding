
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM photography");

$outp = array();
$albums =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $albums['id'] = $rs["id"];
	$albums['name'] = $rs["name"];
	$albums['description'] = $rs["description"];
	$image = $rs["image"];
	$albums['imagePath'] = $image;
	
	$albums[] = $albums;
}
$outp['albums'] =$albums;
$conn->close();

echo(json_encode($outp));
?>
