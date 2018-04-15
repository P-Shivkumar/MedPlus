 <?php
	$con=mysqli_connect("localhost","root","k136616","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con, "select distinct Speciality from Doctor");
?>

<section id="newpatient" class="section-padding">
    <div class="container" class="col-md-8 col-sm-8 marb20">
      <div class="row" class="col-md-8 col-sm-8 marb20">
      <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <div class="col-md-12">
		  <h2 class="ser-title">Emergency Appointment!</h2>
		  <hr class="botm-line">
           </div>
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
			<select class="form-control" id="SpecialityDropdown" name="SpecialityDropdown" onchange="emergencyDoctor()">
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
			<option>Emergency Doctor</option>
			</select>
			</div>
			</div>
			<center>
			 <input type="button" class="btn btn-primary" value="submit" onclick="emergencyApt()">
			 <input type="reset" name="Reset" value="Reset" class="btn btn-default">
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
 
