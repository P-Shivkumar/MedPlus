<!DOCTYPE html>
<html lang="en">
<?php
	$con=mysqli_connect("localhost","root","root","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con, "select distinct Speciality from Doctor");
	session_start();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MediPlus</title>
  <meta name="description" content="MediPlus is hospital which diagnose all the disease. We have more than 10 doctors. We provide best services. Useful site for keeping record of patient, consulted doctors and medical history. ">
  <meta name="keywords" content="MediPlus, Healthcare, patient, doctor, medical history, best diagnosis">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
	.redborder { border: 1px solid red; }
  </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section >
      <div class="container" style="margin-bottom:50px;">
      <nav class="navbar navbar-default navbar-fixed-top" style="background-color: RGBA(13, 70, 83, 0.78);">
        <div class="container" >
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
              <a class="navbar-brand" href="#"><font color="white"> Hello there!!</font></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class=""><a href="index.php">close</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <!--/ banner-->
<!--newpatient-->
  <section id="newpatient" class="section-padding">
    <div class="container" class="col-md-8 col-sm-8 marb20">
      <div class="row" class="col-md-8 col-sm-8 marb20">
      <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <div class="col-md-12">
		  <h2 class="ser-title">Book an Appointment!</h2>
		  <hr class="botm-line">
           </div>
	    <h5>Please <a data-toggle="modal" data-target="#login">Login</a> or <a data-toggle="modal" data-target="#signup">Signup</a> for better services.</h5>
            <div class="space"></div>
            <form role="form" class="form-horizontal">		
			<div class="form-group">
			<label class="control-label col-md-3">Your Name *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="newname" value="" placeholder="Please Enter Your Name" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Your Age *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="newage" value="" placeholder="Please Enter Your age" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Your Address *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="newaddress" value="" placeholder="Please Enter Your address" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Email address *:</label>
			<div class="col-md-9">
			<input type="email" class="form-control" id="newemail" value="" placeholder="Please Enter Your Email" required>
			</div>
			</div>	
			<div class="form-group">
			<label class="control-label col-md-3">Speciality *:</label>
			<div class="col-md-9">
			<select class="form-control" id="SpecialityDropdown" name="SpecialityDropdown" onchange="loaddoctor()">
			<option>Nothing selected</option>
			<?php while($row = mysqli_fetch_array($result)){?>
			<option name="speciality"><?php echo $row['Speciality'];?></option>
			<?php } ?>
			</select>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Doctor *:</label>
			<div class="col-md-9">
			<select class="form-control" id="DoctorDropdown" name="DoctorDropdown">
			<option>Nothing selected</option>
			</select>
			</div>
			</div>
			<center>
			<button class="btn btn-info" onclick="NewPatientNotLogin()">submit</button> <input type="reset" name="Reset" value="Reset" class="btn btn-default">
			</center>
			<div class="form-group">
			<div class="col-md-3"></div>
			<div class="col-md-9">
			</div>	
			</div>	
			</form>	
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ newpatient-->

    <!-- Login-->
<div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="text-primary">Login Form</h3>
        </div>
		<div class="modal-body">
		<div class="row">	
		    <form  method="post" role="form" class="form-horizontal">		
			<div class="form-group">
			<label class="control-label col-md-3">Email address *:</label>
			<div class="col-md-9">
			<input type="email" class="form-control" id="emailid" value="" placeholder="Please Enter Your Email" required>
			</div>
			</div>	
			<div class="form-group">
			<label class="control-label col-md-3">Password *:</label>
			<div class="col-md-9">
			<input type="password" class="form-control" id="loginpassword" value="" placeholder="Please Enter Your password" required>
			</div>
			</div>	
			<div class="form-group">
			<div class="col-md-3"></div>
			<div class="col-md-9">
			<button name="Login Now" onclick="CheckLogin()" class="btn btn-info">Login</button> <input type="reset" name="Reset" value="Reset" class="btn btn-default"> 
			</div>	
			</div>	
			</form>					
                </div>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>
<!--/ Login-->
<!--Signup-->
<div class="modal fade" id="signup" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="text-primary">Signup Form</h3>
        </div>
		<div class="modal-body">
		<div class="row">	
		    <form  method="post" role="form" class="form-horizontal">		
			<div class="form-group">
			<label class="control-label col-md-3">Your Name *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="signupname" value="" placeholder="Please Enter Your Name" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Your Age *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="age" value="" placeholder="Please Enter Your age" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Your Address *:</label>
			<div class="col-md-9">
			<input type="text" class="form-control" id="address" value="" placeholder="Please Enter Your address" required>
			</div>
			</div>
			<div class="form-group">
			<label class="control-label col-md-3">Email address *:</label>
			<div class="col-md-9">
			<input type="email" class="form-control" id="signupemail" value="" placeholder="Please Enter Your Email" required>
			</div>
			</div>	
			<div class="form-group">
			<label class="control-label col-md-3">Password *:</label>
			<div class="col-md-9">
			<input type="password" class="form-control" id="password" value="" placeholder="Please Enter Your password" required>
			</div>
			</div>	
			<div class="form-group">
			<label class="control-label col-md-3">Retype Password *:</label>
			<div class="col-md-9">
			<input type="password" class="form-control" id="repassword" value="" onkeyup="checkPassword()" placeholder="Please Enter Retype Your password" required>
			</div>
			</div>
			<div class="form-group">
			<div class="col-md-9">
			<center><span id='message'></span></center>
			</div>
			</div>	
			<div class="form-group">
			<div class="col-md-3"></div>
			<div class="col-md-9">
			<button name="Signup Now" value="Signup Now" onclick="NewUser()" class="btn btn-info">Signup Now</button> <input type="reset" name="Reset" value="Reset" class="btn btn-default"> 
			</div>	
			</div>	
			</form>					
                </div>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
  </div>
<!--/ Signup-->
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
              <p>MediPlus is a hospital which provides you best services, for all the diseases. </p>
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
  </footer>
  <!--/ footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
  <script src="js/modify.js"></script>
  <script src="js/jquery.js"></script>

</body>

</html>
