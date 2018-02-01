<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hospital Management System</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<style> 
	input[type=submit] {
	    background-color: #0cb8b6;
	    border: none;
	    color: white;
	    padding: 10px 32px;
	    text-decoration: none;
	    margin: 4px 2px;
	    cursor: pointer;
	}
</style>

  <?php
	if($_POST['button_1']) {
		session_start();
		$username = $_POST['userid'];
	    	$password = $_POST['password'];
		if($username == 'Shivkumar' && $password == 'hello123') {
			$msg = 'Login Complete! Thanks';
		}
		else{
			$message = "login failed";
	 		
		}
		if(isset($msg)){ // Check if $msg is not empty
			header("Location: Doctor.php");
			exit; 
		}
		else if (isset($message)) {
			$error = '<div class="alert alert-danger alert-dismissable">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    				<strong>Login failed!</strong> Username or Password is incorrect.
  				</div>';
		}
	}
  ?>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner" class="banner">
    <div class="bg-color">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
              <a class="navbar-brand" href="#"><img src="img/logo.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class=""><a href="index.php">Home</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <img src="" class="img-responsive">
            </div>
	<?php echo $error; ?>
	    <div class="banner-text text-center">
	      <h2 class="white"> <u> DOCTOR LOGIN PAGE</u></h2>
		</br> </br> 
	      </div>
	  <form role="form" method="post">
            <div class="banner-text text-center form-group">
	      <h3 class="white">USER ID </h3>
	      <div class="col-sm-4"></div>
	      <div class="col-sm-4">
	      <input type="text" name="userid" class="form-control" id="usr"placeholder="Enter user ID">
	      </div>
		</br> </br> </br>
            <div class="banner-text text-center form-group">
	      <h3 class="white">PASSWORD </h3>
	      <div class="col-sm-4"></div>
	      <div class="col-sm-4">
	      <input type="password" name="password" class="form-control" id="pass"placeholder="Enter password">
	      </div>
	      </br> </br> </br>
	     <input type="submit" name="button_1" value="Sign In"> </a></br> </br>
            </div>
          </form>
	 </div>
        </div>
      </div>
    </div>
  </section>

  
  <!--/ banner-->
   
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
