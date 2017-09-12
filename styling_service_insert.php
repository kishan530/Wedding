<?php
include("config.php");
$date=$_POST["date"];
$time=$_POST["time"];
$message=$_POST["message"];
$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into styling_form(date,time,message)values('$date','$time','$message')");
//if($sql);
echo (mysqli_error($conn));
echo "<script>
    alert('details submited');
    window.location.replace('Styling-Service.html');
    </script>"
?>