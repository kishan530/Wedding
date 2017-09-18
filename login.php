<?php

      include("config.php");
   session_start();
   if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$isAdmin = $user['is_admin'];
   }
   $response = array();
   $response['success'] = false;
   $response['message'] = '';
   $error = '';
   $count=0;
   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($conn,$_GET['username']);
      $mypassword = mysqli_real_escape_string($conn,$_GET['password']); 
      
	  
      $sql = "SELECT * FROM user WHERE email = '$myusername' AND password = '$mypassword' AND active =1";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	// echo ($myusername);
	//  echo ($mypassword);
	  
	  if ($row!=null)
	  {
		//echo ( $sql); 
	//	  echo var_dump( $row);
	//  exit();
      $active = $row['active'];
	  $email = $row['email'];
	  $mobile = $row['mobile'];
	  $name = $row['username'];
	$isAdmin =(bool) 0;
	//  $count = 1;
	
	 if($active == 1) {
		 $_SESSION['user']['id'] = $row['id'];
        $_SESSION['user']['name'] = $name;
		$_SESSION['user']['email'] = $email;
		$_SESSION['user']['mobile'] = $mobile;
		 $_SESSION['user']['is_admin'] = $isAdmin;
		 
		// $_SESSION['is_admin'] = $isAdmin;
       // echo ($_SESSION['user']['id']); 
		$response['success'] = true;
        // header("location:/preview/#!/booking");
      }else
	   {
		  // header("location:failure.html");
		  $response['success'] = false;
		   $response['message'] = 'Incorrect username or password. Please check and try again';
		// echo("your user name and password incorrect");  
	   }
      }	   
	   else
	   {
		   $response['success'] = false;
		   $response['message'] = 'Incorrect username or password. Please check and try again';
		   
		 //  header("location:failure.html"); // when u added server include /preview/ 
		 
		// echo("your user name and password incorrect");  
	   }
   }
   echo json_encode($response);
?>
