<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include('config.php');

 $category = $_GET['category'];
 //$category = 1;
$result = $conn->query("SELECT * FROM outfit_type where category_id=$category");

$outp = array();
$outfits =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
   // if ($outfit != "") {$outfit .= ",";}
    $outfit['id'] = $rs["id"];
	$outfit['outfit'] = $rs["outfit"];
	$styleId = $rs["style_id"];
	$outfit['style'] = $styleId;
	
	$outfits[] = $outfit;
}
$outp['outfits'] =$outfits;




$result = $conn->query("SELECT * FROM style");
$styles =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    //if ($styles != "") {$styles .= ",";}
	$style['id'] = $rs["id"];
	$style['style'] = $rs["style"];   
	$styles[] = $style;
}

$outp['styles'] =$styles;

$result = $conn->query("SELECT * FROM occassion");

$occassions =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    //if ($occassions != "") {$occassions .= ",";}
	$occassion['id'] = $rs["id"];
	$occassion['name'] = $rs["occassion_name"];
	$occassions[] = $occassion;
}

$outp['occassions'] =$occassions;

$result = $conn->query("SELECT * FROM season");

$seasons =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
   // if ($seasons != "") {$seasons .= ",";}
   $season['id'] = $rs["id"];
	$season['season'] = $rs["season"];
	
	$seasons[] = $season;
}

$outp['seasons'] =$seasons;

$outp['filters'] =$outp;


$conn->close();

echo(json_encode($outp));
?>