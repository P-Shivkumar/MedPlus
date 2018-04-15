<!DOCTYPE html>
<html lang="en">

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
</head>

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
                <li class="active"><a href="#banner">Home</a></li>
                <li class=""><a href="#cnt">Contact</a></li>
		<li class=""><a data-toggle="modal" data-target="#signup">SignUp</a></li>
  		<li class=""><a data-toggle="modal" data-target="#login">Login</a></li>
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
              <h1 class="white">Hospital Managment System</h1>
              <p>Useful site for keeping record of patient, consulted doctors and medical history <br></p>
              <a data-toggle="modal" data-target="#login" class="btn btn-appoint">Take an Appointment</a>
            </div>
            <div class="overlay-detail text-center">
              <a href="#service"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
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
  <!--service-->
  <section id="service" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <h2 class="ser-title">Our Service</h2>
          <hr class="botm-line">
          <p>MediPlus provides world class services. We have all modern equipments, which are helpful for diagnosis. We have digitalised operation system. We care for our patients.</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <div class="icon-info">
              <h4>24 Hour Support</h4>
              <p>We provide 24 hour support. We have our doctors and nurses, who are present for your support.</p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-ambulance"></i>
            </div>
            <div class="icon-info">
              <h4>Emergency Services</h4>
              <p>We provide emergency services, we have our vans who gave best services. We have specialist for all body parts.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="icon-info">
              <h4>Medical Counseling</h4>
              <p>We provide free medical counseling for all our patients. We have our own psychatrist.</p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-medkit"></i>
            </div>
            <div class="icon-info">
              <h4>Premium Healthcare</h4>
              <p>We provide premium healthcare. We have special services for our signed in patients.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ service-->
  <!--cta-->
  <section id="cta-1" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="schedule-tab">
          <div class="col-md-8 col-sm-8 bor-left">
            <div class="mt-boxy-color"></div>
            <div class="medi-info">
              <h3>Emergency Case</h3>
              <p> <h4> 24 X 7 service </h4>
		</br>I am text block. Edit this text from Appearance / Customize / Homepage header columns. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
              <a class="btn medi-info-btn" onclick="emergency()">Take an Appointment</a>
            </div>
          </div>
          
          <div class="col-md-4 col-sm-4 mt-boxy-3">
            <div class="mt-boxy-color"></div>
            <div class="time-info">
              <h3>Opening Hours</h3>
              <table style="margin: 8px 0px 0px;" border="1">
                <tbody>
                  <tr>
                    <td>Monday - Saturday</td>
                    <td>9.00 - 17.00</td>
                  </tr>
   
                  <tr>
                    <td>Sunday</td>
                    <td>9.00 - 16.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--cta-->
  <!--emergency-->
  <section id="emergency" class="section-padding">  
  </section> 
  <!--emergency-->
  <!--doctor team-->
  <section id="doctor-team" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Meet Our Doctors!</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="img/doctor1.jpg" alt="..." class="team-img">
            <div class="caption">
              <h3>Jessica Wally</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="img/doctor2.jpg" alt="..." class="team-img">
            <div class="caption">
              <h3>Iai Donas</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="img/doctor3.jpg" alt="..." class="team-img">
            <div class="caption">
              <h3>Amanda Denyl</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="img/doctor4.jpg" alt="..." class="team-img">
            <div class="caption">
              <h3>Jason Davis</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ doctor team-->
  <!--petient opinion-->
  <section id="testimonial" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">see what patients are saying?</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>Amazing staff and services. The follow up call later in the day was an impressive level health “care!” </p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Ganesh<span>Landge</span></h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>I had a wisdom tooth removed and it was a good experience for something that was a bit scary for me. Both Dr. Bays and Alyssa were very caring, professional...	</p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Shiv<span>Patil</span></h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>I have four daughters and daughter Bays has performed wisdom teeth removal on all of them and jaw surgery on my oldest. We are very pleased with his work and...</p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Pawan<span>Hage</span></h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ testimonial-->
 
  <!--contact-->
  <section id="contactus" name="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Contact us</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <h3>Contact Info</h3>
          <div class="space"></div>
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>123, Shivajinagar <br> Pune, 411005</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@mediplus.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+91 9882212312</p>
        </div>
        <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <h3 class="cnt-ttl">Having Any Query! Or Book an appointment</h3>
            <div class="space"></div>
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control br-radius-zero" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control br-radius-zero" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control br-radius-zero" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>

              <div class="form-action">
                <button type="submit" class="btn btn-form">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ contact-->
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
