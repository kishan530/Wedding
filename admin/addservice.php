<?php include('header.php') ?>

<?php

	 $Tittle = $type = ''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["Tittle"])) {
               $errors[] = "Tittle is required";
       }
	
	 $Tittle = mysqli_real_escape_string($con,$_POST['Tittle']); 
	  $type = mysqli_real_escape_string($con,$_POST['type']); 
	 if(isset($_FILES['image'])){
	  $design_file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$design_file_name)));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  if(count($errors)==0){
			 move_uploaded_file($file_tmp,"../images/service/".$design_file_name);
		  }
	}
	 
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	//$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO styling_service(Tittle ,image,type, active) VALUES ('$Tittle ','$design_file_name','$type','1')";
		if(mysqli_query($con, $sql)){
			$message = "service added successfully.";
			 $Tittle = '';
			  
		} else{
			 $errors[]= "Could not able to save service " . mysqli_error($con);
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
        Add Styling-Service
        <small>add new Service here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add Service</li>
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
			<?php } ?>
            <!-- form start -->
			
            <form role="form" action="addservice.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="Tittle">Tittle</label>
                  <input type="text" class="form-control" id="Tittle"  name="Tittle" placeholder="Enter Tittle" value="<?php echo $Tittle; ?>" required >
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
                </div>-->
             </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
		  </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.php') ?>