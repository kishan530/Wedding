 <?php include('header.php') ?>
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



  <!-- =============================================== -->

  <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Occasion List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Occasion List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
        <div class="col-md-5">
         <div class="box box-primary" id="occassion-form">
			
            <!-- form start -->
			
            <form role="form" action="addOccassion.php" method="POST" enctype="multipart/form-data" id="add-occassion-form">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="occasion">Occasion</label>
                  <input type="text" class="form-control" id="occasion" name="occasion" placeholder="Enter occasion" value="" required >
                </div>					 
				<div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="1" >Active</option>
                    <option value="0" >In Active</option>                   
                  </select>
                </div>
          </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		  </div>
      <div class="col-md-7">
          <!-- general form elements -->
          <div class="box box-primary">
		  <h3 id="error"></h3>
		  <?php
				if($count>0) {
			?>
					
			<div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="">
                <tr>
                  <th>Sl.No</th>
                  <th>Occassion</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
				<tbody id="occassions">
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
				</tbody>		
              </table>
            </div>
																								
						<?php
							
					  }else {
						 echo "<span>No occasions found </span>";
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
$("#occassion-form").on('submit', '#add-occassion-form', function (e) {
          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'addOccassion.php',
            data: $('form').serialize(),
            success: function () {
           <!--   alert('form was submitted'); -->
			 $( "#occassions" ).load('occassion.php');
			 $( "#occassion-form" ).load('add-occassion.php');
            }
          });

        });
	  

$("#occassion-form").on('submit', '#edit-occassion-form', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'updateOccassion.php',
            data: $('form').serialize(),
            success: function () {
            <!--  alert('form was submitted'); -->
			 $( "#occassions" ).load('occassion.php');
			 $( "#occassion-form" ).load('add-occassion.php');
            }
          });

        });

$("#occassions").on('click', '.edit', function (e) {
	e.preventDefault(); //STOP default action
	  var url = $(this).attr('href');
	  
	   $( "#occassion-form" ).load(url);
		       
});



$("#occassions").on('click', '.delete', function (e) {
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
