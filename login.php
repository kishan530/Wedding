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
   $error = '';
   $count=0;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
	  
      $sql = "SELECT * FROM user WHERE username = '$myusername' AND password = '$mypassword' AND active =1";
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
	$isAdmin =(bool) 0;
	//  $count = 1;
      }
		 if($active == 1) {
		 $_SESSION['user']['id'] = $row['id'];
        $_SESSION['user']['name'] = $myusername;
		 $_SESSION['user']['is_admin'] = $isAdmin;
		// $_SESSION['is_admin'] = $isAdmin;
       // echo ($_SESSION['user']['id']); 
         header("location:index.html");
      }
	//	  echo var_dump( $row);
	//  exit();
    
	   
	   else
	   {
		 echo("your user name and password incorrect");  
	   }
   }
?>
