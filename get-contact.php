
<?php
include('config.php');

// $description = $_GET['description'];
 //$description = 1;
$result = $conn->query("SELECT * FROM contact_us");

$outp = array();
$contacts =  array();
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    $contact['ID'] = $rs["ID"];
	$contact['Name'] = $rs["Name"];
	$contact['Email'] = $rs["Email"];
	$contact['PhoneNumber'] = $rs["PhoneNumber"];
	$contact['Message'] = $rs["Message"];
	
	$contacts[] = $contact;
}
$outp['contacts'] =$contacts;
$conn->close();

echo(json_encode($outp));
?>