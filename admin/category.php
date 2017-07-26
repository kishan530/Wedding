 <?php include('config.php') ?>
<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT * FROM category";
      $result = mysqli_query($con,$sql);
	  $categories = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$categories[] = $row;
	 }
      
      $count = mysqli_num_rows($result);
?>


				<?php		
						$i = 0;
						foreach($categories as $category){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $category['type']; ?></td>
                  <td>
					<?php if($category['active']>0) {?>
				  <span class="label label-success">Active</span>
				  <?php }else{ ?>
				  <span class="label label-danger">In Active</span>
				   <?php } ?>
				  </td>
                  <td>
				  <a href="category-edit.php?id=<?php echo $category['id']; ?>"class="edit"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-category.php?id=<?php echo $category['id']; ?>" title="<?php echo $category['type']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>