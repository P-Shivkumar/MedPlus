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
		$p_id = $_POST["p_id"];
		$cat = $_POST["categry1"];
		$med_name = $_POST["medicine1"];
		$dose = $_POST["dose1"];
		$quant = $_POST["med_quant1"];

		$cat2 = $_POST["categry2"];
		$med_name2 = $_POST["medicine2"];
		$dose2 = $_POST["dose2"];
		$quant2 = $_POST["med_quant2"];

		$cat3 = $_POST["categry3"];
		$med_name3 = $_POST["medicine3"];
		$dose3 = $_POST["dose3"];
		$quant3 = $_POST["med_quant3"];

		$r1 = $_POST["record1"];
		$r2 = $_POST["record2"];
		$r3 = $_POST["record3"];
		$msg = 0;

		$sql1 = "INSERT INTO prescription(M_name, quantity, daily_dose) VALUES('$med_name', '$quant', '$dose')";
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}
		
		
		if(!empty($med_name2)){
			$sql1 = "INSERT INTO prescription(M_name, quantity, daily_dose) VALUES('$med_name2', '$quant2', '$dose2')";
			mysqli_query($conn, $sql1);			
		}
		
		if(!empty($med_name3)){
			$sql1 = "INSERT INTO prescription(M_name, quantity, daily_dose) VALUES('$med_name3', '$quant3', '$dose3')";
			mysqli_query($conn, $sql1);			
		}

		$sql2 = "INSERT INTO Temp(P_ID) values('$p_id')";
		if(!mysqli_query($conn, $sql2)) {
			$msg = 1;
		}
	
		$sql = "select Max(num) as num from Temp ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$dg_id = $row['num'];
	
		$sql3 = "INSERT INTO diagnosis VALUES('$cat', '$dg_id')";
		if(!mysqli_query($conn, $sql3)) {
			$msg = 1;
		}

		if(!empty($cat2)){
			$sql1 = "INSERT INTO diagnosis VALUES('$cat2', '$dg_id')";;
			mysqli_query($conn, $sql1);			
		}


		if(!empty($cat3)){
			$sql1 = "INSERT INTO diagnosis VALUES('$cat3 ', '$dg_id')";
			mysqli_query($conn, $sql1);			
		}

		$sql = "select Max(prescription_ID) as num from prescription";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$ps_id = $row['num'];

		$sql4 = "INSERT INTO yeilds VALUES('$ps_id', '$dg_id')";
		if(!mysqli_query($conn, $sql4)) {
			$msg = 1;
		}
		
		if(!empty($_POST["record1"])){
			$sql5 = "Insert into Records Values ('$p_id', '$r1')";
			if(!mysqli_query($conn, $sql5)) {
				$msg = 1;
			}
		}
		if(!empty($_POST["record2"])){
			$sql6 = "Insert into Records Values ('$p_id', '$r2')";
			if(!mysqli_query($conn, $sql6)) {
				$msg = 1;
			}
		}
		if(!empty($_POST["record3"])){
			$sql7 = "Insert into Records Values ('$p_id', '$r3')";
			if(!mysqli_query($conn, $sql7)) {
				$msg = 1;
			}
		}
		if(!$msg) {
			$result = '<div class="alert alert-success alert-dismissable">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    				<strong>Success!</strong> Record Successfully stored into database.
  				</div>';
		}
		else {
			$result = '<div class="alert alert-danger alert-dismissable">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.
  				</div>';
		}
		mysqli_close($conn);
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
                <li class="active"><a href="#banner">Doctor</a></li>
                
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
  <!--/ Diagnosis & prescription details-->
  <section id="patient" class="section-padding">
    <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#diagnosis"><h2 class="ser-title">Diagnosis & prescription Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="diagnosis" class="collapse col-md-8 col-sm-8">
	  <form role="form" method="post"> 
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Patient ID</h4></label>
    			<input type="text" name="p_id" class="form-control" id="exampleInputPassword1" placeholder="Enter patient id" required>
  		</div>
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Category 1</h4></label></br>
			<select name="categry1" required>
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT category FROM diagnosis");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['category'] . "</option>";
					}
				?>
			</select>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Category 2</h4></label></br>
			<select name="categry2" >
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT category FROM diagnosis");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['category'] . "</option>";
					}
				?>
			</select>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Category 3</h4></label></br>
			<select name="categry3" >
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT category FROM diagnosis");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['category'] . "</option>";
					}
				?>
			</select>
			</br></br>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Name 1</h4></label></br>
			<select name="medicine1" required>
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT M_name FROM Medicine");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['M_name'] . "</option>";
					}
				?>
			</select>
			</br></br>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Daily Dosage</h4></label>
    			<input type="text" name="dose1" class="form-control" id="exampleInputPassword1" placeholder="Enter number of times that medicine should be taken daily" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Quantity</h4></label>
    			<input type="text" name="med_quant1" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity of medicine to be bought" required>
  		</div>
		<div class="form-group">
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Name 2</h4></label></br>
			<select name="medicine2" >
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT M_name FROM Medicine");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['M_name'] . "</option>";
					}
				?>
			</select>
			</br></br>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Daily Dosage</h4></label>
    			<input type="text" name="dose2" class="form-control" id="exampleInputPassword1" placeholder="Enter number of times that medicine should be taken daily">
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Quantity</h4></label>
    			<input type="text" name="med_quant2" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity of medicine to be bought">
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Name 3</h4></label></br>
			<select name="medicine3" >
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT M_name FROM Medicine");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['M_name'] . "</option>";
					}
				?>
			</select>
			</br></br>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Daily Dosage</h4></label>
    			<input type="text" name="dose3" class="form-control" id="exampleInputPassword1" placeholder="Enter number of times that medicine should be taken daily">
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medicine Quantity</h4></label>
    			<input type="text" name="med_quant3" class="form-control" id="exampleInputPassword1" placeholder="Enter quantity of medicine to be bought">
  		</div>
    			<label for="exampleInputPassword1"><h4>Record 1</h4></label>
    			<input type="text" name="record1" class="form-control" id="exampleInputPassword1" placeholder="Enter first Record">
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Record 2</h4></label>
    			<input type="text" name="record2" class="form-control" id="exampleInputPassword1" placeholder="Enter second Record">
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Record 3</h4></label>
    			<input type="text" name="record3" class="form-control" id="exampleInputPassword1" placeholder="Enter third Record">
  		</div>
			<input type="submit" name = "submit_1"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br> 
	  </form>
	</div>
	</div>
     </div>
  </section>
  <!--/ Diagnosis & Prescription details-->
 
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
