 <?php include('header.php') ?>
<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT b.id,b.name,b.email,b.mobile,b.selected_date,s.time,s.amount,s.booked_on FROM booking b,slots s where s.id=b.selected_time";
      $result = mysqli_query($con,$sql);
	  $Service = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$Service[] = $row;
	 }
      
      $count = mysqli_num_rows($result);
?>



  <!-- =============================================== -->

  <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       booking-List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">booking-List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 <div class="row">
      <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
		  <h3 id="error"></h3>
		  <?php
				if($count>0) {
			?>
					
			<div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="Service">
                <tr>
                  <th>Sl.No</th>
                  <th>name</th>
				  <th>email</th>
				  <th>mobile</th>
				  <th>selected_date</th>
				  <th>selected_time</th>
				  <th>amount</th>
				   <th>booked_on</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
				<?php		
						$i = 0;
						foreach($Service as $Service){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $Service['name']; ?></td>
				  <td><?php echo $Service['email']; ?></td>
				  <td><?php echo $Service['mobile']; ?></td>
				  <td><?php echo $Service['selected_date']; ?></td>
				  <td><?php echo $Service['time']; ?></td>
				  <td><?php echo $Service['amount']; ?></td>
				  <td><?php echo $Service['booked_on']; ?></td>
                  <td>
					<?php if($Service['active']>0) {?>
				  <span class="label label-success">Active</span>
				  <?php }else{ ?>
				  <span class="label label-danger">In Active</span>
				   <?php } ?>
				  </td>
                  <td>
				  <a href="editbooking.php?id=<?php echo $Service['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-booking.php?id=<?php echo $Service['id']; ?>" title="<?php echo $Service['name']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>
              </table>
            </div>
																								
						<?php
							
					  }else {
						 echo "<span>No booking found </span>";
					  }
					?>
          </div>
          <!-- /.box -->
		  </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include('footer.php') ?>

<script>
$("#Service").on('click', '.delete', function (e) {
	e.preventDefault(); //STOP default action
	  var url = $(this).attr('href');
	   var name = $(this).attr('title');
        if (!confirm(" "+name+" details will be deleted permanently form the system, please confirm")) {
		            exit();
		  }	
	  var tr = $(this).parent().parent();
		        $.ajax({
					url: url,
					type: "GET",
					success: function(data) {
						//alert(data); 
						if(data=='true'){
							tr.remove();
						}else{
							$('#error').html(data);
						}
					},
					
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{
					 alert('Error: ' +  errorThrown);
					}
				});			       
});
</script>