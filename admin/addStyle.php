<?php include('header.php') ?>

<?php

	 $styleType = ''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["style"])) {
               $errors[] = "style is required";
       }
	
	 $styleType = mysqli_real_escape_string($con,$_POST['style']);
 $status = mysqli_real_escape_string($con,$_POST['status']); 	 
     
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO style (style, active) VALUES ('$styleType', '$status')";
		if(mysqli_query($con, $sql)){
			$message = "Style added successfully.";
			 $styleType = ''; 
		} else{
			 $errors[]= "Could not able to save style " . mysqli_error($con);
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
        Add Style
        <small>add new style here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add Style</li>
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
			
            <form role="form" action="addStyle.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="style">Style</label>
                  <input type="text" class="form-control" id="style" name="style" placeholder="Enter style" value="<?php echo $styleType; ?>" required >
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

