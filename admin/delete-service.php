<?php
   include("config.php");
   $errors = array();
   $message = '';
   if (isset($_GET["Id"])) {
            $Id = mysqli_real_escape_string($con,$_GET['Id']); 
			 $sql = "delete FROM styling_service WHERE Id =$Id";
			if(mysqli_query($con, $sql)){
				echo 'true';
			} else{
				 echo "Could not able to delete " . mysqli_error($con);
			}
}
			