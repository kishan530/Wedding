<?php include('config.php') ?>
<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT * FROM style";
      $result = mysqli_query($con,$sql);
	  $styles = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$styles[] = $row;
	 }
      
      $count = mysqli_num_rows($result);
?>

				<?php		
						$i = 0;
						foreach($styles as $style){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $style['style']; ?></td>
                  <td>
					<?php if($style['active']>0) {?>
				  <span class="label label-success">Active</span>
				  <?php }else{ ?>
				  <span class="label label-danger">In Active</span>
				   <?php } ?>
				  </td>
                  <td>
				  <a href="styleedit.php?id=<?php echo $style['id']; ?>" class="edit"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-style.php?id=<?php echo $style['id']; ?>" title="<?php echo $style['style']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>
              