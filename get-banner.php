<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM home_page_banners");

$outp = array();
$banners =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $banner['Id'] = $rs["Id"];
	$banner['Position'] = $rs["Position"];
	$image = $rs["File_path"];
	$banner['imagePath'] = $image;
	
	
	$position =$rs["Position"];
	$filepath = $rs["File_path"];
	$banners[$position] = $filepath;
	
	
	//$banners[] = $banner;
}
$outp['banners'] =$banners;
$conn->close();

echo(json_encode($outp));
?>
