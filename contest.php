<?php

include("config.php");
$name = $email = $mobile = '';
$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];

 $errors= array();
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}

$sql="insert into contest(name,email,mobile)values('$name','$email','$mobile')";


if (mysqli_query($conn, $sql)) 

echo (mysqli_error($conn));
//echo "insert data successfully";
 
  	//header("location:/preview/#!/success");	

?>*/
/*include("config.php");
$name = $email = $mobile = $message = $file = $date = $events = $file_name= $location= $day_or_night = '';
$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$file=$_POST["file"];
$location=$_POST["location"];
$message=$_POST["message"];
$date=$_POST["date"];
$events=$_POST["events"];
$day_or_night=$_POST["day_or_night"];
 $errors= array();

  //  $total = count($_FILES['file']['name']);
 // for($i=0; $i<$total; $i++) {
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $exts = explode('.',$file_name);
    $j = count($exts);
    
    $file_ext = $exts [$j-1];
    $file_ext=strtolower($file_ext);
    $file_ext = 'jpg';
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions)=== false){
    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
      
    if(count($errors)==0){
    move_uploaded_file($file_tmp,"images/contest/".$file_name);
  //  $fileNames[] = $file_name;
     //echo "Success";
    }
 // }

 

if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}

$sql="insert into contest(name,email,mobile,file,location,message,events)values('$name','$email','$mobile','$file_name','$location','$message','$events')";


if (mysqli_query($conn, $sql)) {
    $contest_id = mysqli_insert_id($conn);
//	echo $contest_id;
//	echo var_dump($sql);
foreach($events as $event)

  $sql2=mysqli_query($conn,"insert into contest_type(eventName,date,day_or_night,contest_id)values('$event','$date','$day_or_night','$contest_id')");

}

echo (mysqli_error($conn));
//echo "insert data successfully";
 
  	//header("location:/preview/#!/success");	

?>*/

