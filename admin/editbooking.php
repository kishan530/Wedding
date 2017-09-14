<?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM booking WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$Service = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $name = mysqli_real_escape_string($con,$Service['name']);
             $email = mysqli_real_escape_string($con,$Service['email']);
			 $mobile = mysqli_real_escape_string($con,$Service['mobile']);
			 $selected_date = mysqli_real_escape_string($con,$Service['selected_date']);
			 $selected_time = mysqli_real_escape_string($con,$Service['selected_time']);
			 $amount = mysqli_real_escape_string($con,$Service['amount']);
			 $booked_on = mysqli_real_escape_string($con,$Service['booked_on']);			
			  $status = $Service['active'];
			 
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = " booking-table found";
				 }
			
       }else{
		 $errors[] = "No booking-table found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["name"])) {
               $errors[] = "name is required";
       }
	
	  $name = mysqli_real_escape_string($con,$_POST['name']);
      $email = mysqli_real_escape_string($con,$_POST['email']);
	  $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
      $selected_date = mysqli_real_escape_string($con,$_POST['selected_date']);	
      $selected_time = mysqli_real_escape_string($con,$_POST['selected_time']);
      $amount = mysqli_real_escape_string($con,$_POST['amount']);
      $booked_on = mysqli_real_escape_string($con,$_POST['booked_on']);	  
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
   
     if(count($errors)==0){
		 	if(is_null($design_file_name))
			$design_file_name = $image_path;
		$sql = "Update booking set  name= '$name',email= '$email',mobile = '$mobile',selected_date = '$selected_date',selected_time = '$selected_time',amount = '$amount',booked_on = '$booked_on',active='1' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "booking-table updated successfully.";
		} else{
			 $errors[]= "Could not able to update booking-table " . mysqli_error($con);
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
        Edit booking-table
        <small>edit booking-table here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit booking-table</li>
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
            <form role="form" action="editbooking.php?id=<?php echo $Service['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $Service['id']; ?>" >
              <div class="form-group">
                  <label for="name">name</label>
                  <input type="text" class="form-control" id="name"  name="name" placeholder="Enter name" value="<?php echo $name; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="email">email</label>
                  <input type="text" class="form-control" id="email"  name="email" placeholder="Enter email" value="<?php echo $email; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="mobile">mobile</label>
                  <input type="text" class="form-control" id="mobile"  name="mobile" placeholder="Enter mobile" value="<?php echo $mobile; ?>" required >
                </div>
				<div class="form-group">
                  <label for="selected_date">selected_date</label>
                  <input type="text" class="form-control" id="selected_date" name="selected_date" placeholder="Enter selected_date" value="<?php echo $selected_date; ?>" required >
                </div>
				<div class="form-group">
                  <label for="selected_time">selected_time</label>
                  <input type="text" class="form-control" id="selected_time" name="selected_time" placeholder="Enter selected_time" value="<?php echo $selected_time; ?>" required >
                </div>
				<div class="form-group">
                  <label for="amount">amount</label>
                  <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="<?php echo $amount; ?>" required >
                </div>
				<div class="form-group">
                  <label for="booked_on">booked_on</label>
                  <input type="text" class="form-control" id="booked_on" name="booked_on" placeholder="Enter booked_on" value="<?php echo $booked_on; ?>" required >
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
