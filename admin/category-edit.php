 <?php include('config.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
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
	   ?>
	   
	   			<h3> <?php echo $message ?> </h3>
			<?php foreach ($errors as $error){ ?>
			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			<?php }

			if(count($errors)==0){
			?>
			
            <!-- form start -->
            <form role="form" id="edit-category-form" action="updateCategory.php?id=<?php echo $category['id']; ?>" method="POST" enctype="multipart/form-data">
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
			<?php } ?>