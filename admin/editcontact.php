<?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["Id"])) {
            $Id = mysqli_real_escape_string($con,$_GET['Id']); 
			 $sql = "SELECT * FROM contact_us WHERE Id =$Id";
			$result = mysqli_query($con,$sql);
			$Service = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $Name = mysqli_real_escape_string($con,$Service['Name']);
             $Email = mysqli_real_escape_string($con,$Service['Email']);
			 $PhoneNumber = mysqli_real_escape_string($con,$Service['PhoneNumber']);
			$Message = mysqli_real_escape_string($con,$Service['Message']);			 
			  $status = $Service['active'];
			 
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = " contact-table found";
				 }
			
       }else{
		 $errors[] = "No contact-table found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["Name"])) {
               $errors[] = "Name is required";
       }
	
	  $Name = mysqli_real_escape_string($con,$_POST['Name']);
      $Email = mysqli_real_escape_string($con,$_POST['Email']);
	  $PhoneNumber = mysqli_real_escape_string($con,$_POST['PhoneNumber']);
      $Message = mysqli_real_escape_string($con,$_POST['Message']);	  
	  $Id = mysqli_real_escape_string($con,$_POST['Id']);
	  $status = $_POST['status'];
	 
   
     if(count($errors)==0){
		 	if(is_null($design_file_name))
			$design_file_name = $image_path;
		$sql = "Update contact_us set  Name= '$Name',Email= '$Email',PhoneNumber = '$PhoneNumber',Message = '$Message',active='1' where Id = '$Id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "contact-table updated successfully.";
		} else{
			 $errors[]= "Could not able to update contact-table " . mysqli_error($con);
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
        Edit contact-table
        <small>edit contact-table here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit contact-table</li>
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
            <form role="form" action="editcontact.php?Id=<?php echo $Service['Id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="Id" value="<?php echo $Service['Id']; ?>" >
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
		        <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" <?php if($status) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if(!$status) echo 'selected'; ?>>In Active</option>                   
                  </select>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
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
