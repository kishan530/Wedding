<?php include('header.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM styling_form WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$Service = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $date = mysqli_real_escape_string($con,$Service['date']);
             $time = mysqli_real_escape_string($con,$Service['time']);
			$message = mysqli_real_escape_string($con,$Service['message']);			 
			  $status = $Service['active'];
			 
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = " Service-table found";
				 }
			
       }else{
		 $errors[] = "No Service-table found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["date"])) {
               $errors[] = "date is required";
       }
	
	  $date = mysqli_real_escape_string($con,$_POST['date']);
      $time = mysqli_real_escape_string($con,$_POST['time']);
      $message = mysqli_real_escape_string($con,$_POST['message']);	  
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
   
     if(count($errors)==0){
		 	if(is_null($design_file_name))
			$design_file_name = $image_path;
		$sql = "Update styling_form set  date= '$date',time= '$time',message = '$message',active='1' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "Service-table updated successfully.";
		} else{
			 $errors[]= "Could not able to update Service-table " . mysqli_error($con);
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
        Edit  Styling-Sedvice-table
        <small>edit Service-table here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Edit Service-table</li>
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
            <form role="form" action="editstyling-service-table.php?id=<?php echo $Service['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $Service['id']; ?>" >
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
