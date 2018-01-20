<?php
include("config.php");
$date=$_GET["date"];
$time=$_GET["time"];
$message=$_GET["message"];
$created_at = new DateTime();
$created_at = $created_at->format('Y-m-d H:i:s');
//$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into styling_requests(date,time,message,created_at,active)values('$date','$time','$message','$created_at','1')");
//if($sql);
echo (mysqli_error($conn));
//echo('details submited');
  // header("location:/preview/#!/Styling-Services"); 
    //$location.path("/");
?>