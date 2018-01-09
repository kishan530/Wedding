<?php
include("config.php");
$date = $events = $file_name= $city= '';

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 ); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 4) as $k) $rand .= $seed[$k];
$coupon_code= $rand;
$date=$_POST["date"];
$city=$_POST["city"];
$id=$_POST["contestId"];
//$file=$_POST["file"];
//$file1=$_POST["file1"];
 $errors= array();
 //echo var_dump($_FILES['file']);
  //echo var_dump($_FILES['file1']);
 //exit();
   $total = count($_FILES['file']['name']);
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
    }
 
   $total = count($_FILES['file1']['name']);
 // for($i=0; $i<$total; $i++) {
   /* $file_name = $_FILES['file'][1]['name'];
    $file_size =$_FILES['file'][1]['size'];
    $file_tmp =$_FILES['file'][1]['tmp_name'];
    $file_type=$_FILES['file'][1]['type'];*/
	
	 $total = count($_FILES['file']['name']);
  $file_name1 = $_FILES['file1']['name'];
    $file_size1 =$_FILES['file1']['size'];
    $file_tmp1 =$_FILES['file1']['tmp_name'];
    $file_type1 =$_FILES['file1']['type'];
    $exts = explode('.',$file_name1);
    $j = count($exts);
    
    $file_ext = $exts [$j-1];
    $file_ext=strtolower($file_ext);
    $file_ext = 'jpg';
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions)=== false){
    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
      
    if(count($errors)==0){
    move_uploaded_file($file_tmp1,"images/contest/".$file_name1);
  //  $fileNames[] = $file_name;
     //echo "Success";
    }
 // }

 

if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}

// $last_id = mysqli_insert_id($conn);
session_start();  
$last_id = $_SESSION['contestId'];
$sql="UPDATE contest SET date='$date', city='$city',file='$file_name',file1='$file_name1',coupon_code='$coupon_code' WHERE id=$last_id";

$coupon_result = array();
$coupon_result['message'] = '';
$coupon_result ['stutus'] = false;
if (mysqli_query($conn, $sql)){
$coupon_result ['message'] = 'insert data successfully';
$coupon_result ['stutus'] = true;
$coupon_result ['couponCode'] = $rand;
 $last_id = mysqli_insert_id($conn);
}else{
	$coupon_result ['message'] = mysqli_error($conn);
$coupon_result ['stutus'] = false;
//echo (mysqli_error($conn));
}

$outp['coupon'] =$coupon_result;
$conn->close(coupon_result);

echo(json_encode($outp));
//echo $sql;
if (mysqli_query($conn, $sql)){
 //echo "insert data successfully";
 //$sql="insert into contest(date,location,file,file1)values('$date','$location','$file_name','$file_name1')";
}else{
echo (mysqli_error($conn));
echo "insert fail";
}

 
  	//header("location:/preview/#!/success");	

?>