 <?php include('header.php') ?>
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



  <!-- =============================================== -->

  <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Season List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Season List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
	    <div class="col-md-5">
           <div class="box box-primary"id="season-form">
			
            <!-- form start -->
			
            <form role="form" action="addSeason.php" method="POST" enctype="multipart/form-data" id="add-season-form">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="season">Season</label>
                  <input type="text" class="form-control" id="season" name="season" placeholder="Enter season" value="" required >
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
                  <th>Season</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
				<tbody id="seasons">
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
				</tbody>		
              </table>
            </div>
																								
						<?php
							
					  }else {
						 echo "<span>No seasons found </span>";
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
$("#season-form").on('submit', '#add-season-form', function (e) {
          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'addSeason.php',
            data: $('form').serialize(),
            success: function () {
            <!--  alert('form was submitted'); -->
			 $( "#seasons" ).load('season.php');
			 $( "#season-form" ).load('add-season.php');
            }
          });

        });
	  

$("#season-form").on('submit', '#edit-season-form', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'updateSeason.php',
            data: $('form').serialize(),
            success: function () {
          <!--    alert('form was submitted'); -->
			 $( "#seasons" ).load('season.php');
			 $( "#season-form" ).load('add-season.php');
            }
          });

        });

$("#seasons").on('click', '.edit', function (e) {
	e.preventDefault(); //STOP default action
	  var url = $(this).attr('href');
	  
	   $( "#season-form" ).load(url);
		       
});



$("#seasons").on('click', '.delete', function (e) {
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
