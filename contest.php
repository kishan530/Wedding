<?php

include("config.php");
$name = $email = $mobile = '';
$name=$_GET["name"];
$email=$_GET["email"];
$mobile=$_GET["mobile"];

 $errors= array();
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}

$sql="insert into contest(name,email,mobile)values('$name','$email','$mobile')";

$data = array();
$data ['message'] = '';
$data ['stutus'] = false;
if (mysqli_query($conn, $sql)){
$data ['message'] = 'insert data successfully';
$data ['stutus'] = true;
 $last_id = mysqli_insert_id($conn);
 session_start();
 $_SESSION['contestId'] = $last_id;
 $data ['contestId'] = $last_id;
}else{
	$data ['message'] = mysqli_error($conn);
$data ['stutus'] = false;
//echo (mysqli_error($conn));
}

$outp['data'] =$data;
$conn->close();

echo(json_encode($outp));

?>