<?php include('config.php') ?>
<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT * FROM season";
      $result = mysqli_query($con,$sql);
	  $seasons = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$seasons[] = $row;
	 }
      
      $count = mysqli_num_rows($result);
?>


				<?php		
						$i = 0;
						foreach($seasons as $season){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $season['season']; ?></td>
                  <td>
					<?php if($season['active']>0) {?>
				  <span class="label label-success">Active</span>
				  <?php }else{ ?>
				  <span class="label label-danger">In Active</span>
				   <?php } ?>
				  </td>
                  <td>
				  <a href="season-edit.php?id=<?php echo $season['id']; ?>"class="edit"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-season.php?id=<?php echo $season['id']; ?>" title="<?php echo $season['season']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>