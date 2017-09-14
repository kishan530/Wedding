<?php include('header.php') ?>

<?php

	 $Name = $Email = $PhoneNumber =  $Message = $active =''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["Name"])) {
               $errors[] = "Name is required";
       }
	
	 $Name = mysqli_real_escape_string($con,$_POST['Name']); 
	  $Email = mysqli_real_escape_string($con,$_POST['Email']); 
	   $PhoneNumber = mysqli_real_escape_string($con,$_POST['PhoneNumber']); 
	  $Message = mysqli_real_escape_string($con,$_POST['Message']);
	 
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	//$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO contact_us(Name,Email,PhoneNumber,Message,active) VALUES ('$Name ','$Email','$PhoneNumber','$Message','1')";
		if(mysqli_query($con, $sql)){
			$message = "contact-table added successfully.";
			 $date = '';
			  
		} else{
			 $errors[]= "Could not able to save service-table " . mysqli_error($con);
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
        Add contact-table
        <small>add new contact-table here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add contact-table</li>
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
			
            <form role="form" action="addcontact.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="Name">Name</label>
                  <input type="text" class="form-control" id="Name"  name="Name" placeholder="Enter Name" value="<?php echo $Name; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="Email">Email</label>
                  <input type="text" class="form-control" id="Email"  name="Email" placeholder="Enter Email" value="<?php echo $Email; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="PhoneNumber">PhoneNumber</label>
                  <input type="text" class="form-control" id="PhoneNumber"  name="PhoneNumber" placeholder="Enter PhoneNumber" value="<?php echo $PhoneNumber; ?>" required >
                </div>
				<div class="form-group">
                  <label for="Message">Message</label>
                  <input type="text" class="form-control" id="Message" name="Message" placeholder="Enter Message" value="<?php echo $Message; ?>" required >
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