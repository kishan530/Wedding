<?php
include("config.php");
$date=$_POST["date"];
$time=$_POST["time"];
$message=$_POST["message"];
$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into styling_requests(date,time,message,active)values('$date','$time','$message','1')");
//if($sql);
echo (mysqli_error($conn));
echo('details submited');
   header("location:/preview/#!/Styling-Services"); 
    //$location.path("/");
?>