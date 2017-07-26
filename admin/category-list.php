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
    <div class="col-md-5">
	<div class="box box-primary" id="category-form">
            <!-- form start -->
			
            <form role="form" action="addCategory.php" method="POST" enctype="multipart/form-data" id="add-category-form">
              <div class="box-body">
				
				<div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" value="" required >
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
          <!-- /.box -->
		  
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
                  <th>Category</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
				<tbody id="categories">
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
				</tbody>		
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
        $("#category-form").on('submit', '#add-category-form', function (e) {
			
          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'addCategory.php',
            data: $('form').serialize(),
            success: function () {
           <!--   alert('form was submitted'); -->
			 $( "#categories" ).load('category.php');
			 $( "#category-form" ).load('add-category.php');
            }
          });

        });
	 

$("#category-form").on('submit', '#edit-category-form', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'updateCategory.php',
            data: $('form').serialize(),
            success: function () {
            <!--  alert('form was submitted'); -->
			 $( "#categories" ).load('category.php');
			 $( "#category-form" ).load('add-category.php');
            }
          });

        });

$("#categories").on('click', '.edit', function (e) {
	e.preventDefault(); //STOP default action
	  var url = $(this).attr('href');
	  
	   $( "#category-form" ).load(url);
		       
});


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
