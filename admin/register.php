<?php
include("config.php");
	 $myusername = $email =  $mypassword= $mobile= ''; 
	
   $errors = array();
   $message = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']);
       $email = mysqli_real_escape_string($con,$_POST['email']);
	  	  
	   $mobile = mysqli_real_escape_string($con,$_POST['mobile']); 
	   $active = $row['active'];
	  $isAdmin =(bool) 1;
      $sql = "INSERT INTO user (username , email,password, mobile, active) VALUES ('$myusername ','$email ','$mypassword', '$mobile','1')";
      //$sql = "SELECT * FROM users WHERE username = '$myusername' email='$email' and password = '$mypassword' and active =1";
      $result = mysqli_query($con,$sql);
	 
	 
     if(count($errors)==0){
	//mysqli_autocommit($con,FALSE);
	//$today = date('Y-m-d H:i:s');
		// Attempt insert query execution
		$sql = "INSERT INTO user (username , email,password,name, mobile, active) VALUES ('$myusername ','$email ','$mypassword', '$name', '$mobile','1')";
		if(mysqli_query($con, $sql)){
			$message = " added successfully.";
			  
		} else{
			 $errors[]= "Could not able to save Albums " . mysqli_error($con);
		}
	  }
	  
	  if(count($errors)>0){
		//echo var_dump($errors);
		//exit();
	  }
   }
?>




<!-- <?php
   include("config.php");
   session_start();
   if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$isAdmin = $user['is_admin'];
		if($isAdmin){
			 header("location: admin.php");
		}
   }
   $error = '';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
	  $email = mysqli_real_escape_string($con,$_POST['email']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
	   $mobile = mysqli_real_escape_string($con,$_POST['mobile']); 
      $sql = "INSERT INTO user (username , email,password, mobile, active) VALUES ('$myusername ','$email ','$mypassword', '$mobile','1')";
      //$sql = "SELECT * FROM users WHERE username = '$myusername' email='$email' and password = '$mypassword' and active =1";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	 
      $active = $row['active'];
	  $isAdmin =(bool) 1;
      
     // $count = mysqli_num_rows($result);
	
	 $count = 1;
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
		 $_SESSION['user']['id'] = $row['id'];
         $_SESSION['user']['name'] = $myusername;
		 $_SESSION['user']['email'] = $email;
		 $_SESSION['user']['password'] = $password;
		 $_SESSION['user']['mobile'] = $mobile;
		 $_SESSION['user']['is_admin'] = $isAdmin;
         if($isAdmin)
         header("location: admin.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?> -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Wedelicious | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>New Register</b></a>
  </div>

 <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>
 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
 <form action="register.php" method="POST">
      <div class="form-group has-feedback">
        <input type="username" name="username" class="form-control" placeholder="enter Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="mobile" name="mobile" class="form-control" placeholder="enter mobile">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="enter ur email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder=" enter ur Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="password" name="confrim-password" class="form-control" placeholder=" Reenter Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
      <div class="row">
        <div class="col-xs-8">
         <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        
		</div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="" />Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
</div>
</div>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

