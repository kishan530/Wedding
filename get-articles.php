<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM article");

$outp = array();
$articles =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $article['id'] = $rs["id"];
	$article['name'] = $rs["name"];
	$image = $rs["image_path"];
	$article['image_path'] = $image;
	$article['description'] = $rs["description"];
	$article['catogery'] = $rs["catogery"];
	$articles[] = $article;
}
$outp['articles'] =$articles;
$conn->close();

echo(json_encode($outp));
?>