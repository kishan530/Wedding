<?php include('config.php') ?>
<?php
	
   $errors = array();
   $message = '';
   if (isset($_GET["id"])) {
            $id = mysqli_real_escape_string($con,$_GET['id']); 
			 $sql = "SELECT * FROM season WHERE id =$id";
			$result = mysqli_query($con,$sql);
			$season = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $name = mysqli_real_escape_string($con,$season['season']); 
			  $status = $season['active'];
			
			$count = mysqli_num_rows($result);
			if($count==0){
				 $errors[] = "No season found";
				 }
			
       }else{
		 $errors[] = "No season found";
	   }
	   ?>
	   
	   <h3> <?php echo $message ?> </h3>
			<?php foreach ($errors as $error){ ?>
			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			<?php }

			if(count($errors)==0){
			?>
			
            <!-- form start -->
            <form role="form" id="edit-season-form" action="updateSeason.php?id=<?php echo $season['id']; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $season['id']; ?>" >
              <div class="box-body">
			  
				
				
				
				
				<div class="form-group">
                  <label for="season">Season</label>
                  <input type="text" class="form-control" id="season" name="season" placeholder="Enter Season Title" value="<?php echo $name; ?>" required >
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