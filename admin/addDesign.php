<?php include('header.php') ?>

<?php

	 $design_title = $designed_by = $category = $style = $occassion = $season = $couple_coordination = $wedding_after_dress = $description = ''; 
	 $sql = "SELECT * FROM category";
      $result = mysqli_query($con,$sql);
	  $categories = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$categories[] = $row;
	 }
	 
	 $sql = "SELECT * FROM occassion";
      $result = mysqli_query($con,$sql);
	  $occassions = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$occassions[] = $row;
	 }
	 
	/* $sql = "SELECT * FROM outfit_type";
      $result = mysqli_query($con,$sql);
	  $outfitTypes = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$outfitTypes[] = $row;
	 } */
	 
	 $sql = "SELECT * FROM season";
      $result = mysqli_query($con,$sql);
	  $seasons = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$seasons[] = $row;
	 }
	 
	 $sql = "SELECT * FROM style";
      $result = mysqli_query($con,$sql);
	  $styles = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$styles[] = $row;
	 }
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["design_title"])) {
               $errors[] = "Design Title is required";
       }
	
	 $design_title = mysqli_real_escape_string($con,$_POST['design_title']); 
      $designed_by = mysqli_real_escape_string($con,$_POST['designed_by']); 
	  $category = mysqli_real_escape_string($con,$_POST['category']); 
	  $style = mysqli_real_escape_string($con,$_POST['style']); 
	  // $outfit_type = mysqli_real_escape_string($con,$_POST['outfit_type']); 
	   $occassion = mysqli_real_escape_string($con,$_POST['occassion']); 
	   $season = mysqli_real_escape_string($con,$_POST['season']); 
	   $couple_coordination = mysqli_real_escape_string($con,$_POST['couple_coordination']); 
	   $wedding_after_dress = mysqli_real_escape_string($con,$_POST['wedding_after_dress']); 
	  $description = $_POST['description'];
	  $file_name = null;
	  
	  if(isset($_FILES['image'])){
	  
      $errors= array();
	 
	  $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  if(count($errors)==0){
			 move_uploaded_file($file_tmp,"images/designs/".$file_name);
		  }
	}
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO design (design_title,image_path,designed_by,description,category,style,occassion,season,couple_coordination,wedding_after_dress,created_at, status) VALUES ('$design_title','$file_name','$designed_by','$description','$category','$style','$occassion','$season','$couple_coordination','$wedding_after_dress','$today', 1)";
		if(mysqli_query($con, $sql)){
			$message = "Design added successfully.";
			$design_title = $designed_by = $category = $style = $occassion = $season = $couple_coordination = $wedding_after_dress = $description = ''; 
		} else{
			 $errors[]= "Could not able to save Design " . mysqli_error($con);
		}
	  }

/*if(count($errors)==0){
	$design_id = $con->insert_id;
	$sequence = 1;
	foreach($fileNames as $fileName){
		$sql = "INSERT INTO car_list_imgaes (image_path,sequence,active,car_list_id) VALUES ('$fileName','$sequence',1,'$car_list_id')";
		if(mysqli_query($con, $sql)){
			$message = "Car added successfully.";
		} else{
			 $errors[]= "Could not able to upload car image " . mysqli_error($con);
		}
		$sequence = $sequence+1;
	}
	if(count($errors)==0)
	mysqli_commit($con);
}	*/  
	  
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
        Add Design
        <small>add new design here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add Design</li>
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
			
            <form role="form" action="addDesign.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="design_title">Design Title</label>
                  <input type="text" class="form-control" id="design_title" name="design_title" placeholder="Enter Design Title" value="<?php echo $design_title; ?>" required >
                </div>
				<div class="form-group">
                  <label for="designed_by">Designed By</label>
                  <input type="text" class="form-control" id="designed_by" name="designed_by" placeholder="Enter Designed By" value="<?php echo $designed_by; ?>" required >
                </div>
				
				<div class="form-group">
                  <label for="description">description</label>
			  
                <textarea class="textarea" id="description" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $description; ?></textarea>
            </div>
				
                <div class="form-group">
                  <label for="category">Category</label>
				  <select id="category" name="category"  class="form-control">
									<option>Select</option>
									<?php foreach($categories as $ca){ ?>
                                    <option value="<?php echo $ca['id']; ?>" <?php if($category==$ca['id']) echo 'selected'; ?>><?php echo $ca['type']; ?></option>
									<?php } ?>
                   </select>
                </div>
				
				 <div class="form-group">
                  <label for="style">Style</label>
				  <select id="style" name="style"  class="form-control">
									<option>Select</option>
									<?php foreach($styles as $s){ ?>
                                    <option value="<?php echo $s['id']; ?>" <?php if($style==$s['id']) echo 'selected'; ?>><?php echo $s['style']; ?></option>
									<?php } ?>
                   </select>
                </div>
				
				 <div class="form-group">
                  <label for="occassion">Occassion</label>
				  <select id="occassion" name="occassion"  class="form-control">
									<option>Select</option>
									<?php foreach($occassions as $occ){ ?>
                                    <option value="<?php echo $occ['id']; ?>" <?php if($occassion==$occ['id']) echo 'selected'; ?>><?php echo $occ['occassion_name']; ?></option>
									<?php } ?>
                   </select>
                </div>
				
				
				 <div class="form-group">
                  <label for="season">Season</label>
				  <select id="season" name="season"  class="form-control">
									<option>Select</option>
									<?php foreach($seasons as $se){ ?>
                                    <option value="<?php echo $se['id']; ?>"  <?php if($season==$se['id']) echo 'selected'; ?>><?php echo $se['season']; ?></option>
									<?php } ?>
                   </select>
                </div>
				
				<div class="form-group">
                  <label>Couple Coordination</label>
                  <select class="form-control" name="couple_coordination">
                     <option value="1" <?php if($couple_coordination) echo 'selected'; ?>>Yes</option>
                    <option value="0" <?php if(!$couple_coordination) echo 'selected'; ?>>No</option>                  
                  </select>
                </div>
				<div class="form-group">
                  <label>Wedding After Dress</label>
                  <select class="form-control" name="wedding_after_dress">
                    <option value="1" <?php if($wedding_after_dress) echo 'selected'; ?>>Yes</option>
                    <option value="0" <?php if(!$wedding_after_dress) echo 'selected'; ?>>No</option>                   
                  </select>
                </div>
				
				 
				<div id="upload_image_widget">
                <div class='form-group'>
                  <label for='inputFile'>Image</label>
                  <input type='file' id='inputFile' name='image' multiple> 
				<p class='help-block'>Supported formats JPEG, JPG and PNG</p>				  
                </div>
				</div>	
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

<script>
    $(document).ready(function() {
$('#add-more-images').click(function(e){	
	e.preventDefault();
    	 var widget = $("#upload_image_widget").html();
		 $('#add-more-images').next(widget);
});
});
</script>
