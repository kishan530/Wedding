 <?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM season WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$season = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $name = mysqli_real_escape_string($con,$season['season']); 
			  $status = $season['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No season found";
				 }
			
       }else{
		 $errors[] = "No season found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["season"])) {
               $errors[] = "season is required";
       }
	
	  $name = mysqli_real_escape_string($con,$_POST['season']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
	
     if(count($errors)==0){
		$sql = "Update season set season = '$name',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "season updated successfully.";
		} else{
			 $errors[]= "Could not able to update season " . mysqli_error($con);
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
        Edit season
        <small>edit season here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit season</li>
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
            <form role="form" action="editSeason.php?id=<?php echo $season['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $season['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="season">Season</label>
                  <input type="text" class="form-control" id="season" name="season" placeholder="Enter Season Title" value="<?php echo $name; ?>" required >
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
