<?php include('header.php') ?>

<?php

	 $name = $description = $image_path = $catogery = $status = ''; 
	
	 
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

   //echo var_dump($_POST);
   //echo var_dump($_FILES['recommendation_image']);
   //exit();
    if (!isset($_POST["name"])) {
               $errors[] = " name is required";
       }
	
	  $name = mysqli_real_escape_string($con,$_POST['name']); 
      $description = mysqli_real_escape_string($con,$_POST['description']); 
	  $catogery = mysqli_real_escape_string($con,$_POST['catogery']);  
      $status = $_POST['status']; 	   
	  $design_file_name = null;
	  
	  if(isset($_FILES['image'])){
	  $design_file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		   if(!is_null($design_file_name) && $design_file_name!=''){
			if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if(count($errors)==0){
			 move_uploaded_file($file_tmp,"../images/articles/".$design_file_name);
			}
		   }
	}
	
     if(count($errors)==0){

		$sql = "INSERT INTO article (name,description,image_path,catogery,active) VALUES ('$name','$description','$design_file_name','$catogery','1')";
		
		if(mysqli_query($con, $sql)){
			$message = "articles added successfully.";
			$name = $image_path =  $catogery = $description = ''; 
		} else{
			 $errors[]= "Could not able to save articles " . mysqli_error($con);
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
        Add Article
        <small>add new Article here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add Article</li>
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
			
            <form role="form" action="addArticle.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name " value="<?php echo $name; ?>" required >
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
                <div class="form-group">
                  <label for="catogery">catogery</label>
				  <select id="catogery" name="catogery"  class="form-control">
						    <option value="2" <?php if($catogery) echo 'selected'; ?>>Testimonial</option>
							<option value="1" <?php if($catogery) echo 'selected'; ?>>Blog</option>
                            <option value="0" <?php if(!$catogery) echo 'selected'; ?>>events</option>
								
                   </select>
                </div>
				<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" <?php if($status) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if(!$status) echo 'selected'; ?>>In Active</option>                   
                  </select>
                </div>
				<div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
				</div>	
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

