 <?php include('header.php') ?>
<?php
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
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM design WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$design = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			$design_title = mysqli_real_escape_string($con,$design['design_title']); 
			$designed_by = mysqli_real_escape_string($con,$design['designed_by']); 
			$category = mysqli_real_escape_string($con,$design['category']); 
			$style = mysqli_real_escape_string($con,$design['style']); 
			// $outfit_type = mysqli_real_escape_string($con,$design['outfit_type']); 
			$occassion = mysqli_real_escape_string($con,$design['occassion']); 
			$season = mysqli_real_escape_string($con,$design['season']); 
			$couple_coordination = mysqli_real_escape_string($con,$design['couple_coordination']); 
			$wedding_after_dress = mysqli_real_escape_string($con,$design['wedding_after_dress']); 
			$description = $design['description'];
			$status = $design['status'];
			$image_path = $design['image_path'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No design found";
				 }
			
       }else{
		 $errors[] = "No design found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["design_title"])) {
               $errors[] = "Title is required";
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
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
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
		if(is_null($file_name))
			$file_name = $image_path;
		$sql = "Update design set design_title = '$design_title',designed_by = '$designed_by',category = '$category',style = '$style',occassion = '$occassion', season = '$season',couple_coordination = '$couple_coordination',wedding_after_dress = '$wedding_after_dress', description = '$description',  status = '$status',  image_path = '$file_name' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "design updated successfully.";
		} else{
			 $errors[]= "Could not able to update design " . mysqli_error($con);
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
        Edit Design
        <small>edit design here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit design</li>
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
            <form role="form" action="editDesign.php?id=<?php echo $design['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $design['id']; ?>" >
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
				
				
			<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" <?php if($status) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if(!$status) echo 'selected'; ?>>In Active</option>                   
                  </select>
                </div>
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

<script>
$("#carImages").on('click', '.delete', function (e) {
	e.preventDefault(); //STOP default action
	$('#error').html();
	  var url = $(this).attr('href');
	   var name = $(this).attr('title');
        if (!confirm(" "+name+" details will be deleted permanently form the system, please confirm")) {
		            exit();
		  }	
	  var tr = $(this).parent().parent();
		        $.ajax({
					url: url,
					type: "GET",
					success: function(data) {
						//alert(data); 
						if(data=='true'){
							tr.remove();
						}else{
							$('#error').html(data);
						}
					},
					
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{
					 alert('Error: ' +  errorThrown);
					}
				});			       
});

$("#carImages").on('blur', '.sequence', function (e) {
	e.preventDefault(); //STOP default action
	$('#error').html();
	  var url = 'update-car-image.php';
	   var id = $(this).attr('id');
	    var sequence = $(this).val();
	   url = url+'?id='+id+'&sequence='+sequence;
		        $.ajax({
					url: url,
					type: "GET",
					success: function(data) {
						//alert(data); 
						if(data=='true'){
							$('#error').html('Updated successfully');
						}else{
							$('#error').html(data);
						}
					},
					
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{
					 alert('Error: ' +  errorThrown);
					}
				});			       
});
</script>
