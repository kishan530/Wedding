<?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM photography WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$albums = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $name = mysqli_real_escape_string($con,$albums['name']); 
			$description = $albums['description'];
			  $status = $albums['active'];
			  $image_path = $albums['image'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No albums found";
				 }
			
       }else{
		 $errors[] = "No albums found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["album-name"])) {
               $errors[] = "albums is required";
       }
	
	  $name = mysqli_real_escape_string($con,$_POST['album-name']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 $description = $_POST['description'];
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  
	  
	   $design_file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  if(count($errors)==0){
			 move_uploaded_file($file_tmp,"../images/albums/".$design_file_name);
		  }
	  
   
     if(count($errors)==0){
		 	if(is_null($design_file_name))
			$design_file_name = $image_path;
		$sql = "Update photography set name = '$name', description = '$description',image= '$design_file_name',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "albums updated successfully.";
		} else{
			 $errors[]= "Could not able to update albums " . mysqli_error($con);
		}
	  } 
	  
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
   }
?>


  <!-- =============================================== -->

 <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit albums
        <small>edit albums here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit albums</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 <div class="row">
      <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
			<h3> <?php echo $message ?> </h3>
			<?php foreach ($errors as $error){ ?>
			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			<?php }

			if(count($errors)==0){
			?>
			
            <!-- form start -->
            <form role="form" action="editAlbum.php?id=<?php echo $albums['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $albums['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="name">name</label>
                  <input type="text" class="form-control" id="albums" name="album-name" placeholder="Enter albums Title" value="<?php echo $name; ?>" required >
                </div>
				
				
              
				<div class="form-group">
                  <label for="description">description</label>
			  
                <textarea class="textarea" id="description" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $description; ?></textarea>
            </div>
<div id="upload_image_widget">
                <div class='form-group'>
                  <label for='inputFile'>Image</label>
                  <input type='file' id='inputFile' name='image'> 
				<p class='help-block'>Supported formats JPEG, JPG and PNG</p>				  
                </div>
				</div>					
				
          </div>

		  <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" <?php if($status) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if(!$status) echo 'selected'; ?>>In Active</option>                   
                  </select>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
			<?php } ?>
          </div>
          <!-- /.box -->
		  </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>
