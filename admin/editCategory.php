 <?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM category WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$category = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $type = mysqli_real_escape_string($con,$category['type']); 
			  $status = $category['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No category found";
				 }
			
       }else{
		 $errors[] = "No category found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["category"])) {
               $errors[] = "category is required";
       }
	
	  $type = mysqli_real_escape_string($con,$_POST['category']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
	
     if(count($errors)==0){
		$sql = "Update category set type = '$type',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "category updated successfully.";
		} else{
			 $errors[]= "Could not able to update category " . mysqli_error($con);
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
        Edit category
        <small>edit category here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit category</li>
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
            <form role="form" action="editCategory.php?id=<?php echo $category['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $category['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category Title" value="<?php echo $type; ?>" required >
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
