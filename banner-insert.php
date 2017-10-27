<?php
include("dbconfig.php");
$Position=$_POST["Position"];
$File_path=$_POST["File_path"];

$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into home_page_banners (Position,File_path)values('$Position','$File_path')");
//if($sql);
echo (mysqli_error($conn));
//header('Location: success.html');
//echo "insert data successfully";
?>