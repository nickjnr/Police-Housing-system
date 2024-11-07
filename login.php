<?php

if(isset($_POST['submit'])){
	require 'class/database.php';
	$database = new database;
    $password=$_POST['password'];
$sql="select password from admin where username=?";
$email=$_POST['email'];	
$conn= $database->dbConnect();
	$stmt=$conn->prepare($sql);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$results=$stmt->get_result();
	$data=$results->fetch_assoc();
	
	if($data==null){
	   $value=0;
	   header('location:login.php?failed');
	}
	else
	{
	$hashedp=$data['password'];
	$checkpass=password_verify($password,$hashedp);
	 if($checkpass==false){
$value=1;
	 header('location:login.php?failed');
	 }
	 else{  
session_start();
		 
		
			  $_SESSION['user']=$email;
			  $_SESSION['user_type']='admin'; 
			  $value=2;
	
		echo "<script type = \"text/javascript\">
		window.location = (\"dash.php\");
		</script>";	
	 } 
	}
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 08</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="login/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
					<div style='text-align:center'>
            <?php
                    if(isset($_GET['failed'])){
echo"                
   <h5 class='' style='color:red'>Invalid Username/Password</h5>";
                    

}    


?>
</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Have an account?</h3>
						<form action="" method='POST'class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" name="email" placeholder="Username" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
	            </div>
				<div class="form-group d-md-flex">
	            	<div class="w-50">
	            		
								</div>
								<div class="w-50 text-md-right">
									<a href="signup.php">Sign Up</a>
								</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name='submit'class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="login/js/jquery.min.js"></script>
  <script src="login/js/popper.js"></script>
  <script src="login/js/bootstrap.min.js"></script>
  <script src="login/js/main.js"></script>

	</body>
</html>

