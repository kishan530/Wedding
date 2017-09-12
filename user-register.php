<?php
include("config.php");
	 $myusername = $email = $mypassword = $mobile= ''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['Password']);
       $email = mysqli_real_escape_string($conn,$_POST['email']);  
	   $mobile = mysqli_real_escape_string($conn,$_POST['mobile']); 
	  $active = ['active'];
      $sql = "INSERT INTO user (username , email, mobile,password,active) VALUES ('$myusername','$email','$mobile','$mypassword','1')";
      //$sql = "SELECT * FROM users WHERE username = '$myusername' email='$email' and password = '$mypassword' and active =1";
      $result = mysqli_query($conn,$sql);
		
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
	  else
	  {
		  echo '<script language="javascript">';
		echo 'alert("Registration Successfully")';
		echo '</script>';
	   header("location:index.html");
	  }
   }
?>





















