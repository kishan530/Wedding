<?php 
	session_start();
	
   if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	//$isAdmin = $user['is_admin'];
	
	echo json_encode($_SESSION['user']);
   }
?>