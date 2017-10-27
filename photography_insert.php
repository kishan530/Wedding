<?php
include("config.php");
$location = $events = $budget = $additionalrequirement = '';
$location=$_GET["location"];
$events=$_GET["events"];
$budget=$_GET["budget"];
$additionalrequirement=$_GET["additionalrequirement"];
//$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into photography_requests(location,events,budget,additionalrequirement,category,active)values('$location','$events','$budget','$additionalrequirement','2','1')");
//if($sql);
echo (mysqli_error($conn));
//echo('details submited');
  // header("location:/preview/#!/photography"); 
    //$location.path("/");
?>