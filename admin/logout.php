<?php
session_start();
session_destroy();
header('Location:../login.php');	
?>
<h4>your logged out</h4>
<a href="login.php">login</a>