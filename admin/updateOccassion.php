 <?php include('config.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_POST["id"])) {
            $id = mysqli_real_escape_string($con,$_POST['id']); 
			 $sql = "SELECT * FROM occassion WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$occasion = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $name = mysqli_real_escape_string($con,$occasion['occassion_name']); 
			  $status = $occasion['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No occasion found";
				 }
			
       }else{
		 $errors[] = "No occasion found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["occasion"])) {
               $errors[] = "occasion is required";
       }
	
	  $name = mysqli_real_escape_string($con,$_POST['occasion']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
	
     if(count($errors)==0){
		$sql = "Update occassion set occassion_name = '$name',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "occasion updated successfully.";
		} else{
			 $errors[]= "Could not able to update occasion " . mysqli_error($con);
		}
	  } 
	  
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
   }
?>


<form role="form" id="edit-occassion-form" action="editOccassion.php?id=<?php echo $occasion['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $occasion['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="occasion">Occasion</label>
                  <input type="text" class="form-control" id="occasion" name="occasion" placeholder="Enter Occasion Title" value="<?php echo $name; ?>" required >
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