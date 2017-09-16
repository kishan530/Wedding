<?php
include("config.php");
session_start();
   if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$isAdmin = $user['is_admin'];
		if($isAdmin==0){
			
			 header("location:index.html");
		}
   }
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
		  $_SESSION['user']['id'] = $row['id'];
        $_SESSION['user']['name'] = $myusername;
		$_SESSION['user']['email'] = $email;
		$_SESSION['user']['mobile'] = $mobile;
		 $_SESSION['user']['is_admin'] = 0;
		 
		// $_SESSION['is_admin'] = $isAdmin;
       // echo ($_SESSION['user']['id']); 
         header("location:/preview/#!/booking");
	//	echo 'alert("Registration Successfully")';
		
	  // header("location:/wedding/#!/search-design#myModal");
	  }
   }
?>





















