<?php include('admin/config.php') ?>
<?php
$like=$_GET['like'];
$id=$_GET['id'];
$like=$like+1;
//echo ("hello");
//echo ($like.$id);
$sql = "Update design set likes=likes+1 where id = '$id' ";
mysqli_query($con, $sql);
echo $like;
?>