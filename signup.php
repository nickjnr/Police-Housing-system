<?php
if(isset($_POST['submit'])){

require 'class/users.php';

$user=new users;
$user->Admin();

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
					<h2 class="heading-section">Sign Up</h2>

                    <div style='text-align:center'>
            <?php
                    if(isset($_GET['error'])){
echo"                
   <h5 class='' style='color:red'>Username Already Exist</h5>";
                    

}          if(isset($_GET['success'])){
echo"
    <h5 class='' style='color:green'>A message has been Sent to Your Account Containig the Login Details</h5>";
  
  

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
		      	<h3 class="text-center mb-4">Create an account</h3>
						<form action="" method="POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" name="email" placeholder="Username" required>
		      		</div>

                      <div class="form-group">
		      			<input type="number" name='phone' class="form-control rounded-left" placeholder="Mobile NUmber" required>
		      		</div>
	           
                      <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		
								</div>
								<div class="w-50 text-md-right">
									<a href="login.php">Login</a>
								</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="submit" class="btn btn-primary rounded submit p-3 px-5">Get Started</button>
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

