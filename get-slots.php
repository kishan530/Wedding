
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM slots");

$outp = array();
$slots =  array();
$i = 1;
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

	if($i==1){
		$id = $rs["id"];
		if($id>12 && $id<54){
			$slot['id'] = $rs["id"];
			$slot['time'] = $rs["time"];		
			$slots[$id] = $slot;
		}
	}
	if($i==2)
	$i = 0;
	
	$i = $i+1;
}
$outp['slots'] =$slots;
$conn->close();

echo(json_encode($outp));
?>
