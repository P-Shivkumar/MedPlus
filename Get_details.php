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
		include('dbconnect.php');
		$ID = $_POST['ID'];
		$sql = "SELECT * FROM Patient where P_ID='".$ID."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		
				$P_ID     = $row['P_ID'];
				$P_name = $row['P_name'];
				$Age = $row['Age'];
				$addr = $row['Address'];
				$insco = $row['Insco_name'];
				}
		} else {
		    $msg = '<div class="alert alert-danger alert-dismissable">
		    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
		    				<strong>Failure!</strong> NO result found.
		  				</div>';
		}

		$sql = "SELECT * FROM Patient_Phone where P_ID='".$ID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$phone = $row['Phone'];

		$sql = "SELECT * FROM Consults where P_ID='".$ID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$D_ID = $row['D_ID'];

		$sql = "SELECT * FROM Doctor where D_ID='".$D_ID."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$D_name = $row['D_name'];

		$sql = "SELECT * FROM diagnosis where diagnosis_ID in (select diagnosis_ID from visit where visit_ID in (select visit_ID from attends where P_ID='".$ID."'))";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$disease = $row['category'];

		$sql = "SELECT * FROM prescription where prescription_ID in (select prescription_ID from yeilds where diagnosis_ID in (select diagnosis_ID from visit where visit_ID in (select visit_ID from attends where P_ID='".$ID."')))";
		$pre = $conn->query($sql);
		$row = $pre->fetch_assoc();
		$mname = $row['M_name'];

		$sql = "SELECT * FROM Bill where Bill_num in (select Bill_num from visit where visit_ID in (select visit_ID from attends where P_ID='".$ID."'))";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$bill = $row['amount'];

		$sql = "SELECT COUNT(visit_ID) AS KK FROM attends WHERE P_ID='".$ID."' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$number = $row['KK'];
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
              <img src="img/logo.png" class="img-responsive">
            </div>
	<?php echo $msg; ?>
	<form role="form" method="post">
            <div class="banner-text text-center">
              <h1 class="white">Healthcare at your desk!!</h1>
              <p>Useful site for keeping record of patient, consulted doctors and medical history </p>
	      <h3 class="white">Enter Patient ID </h3>
	      <div class="col-sm-4"></div>
	      <div class="col-sm-4">
	      <input type="text" name="ID" class="form-control" id="usr"placeholder="Enter patient ID eg.P001">
	      </div>
	      </br> </br> </br>
	      <input type="submit" name = "submit_1"value="Get Details"> </br> </br>
            </div>
	</form>
            <div class="overlay-detail text-center">
              <a href="#goto"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->

 <!--/ print info-->
  <section id="goto" class="section-padding">
    <div class="container">
      <div class="row">
	<div class="col-md-12">
          <h2 class="ser-title">Patient Information </h2>
          <hr class="botm-line">
        </div>
	<div class="col-md-8 col-sm-8">
		
	<form role="form" action="patient_details.php" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Patient Name</h4></label>
    			<input type="text" readonly name="P_name" class="form-control" id="exampleInputPassword1" value= "<?php echo $P_name; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Age</h4></label>
    			<input type="text" readonly name="age" class="form-control" id="exampleInputPassword1" value= "<?php echo $Age; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Address</h4></label>
    			<input type="text" readonly name="addr" class="form-control" id="exampleInputPassword1" value= "<?php echo $addr; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Insurance Company</h4></label>
    			<input type="text"  readonly name="insu_comp" class="form-control" id="exampleInputPassword1" value= "<?php echo $insco; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Phone</h4></label>
    			<input type="text" readonly name="phone1" class="form-control" id="exampleInputPassword1" value= "<?php echo $phone; ?> "size=10>
  		</div>
		
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Alternate Phone</h4></label>
    			<input type="text" readonly name="phone2" class="form-control" id="exampleInputPassword1" value= "<?php echo $phone; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Consults</h4></label>
    			<input type="text" readonly name="conslts" class="form-control" id="exampleInputPassword1" value= "<?php echo $D_name; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Disease</h4></label>
    			<input type="text" readonly name="disease" class="form-control" id="exampleInputPassword1" value= "<?php echo $disease; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine</h4></label>
    			<input type="text" readonly name="mname" class="form-control" id="exampleInputPassword1" value= "<?php echo $mname; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Bill</h4></label>
    			<input type="text" readonly name="bill" class="form-control" id="exampleInputPassword1" value= "<?php echo $bill; ?> "size=10>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Number of visits</h4></label>
    			<input type="text" readonly name="no_visit" class="form-control" id="exampleInputPassword1" value= "<?php echo $number; ?> "size=10>
  		</div>
	  </form>
	</div>
	</div>
     </div>
  </section>
  <!--/ Patient details-->
   
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
