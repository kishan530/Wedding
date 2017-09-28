<?php include('header.php') ?>

<?php

	 $name = $email = $mobile =  $selected_date = $selected_time = $amount = $booked_on =$active =''; 
	
   $errors = array();
   $message = '';
   $slots =  array();

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
	 
     if(count($errors)==0){
		 
	//mysqli_autocommit($con,FALSE);
	//$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO booking(name,email,mobile,selected_date,selected_time,amount,booked_on,active) VALUES ('$name ','$email','$mobile','$selected_date','$selected_time','$amount','$booked_on','1')";
		if(mysqli_query($con, $sql)){
			$message = "booking-table added successfully.";
			 $date = '';
			 
			  
		} else{
			 $errors[]= "Could not able to save booking-table " . mysqli_error($con);
		}
	  }
	  $result = $con->query("SELECT * FROM slots");

	  
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
        Add booking-table
        <small>add new booking-table here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <!--  <li><a href="#">Projects</a></li> -->
        <li class="active">Add booking-table</li>
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
			
            <form role="form" action="addbooking.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="name">name</label>
                  <input type="text" class="form-control" id="name"  name="name" placeholder="Enter name" value="<?php echo $name; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="email">email</label>
                  <input type="email" class="form-control" id="email"  name="email" placeholder="Enter email" value="<?php echo $email; ?>" required >
                </div>	
				<div class="form-group">
                  <label for="mobile">mobile</label>
                  <input type="mobile" class="form-control" id="mobile"  name="mobile" placeholder="Enter mobile" value="<?php echo $mobile; ?>" required >
                </div>
				<div class="form-group">
                  <label for="selected_date">selected_date</label>
                  <input type="text" class="form-control" id="selected_date" name="selected_date" placeholder="Enter selected_date" value="<?php echo $selected_date; ?>" required >
                </div>
				 <div class="form-group">
                    <label for="selected_time">selected_time</label>
				   <select id="selected_time" name="selected_time"  class="form-control">
						<option>Select</option>
						<?php foreach($slots as $s){ ?>
                        <option value="<?php echo $s['id']; ?>" <?php if($selected_time==$s['id']) echo 'selected'; ?>><?php echo $s['time']; ?></option>
						<?php } ?>
                   </select>
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