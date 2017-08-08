<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include('config.php');

 $selected = $_GET['selected'];
 //$category = 1;
$result = $conn->query("SELECT * FROM design where id=$selected");

$outp = array();
$design =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
   // if ($outfit != "") {$outfit .= ",";}
    $design['id'] = $rs["id"];
	$design['title'] = $rs["design_title"];
	$design["designedBy"] = $rs["designed_by"];
	$design['imagePath'] = $rs["image_path"];
	$design['likes'] = $rs["likes"];
}
$outp['design'] =$design;

$result = $conn->query("SELECT * FROM recommendations where design_id=$selected");
$recommendations =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    //if ($styles != "") {$styles .= ",";}
	$recommendation['id'] = $rs["id"];
	$recommendation['title'] = $rs["title"];
	$recommendation["designedBy"] = $rs["designed_by"];
	$recommendation['imagePath'] = $rs["image_path"];
	$recommendations[] = $recommendation;
}

$outp['recommendations'] =$recommendations;

$conn->close();

echo(json_encode($outp));
?>