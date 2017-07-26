 <?php include('config.php') ?>
<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT * FROM occassion";
      $result = mysqli_query($con,$sql);
	  $occasions = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$occasions[] = $row;
	 }
      
      $count = mysqli_num_rows($result);
?>


				<?php		
						$i = 0;
						foreach($occasions as $occasion){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $occasion['occassion_name']; ?></td>
                  <td>
					<?php if($occasion['active']>0) {?>
				  <span class="label label-success">Active</span>
				  <?php }else{ ?>
				  <span class="label label-danger">In Active</span>
				   <?php } ?>
				  </td>
                  <td>
				  <a href="occassion-edit.php?id=<?php echo $occasion['id']; ?>"class="edit"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-occassion.php?id=<?php echo $occasion['id']; ?>" title="<?php echo $occasion['occassion_name']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>