 <?php include('config.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_POST["id"])) {
            $id = mysqli_real_escape_string($con,$_POST['id']); 
			 $sql = "SELECT * FROM style WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$style = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $styleType = mysqli_real_escape_string($con,$style['style']); 
			  $status = $style['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No style found";
				 }
			
       }else{
		 $errors[] = "No style found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["style"])) {
               $errors[] = "style is required";
       }
	
	  $styleType = mysqli_real_escape_string($con,$_POST['style']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
	
     if(count($errors)==0){
		$sql = "Update style set style = '$styleType',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "style updated successfully.";
		} else{
			 $errors[]= "Could not able to update style " . mysqli_error($con);
		}
	  } 
	  
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
   }
?>


<form role="form" id="edit-style-form" action="editStyle.php?id=<?php echo $style['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $style['id']; ?>" >
              <div class="box-body">
	
				
				
				
				
				<div class="form-group">
                  <label for="style">Style</label>
                  <input type="text" class="form-control" id="style" name="style" placeholder="Enter Design Title" value="<?php echo $styleType; ?>" required >
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
