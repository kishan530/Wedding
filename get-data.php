<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('config.php');
  
  
 $category = $_GET['category'];
 $styles =  $_GET['style'];
 $outfit = (int) $_GET['outfit']; 
 $occassion = (int) $_GET['occasion'];
 $seasons =  $_GET['season']; 
 $wad = (int) $_GET['wad'];
 $cc = (int) $_GET['cc'];
 
/* $category = 1;
 $styles = array(1,2);
 $outfit = null; 
 $occassion = null;
 $seasons =array(1,2);
 $wad = 0;
 $cc = 0;
 $seasons = json_encode($seasons); 
 $styles = json_encode($styles); */
 
 $seasons = json_decode($seasons); 
 $styles = json_decode($styles); 
 
 
 $sql = "SELECT * FROM design where category=$category";

 /*if ($style>0) {
	
	 $sql .= " AND style=$style";
 }*/
 
 if (count($styles)>0) {
	//$season = $season[0];
	
	$styleList="AND ( style in (";
	
	foreach($styles as $style){
	$styleList.="'".$style."' ,";
	
	}
	
	$styleList = rtrim($styleList, ",");
	$styleList.=")) ";
	
	// $sql .= " AND season=$season";
	  $sql .= " $styleList";
 }
 
if ($outfit>0) {
	
	 $sql .= " AND outfit_type=$outfit";
 }
if ($occassion>0) {
	
	 $sql .= " AND occassion=$occassion";
 }
if (count($seasons)>0) {
	//$season = $season[0];
	
	$seasonList="AND ( season in (";
	
	foreach($seasons as $season){
	$seasonList.="'".$season."' ,";
	
	}
	
	$seasonList = rtrim($seasonList, ",");
	$seasonList.=")) ";
	
	// $sql .= " AND season=$season";
	  $sql .= " $seasonList";
 }
 
 if ($wad>0) {
	
	 $sql .= " AND wedding_after_dress=$wad";
 }
 if ($cc>0) {
	
	 $sql .= " AND couple_coordination=$cc";
 }
 
 
 //echo $sql;
$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
	 $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"title":"'  . $rs["design_title"] . '",';
    $outp .= '"designedBy":"'   . $rs["designed_by"]        . '",';
	 $outp .= '"season":"'   . $rs["season"]        . '",';
    $outp .= '"imagePath":"'. $rs["image_path"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>