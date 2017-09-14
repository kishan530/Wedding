<?php
   include("config.php");
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "delete FROM styling_form WHERE id =$id";
			if(mysqli_query($con, $sql)){
				echo 'true';
			} else{
				 echo "Could not able to delete " . mysqli_error($con);
			}
}
			