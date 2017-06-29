<?php include('header.php') ?>

<?php

	 $name = ''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["season"])) {
               $errors[] = "season is required";
       }
	
	 $name = mysqli_real_escape_string($con,$_POST['season']); 
     
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO season (season, active) VALUES ('$name', 1)";
		if(mysqli_query($con, $sql)){
			$message = "Season added successfully.";
			 $name = ''; 
		} else{
			 $errors[]= "Could not able to save season " . mysqli_error($con);
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
        Add Season
        <small>add new season here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add season</li>
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
			
            <form role="form" action="addSeason.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="season">Season</label>
                  <input type="text" class="form-control" id="season" name="season" placeholder="Enter season" value="<?php echo $name; ?>" required >
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

