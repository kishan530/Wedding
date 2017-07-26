 <?php include('header.php') ?>
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



  <!-- =============================================== -->

  <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Style List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Style List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
     <div class="col-md-5">
         <div class="box box-primary" id="style-form">
			
            <!-- form start -->
            <form role="form" action="addStyle.php" method="POST" enctype="multipart/form-data" id="add-style-form">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="style">Style</label>
                  <input type="text" class="form-control" id="style" name="style" placeholder="Enter style" value="" required >
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
                  <th>Style</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
				<tbody id="styles">
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
				  <a href="styleedit.php?id=<?php echo $style['id']; ?>"class="edit"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-style.php?id=<?php echo $style['id']; ?>" title="<?php echo $style['style']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
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
						 echo "<span>No Designs found </span>";
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

	
	 $("#style-form").on('submit', '#add-style-form', function (e) {
			
          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'addStyle.php',
            data: $('form').serialize(),
            success: function () {
            <!--  alert('form was submitted'); -->
			 $( "#styles" ).load('style.php');
			  $( "#style-form" ).load('add-style.php');
            }
          });

        });	
	
	  $("#style-form").on('submit', '#edit-style-form', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'updatestyle.php',
            data: $('form').serialize(),
            success: function () {
            <!--  alert('form was submitted'); -->
			 $( "#styles" ).load('style.php');
			 $( "#style-form" ).load('add-style.php');
            }
          });

        });

$("#styles").on('click', '.edit', function (e) {
	e.preventDefault(); //STOP default action
	  var url = $(this).attr('href');
	  
	   $( "#style-form" ).load(url);
		       
});


$("#styles").on('click', '.delete', function (e) {
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
