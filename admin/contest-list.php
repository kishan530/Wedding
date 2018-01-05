 <?php include('header.php') ?>

<?php
   $error = '';
   $count = 0;    
      
      $sql = "SELECT * FROM contest";
      $result = mysqli_query($con,$sql);
	  $contests = array();
	  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	 { 
		$contests[] = $row;
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
       Contest List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contest List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
 <div class="row">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
		  <h3 id="error"></h3>
		  <?php
				if($count>0) {
			?>
					
			<div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="Contest">
                <tr>
                  <th>Sl.No</th>
                  <th>Name</th>
				  <th>Email</th>
                  <th>Mobile</th>
				  <th>Message</th>
				  <th>File</th>
				  <th>Date of Wedding</th>
				  <th>Number of Events</th>
				  <th>Location</th>
				  <th>Day/Night</th>
                </tr>
				<?php		
						$i = 0;
						foreach($contests as $contest){
						$i++;
						//echo var_dump($design);
						?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $contest['name']; ?></td>
				  <td><?php echo $contest['email']; ?></td>
				  <td><?php echo $contest['mobile']; ?></td>
				  <td><?php echo $contest['message']; ?></td>
                 <td>
				  <a href="../images/contest/<?php echo $contest['file']; ?>" data-fancybox data-caption="<?php echo $contest['name']; ?>">
				  <img src="../images/contest/<?php echo $contest['file']; ?>" height="50" width="50" id="imgbox" />
				  </a>
				  </td>
				  <td><?php echo $contest['date']; ?></td>
				  <td><?php echo $contest['events']; ?></td>
				  <td><?php echo $contest['location']; ?></td>
				  <td><?php echo $contest['day_or_night']; ?></td>
                  <td>
				 <!-- <a href="editcontest.php?Id=<?php echo $contest['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-contest.php?Id=<?php echo $contest['id']; ?>" title="<?php echo $contest['name']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>-->
				  </td>
                </tr>
               <?php
						}
						?>
              </table>
            </div>
																								
						<?php
							
					  }else {
						 echo "<span>No contest found </span>";
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
$("#Contest").on('click', '.delete', function (e) {
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

<link rel="stylesheet" type="text/css" href="plugins\fancybox\jquery.fancybox.min.css">

	<script src="plugins\fancybox\jquery.fancybox.min.js"></script>
