<?php include('header.php') ?>

<?php

	 $date = $time = $message = $active =''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["date"])) {
               $errors[] = "date is required";
       }
	
	 $date = mysqli_real_escape_string($con,$_POST['date']); 
	  $time = mysqli_real_escape_string($con,$_POST['time']); 
	  $message = mysqli_real_escape_string($con,$_POST['message']);
	 
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	//$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO styling_requests(date,time,message,active) VALUES ('$date ','$time','$message','1')";
		if(mysqli_query($con, $sql)){
			$message = "service-requests added successfully.";
			 $date = '';
			  
		} else{
			 $errors[]= "Could not able to save service-requests " . mysqli_error($con);
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
        Add Styling-Service-requests
        <small>add new Service-requests here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add Service-requests</li>
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
			
            <form role="form" action="addstyling-services-requests.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="date">date</label>
                  <input type="text" class="form-control" id="date"  name="date" placeholder="Enter date" value="<?php echo $date; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="time">time</label>
                  <input type="text" class="form-control" id="time"  name="time" placeholder="Enter time" value="<?php echo $time; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="message">message</label>
                  <input type="text" class="form-control" id="message" name="message" placeholder="Enter message" value="<?php echo $message; ?>" required >
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