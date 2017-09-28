<?php
include("config.php");
$location=$_POST["location"];
$events=$_POST["events"];
$budget=$_POST["budget"];
$additionalrequirement=$_POST["additionalrequirement"];
//$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into photography_requests(location,events,budget,additionalrequirement,category,active)values('$location','$events','$budget','$additionalrequirement','1','1')");
//if($sql);
echo (mysqli_error($conn));
echo('details submited');
   header("location:/preview/#!/makeup-artist"); 
    //$location.path("/");
?>