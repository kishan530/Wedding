 <?php include('config.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_POST["id"])) {
            $id = mysqli_real_escape_string($con,$_POST['id']); 
			 $sql = "SELECT * FROM category WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$category = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $type = mysqli_real_escape_string($con,$category['type']); 
			  $status = $category['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No category found";
				 }
			
       }else{
		 $errors[] = "No category found";
	   }
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["category"])) {
               $errors[] = "category is required";
       }
	
	  $type = mysqli_real_escape_string($con,$_POST['category']); 
	  $id = mysqli_real_escape_string($con,$_POST['id']);
	  $status = $_POST['status'];
	 
	
     if(count($errors)==0){
		$sql = "Update category set type = '$type',active = '$status' where id = '$id' ";
		//echo $sql;
		if(mysqli_query($con, $sql)){
			$message = "category updated successfully.";
		} else{
			 $errors[]= "Could not able to update category " . mysqli_error($con);
		}
	  } 
	  
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
   }
?>

<form role="form" id="edit-category-form" action="editCategory.php?id=<?php echo $category['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $category['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category Title" value="<?php echo $type; ?>" required >
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