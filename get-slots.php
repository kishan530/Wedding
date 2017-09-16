
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM slots");
$bookingResult = $conn->query("SELECT * FROM booking where selected_date = '2017-10-05' ");
$outp = array();
$slots =  array();
$i = 1;

$bookedSlots = array();
while($row = $bookingResult->fetch_array(MYSQLI_ASSOC)) {

	if($i==1){
		$id = $row["selected_time"];
		$bookedSlots[$id] = $row;
		
	}
	
}

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

	if($i==1){
		$id = $rs["id"];
		if($id>20 && $id<52){
			$id = $rs["id"];
			if(array_key_exists($id,$bookedSlots))
				$slot['booked'] = true;
			else
				$slot['booked'] = false;
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
