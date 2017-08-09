<?php include('config.php') ?>
<?php
$like=$_GET['like'];
$id=$_GET['id'];
$like=$like+1;
//echo ("hello");
//echo ($like.$id);
$sql = "Update design set likes='$like' where id = '$id' ";
mysqli_query($con, $sql);
echo $like;
?>