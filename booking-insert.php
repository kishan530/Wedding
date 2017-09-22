<?php
include("config.php");
	 $name = $email = $mobile= $selected_date= $selected_time = $amount = $booked_on =''; 
	
   $errors = array();
   $message = '';
  // if($_SERVER["REQUEST_METHOD"] == "POST") {
	  $name = mysqli_real_escape_string($conn,$_GET['name']);
      $email = mysqli_real_escape_string($conn,$_GET['email']);
       $mobile = mysqli_real_escape_string($conn,$_GET['mobile']);  
	  // $selected_date = mysqli_real_escape_string($conn,$_GET['selected_date']); 
	   $selected_time = mysqli_real_escape_string($conn,$_GET['selectedTime']); 
	 //  $amount = mysqli_real_escape_string($conn,$_GET['amount']); 
	 //  $booked_on = mysqli_real_escape_string($conn,$_GET['booked_on']); 
	   
	   // $name = 'kishan';
		 //$email = 'kishan@1gmail.com';
		  //$mobile = '9741725044';
		   $selected_date = '2017-10-06';
		   // $selected_time = '8:50';
			$amount = '4250';
			$booked_on = new DateTime();
			$booked_on = $booked_on->format('Y-m-d H:i:s');
      $sql = "INSERT INTO booking (name , email, mobile,selected_date,selected_time,amount,booked_on,active) VALUES ('$name','$email','$mobile','$selected_date','$selected_time','$amount','$booked_on','1')";
      $result = mysqli_query($conn,$sql);
		echo ("$sql");
	  if(count($errors)>0){
		echo var_dump($errors);
		exit();
	  }
	  
  // }
?>