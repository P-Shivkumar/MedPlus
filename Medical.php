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
	input[type=submit], [type=reset] {
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
	if($_POST['submit_1']) {
		include "dbconnect.php";
	
		$med_name = $_POST["med_name"];
		$med_quant = $_POST["med_quant"];
		$med_price = $_POST["med_price"];
		$ex_date = $_POST["ex_date"];
		$manu_name = $_POST["manu_name"];
		$msg = 0;
		
		$sql1 = "INSERT INTO Medicine VALUES ('$med_name', '$med_price', '$med_quant', '$ex_date', '$manu_name')";
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}
		mysqli_close($conn);
		if(!$msg) {
			$result = '<div class="alert alert-success alert-dismissable">
	   			<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
	    			<strong>Success!</strong> Record Successfully stored into database.
	  			</div>';
		}
		else {
			$result = '<div class="alert alert-danger alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
	    		<strong>Failure!</strong> Record is NOT saved into database. Medicine already exists.
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
                <li class="active"><a href="#banner">Medical</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <img src="img/logo.png" class="img-responsive">
            </div>
            <div class="banner-text text-center">
              <h1 class="white">Healthcare at your desk!!</h1>
              <p>Useful site for keeping record of patient, consulted doctors and medical history</p>
              
            </div>
	    <?php echo $result; ?>
            <div class="overlay-detail text-center">
              <a href="#service"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--/ Medicine details-->
  <section id="patient" class="section-padding">
    <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#medicine"><h2 class="ser-title">Medicine Details</h2></button>
          <hr class="botm-line">
        </div>
	<div class="collapse col-md-8 col-sm-8" id=medicine>
	  <form role="form" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Name</h4></label>
    			<input type="text" name="med_name" class="form-control" id="exampleInputPassword1" placeholder="Medicine name" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Quantity</h4></label>
    			<input type="text" name="med_quant" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity of Medicine Availabe" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Price</h4></label>
    			<input type="text" name="med_price" class="form-control" id="exampleInputPassword1" placeholder="price" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Expiry Date</h4></label>
    			<input type="text" name="ex_date" class="form-control" id="exampleInputPassword1" placeholder="yyyy-mm-dd" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Manufacturer Name</h4></label>
    			<input type="text" name="manu_name" class="form-control" id="exampleInputPassword1" placeholder="Manufacturer Name" required>
  		</div>
				
  			<input type="submit" name = "submit_1"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br> 
	  </form>
	</div>
	</div>
     </div>

  </section>
  <!--/ Medicine details-->

  <!--footer-->
  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">About Us</h4>
            </div>
            <div class="info-sec">
              <p>Praesent convallis tortor et enim laoreet, vel consectetur purus latoque penatibus et dis parturient.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Quick Links</h4>
            </div>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="index.html"><i class="fa fa-circle"></i>Home</a></li>
                <li><a href="#service"><i class="fa fa-circle"></i>Service</a></li>
                <li><a href="#contact"><i class="fa fa-circle"></i>Appointment</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Follow us</h4>
            </div>
            <div class="info-sec">
              <ul class="social-icon">
                <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                <li class="bgred"><i class="fa fa-google-plus"></i></li>
                <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            © Copyright Medilab Theme. All Rights Reserved
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medilab
              -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade.com</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
