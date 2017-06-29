 <?php include('header.php') ?>
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



  <!-- =============================================== -->

  <?php include('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Category List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category List</li>
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
              <table class="table table-hover" id="categories">
                <tr>
                  <th>Sl.No</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
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
				  <a href="editCategory.php?id=<?php echo $category['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
				   <a href="delete-category.php?id=<?php echo $category['id']; ?>" title="<?php echo $category['type']; ?>" class="delete"><i class="fa fa-trash-o"></i></a>
				  </td>
                </tr>
               <?php
						}
						?>
              </table>
            </div>
																								
						<?php
							
					  }else {
						 echo "<span>No categories found </span>";
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
$("#categories").on('click', '.delete', function (e) {
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
