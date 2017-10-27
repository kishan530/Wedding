 <?php include('header.php') ?>
<?php

   $errors = array();
  
   $message = '';
  // if (isset($_GET["id"])) {
          //  $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM home_page_banners WHERE Id = '5'";
			$result = mysqli_query($con,$sql);
			$banner = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			$Position = mysqli_real_escape_string($con,$banner['Position']);  
			$status = $banner['active'];
			$image_path = $banner['File_path'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = " banner found";
				 }
			
      // }else{
		// $errors[] = "No banner found";
	  // }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

       $video = $_POST["Video"];
	 
	  $design_file_rightBanner = null;
	if(isset($_FILES['rightBanner'])){
	  
      $errors= array();
	 
	  $design_file_rightBanner = $_FILES['rightBanner']['name'];
		  $file_size =$_FILES['rightBanner']['size'];
		  $file_tmp =$_FILES['rightBanner']['tmp_name'];
		  $file_type=$_FILES['rightBanner']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['rightBanner']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  if(!is_null($design_file_rightBanner) && $design_file_rightBanner!=''){
			  if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			  }
			  if(count($errors)==0){
				 move_uploaded_file($file_tmp,"../images/banner/".$design_file_rightBanner);
			  }
		  }
	}
	  $design_file_adBanner = null;
	  if(isset($_FILES['adBanner'])){
	  
      $errors= array();
	 
	  $design_file_adBanner = $_FILES['adBanner']['name'];
		  $file_size =$_FILES['adBanner']['size'];
		  $file_tmp =$_FILES['adBanner']['tmp_name'];
		  $file_type=$_FILES['adBanner']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['adBanner']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  if(!is_null($design_file_adBanner) && $design_file_adBanner!=''){
			  if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			  }
			  if(count($errors)==0){
				 move_uploaded_file($file_tmp,"../images/banner/".$design_file_adBanner);
			  }
		  }
	}
	

	  if(count($errors)==0){
		 if(is_null($design_file_rightBanner) || $design_file_rightBanner=='')
			$design_file_rightBanner = $image_path;
		$sql = "Update home_page_banners set File_path = '$design_file_rightBanner' where Id = '6' ";
		echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "banners updated successfully.";
		} else{
			 $errors[]= "Could not able to update banners " . mysqli_error($con);
		}
	  } 
	if(count($errors)==0){
		 if(is_null($design_file_adBanner) || $design_file_adBanner=='')
			$design_file_adBanner = $image_path;
		$sql = "Update home_page_banners set File_path = '$design_file_adBanner' where Id = '4' ";
		echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "banners updated successfully.";
		} else{
			 $errors[]= "Could not able to update banners " . mysqli_error($con);
		}
	  }
	  if(count($errors)==0){
		$sql = "Update home_page_banners set File_path = '$video' where Id = '5' ";
		echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "banners updated successfully.";
		} else{
			 $errors[]= "Could not able to update banners " . mysqli_error($con);
		}
	  }
	
		//echo var_dump($errors);
		//exit();
	 
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
        Update banners
        <small>edit banner here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit banner</li>
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
            <form role="form" action="edithome-page-banner.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="" >
              <div class="box-body">
			      <!--  <div class="form-group">
                       <label for="Position">Position</label>
                          <input type="text" class="form-control" id="Position" name="Position" placeholder="Enter Design Title" value="<?php echo $Position; ?>" required >
                    </div> -->
			      <div class="form-group">
					      <label class="control-label col-sm-2" for="Video">VIDEO</label>
					    <div class="col-sm-10">          
						   <input type="text" class="form-control" id="Video" name="Video" placeholder="update video"  value=""><br/>
					    </div>
					</div>	
				<div class="form-group">
					  <label class="control-label col-sm-2" for="inputFile">RIGHT BANNER</label>
				   <div class="col-sm-10">          
					   <input type="file" id="inputFile" name="rightBanner">
					   <br/>
				   </div>				
                </div>
			<!--	<div class="form-group">
					  <label class="control-label  col-sm-2" for="inputFile">LEFT BANNER</label>
				   <div class="col-sm-10">          
					   <input type="file" id="inputFile"  name="image2">
					   <br/>
				   </div>				
                </div> -->  
				<div class="form-group">
					  <label class="control-label col-sm-2" for="inputFile">ADD BANNER</label>
				   <div class="col-sm-10">          
					   <input type="file" id="inputFile" name="adBanner">
					    <p class='help-block'>Supported formats JPEG, JPG and PNG</p>
					   <br/>
				   </div>				
                </div>
				<!--<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" <?php if($status) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if(!$status) echo 'selected'; ?>>In Active</option>                   
                  </select>
                </div> -->

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
