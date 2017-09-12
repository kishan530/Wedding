<?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["Id"])) {
            $Id = mysqli_real_escape_string($con,$_GET['Id']); 
			 $sql = "SELECT * FROM styling_service WHERE Id =$Id";
			$result = mysqli_query($con,$sql);
			$Service = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $Title = mysqli_real_escape_string($con,$_POST['Title']);
             $type = mysqli_real_escape_string($con,$_POST['type']);			 
			  $status = $Service['active'];
			  $image_path = $Service['image'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No Service found";
				 }
			
       }else{
		 $errors[] = "No Service found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["Tittle"])) {
               $errors[] = "Tittle is required";
       }
	
	  $Tittle = mysqli_real_escape_string($con,$_POST['Tittle']);
      $type = mysqli_real_escape_string($con,$_POST['type']);	  
	  $Id = mysqli_real_escape_string($con,$_POST['Id']);
	  $status = $_POST['status'];
	 
	  
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
			 move_uploaded_file($file_tmp,"../images/Service/".$design_file_name);
		  }
	  
   
     if(count($errors)==0){
		 	if(is_null($design_file_name))
			$design_file_name = $image_path;
		$sql = "Update styling_service set Tittle = '$Tittle',image= '$design_file_name',type = '$type',active = '$status' where Id = '$Id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "Service updated successfully.";
		} else{
			 $errors[]= "Could not able to update Service " . mysqli_error($con);
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
        Edit  Styling-Sedvice
        <small>edit Service here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit Service</li>
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
            <form role="form" action="editservice.php?Id=<?php echo $Service['Id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="Id" value="<?php echo $Service['Id']; ?>" >
              <div class="box-body">
				<div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" class="form-control" Id="Tittle"  name="Tittle" placeholder="Enter Tittle" value="<?php echo $Title; ?>" required >
                </div>
               <div id="upload_image_widget">
                <div class='form-group'>
                  <label for='inputFile'>Image</label>
                  <input type='file' id='inputFile' name='image'> 
				<p class='help-block'>Supported formats JPEG, JPG and PNG</p>				  
                </div>
				</div>
				<div class="form-group">
                  <label>type</label>
                  <select class="form-control" name="type">
                     <option value="style board" <?php if($type) echo 'selected'; ?>>style board</option>
                    <option value="couple co-ordination" <?php if(!$type) echo 'selected'; ?>>couple co-ordination</option>                  
                  </select>
                </div>				
				<!--<div class="form-group">
                  <label for="type">type</label>
                  <input type="text" class="form-control" id="type" name="type" placeholder="Enter type" value="<?php echo $type; ?>" required >
                </div> -->
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
