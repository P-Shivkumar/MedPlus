<!DOCTYPE html>
<html lang="en">
<?php
	$con=mysqli_connect("localhost","root","root","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	session_start();
	$name = $_SESSION["name"];
	$result = mysqli_query($con, "select * from PatientLogin where P_name = '$name'");
	$row = mysqli_fetch_array($result);
	$lid = $row['L_ID'];
	
	$result = mysqli_query($con, "select MAX(P_ID) as P_ID from PatientLoginPID where L_ID = '$lid'");
	$row = mysqli_fetch_array($result);
	$pid = $row['P_ID'];
	$maxpid = $pid;
	
	$result = mysqli_query($con, "select * from consulted where P_ID = '$pid'");
	$row = mysqli_fetch_array($result);
	$doctorid = $row['D_ID'];
	
	
	$result = mysqli_query($con, "select * from Doctor where D_ID = '$doctorid'");
	$row = mysqli_fetch_array($result);
	$Doctorname = $row['D_name'];
	$Doctorspeciality = $row['Speciality'];
	
	$result = mysqli_query($con, "select distinct Speciality from Doctor");
?>
<head>
  <title>MediPlus</title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar">
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
              <a class="navbar-brand" href="#"><font color="white">Hello <?php echo $_SESSION["name"]; ?> !!</font></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class=""><a onclick="onloadpatient()">Profile</a></li>
		<li class=""><a href="temp.php">Appointment</a></li>
                <li class=""><a href="index.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <!--/ banner-->
  <!--History-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Your History</h2>
          <hr class="botm-line">
        </div>           
  <table id="example" class="table table-striped table-bordered" style="width:100%">
		<tr>
			<th>ID</th>
			<th>Date</th>
			<th>Disease</th>
			<th>Visits</th>
			<th>Prescription</th>
		</tr>
	<?php
		$result2 = mysqli_query($con, "select * from PatientLoginPID where L_ID = '$lid'");
		
		while($row2 = mysqli_fetch_assoc($result2))
		{
			$pid = $row2['P_ID'];
			
			$query = mysqli_query($con,"SELECT count(*) FROM Prescription where P_ID='$pid'");
			$array = mysqli_fetch_assoc($query);
			$visitcount = $array['count(*)'];
			$query = mysqli_query($con,"SELECT MAX(PrescriptionDate) as date FROM Prescription where P_ID='$pid'");
			$array = mysqli_fetch_assoc($query);
			$date = $array['date'];
			$result1 = mysqli_query($con,"SELECT * FROM Prescription where P_ID='$pid'");
			if($row1 = mysqli_fetch_assoc($result1)){
	?>
			<tr id ="<?php echo $row1['P_ID'];?>" >
				<td ><?php echo $row1['P_ID'];?></td>
				<td ><?php echo $date?></td>
				<td ><?php echo $row1['Disease'];?></td>
				<td ><?php echo $visitcount;?></td>
				<td ><a data-toggle="modal" data-target="#popup" onclick="showprescription(<?php echo $row1['P_ID'];?>)">show</a>
  				</td>
			<tr>		
	<?php } }?>
	</table>
	<center><a href="exportPDF.php"><input type="button" class="btn btn-primary" value="GetPDF"></a></center>
         </div>
        </div>
      </div>
    </div>
  </section>
<!--History-->
<!--appointment-->
   <section id="newpatient" class="section-padding">
    <div class="container" class="col-md-8 col-sm-8 marb20">
      <div class="row" class="col-md-8 col-sm-8 marb20">
      <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <div class="col-md-12">
		  <h2 class="ser-title">Appointment!</h2>
		  <hr class="botm-line">
           	  <ul class="nav nav-tabs">
	  		<li class="active"><a data-toggle="tab" href="#home">Book</a></li>
	  		<li><a data-toggle="tab" href="#menu0">continue</a></li>
			<li><a data-toggle="tab" href="#menu1">Cancel</a></li>
		  </ul>

		  <div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
			  <div class="space"></div>
			  <div class="form-group">
				  <label for="inputLocation" class="col-sm-4 control-label">Speciality :</label>
			  	  <select class="form-control" id="SpecialityDropdown" name="SpecialityDropdown" onchange="loaddoctor()">
				  <option>Nothing selected</option>
				  <?php while($row = mysqli_fetch_array($result)){?>
				  <option name="speciality"><?php echo $row['Speciality'];?></option>
				  <?php } ?>
				  </select>
		         </div>
			 <div class="form-group">
				 <label for="inputLocation" class="col-sm-4 control-label">Doctor :</label>
			  	 <select class="form-control" id="DoctorDropdown" name="DoctorDropdown">
				 <option>Nothing selected</option>
			 	</select>
		         </div>
		  	 <center>
		  		 <button id="getapt" onclick="givedate()" class="btn btn-info">GetAppoinment</button>
		  	 </center>
		 </div>
		 <div id="menu0" class="tab-pane fade">
		 	<div class="space"></div>
		 	 <div class="form-group">
				  <label for="inputLocation" class="col-sm-4 control-label">Speciality :</label>
			  	  <select class="form-control" id="SpecialityDropdown" name="SpecialityDropdown" onchange="">
				  <option><?php echo $Doctorspeciality;?></option>
				  </select>
		         </div>
			 <div class="form-group">
				 <label for="inputLocation" class="col-sm-4 control-label">Doctor :</label>
			  	 <select class="form-control" id="DoctorDropdown" name="DoctorDropdown">
				 <option><?php echo $Doctorname;?></option>
			 	</select>
		         </div>
		  	 <center>
		  		 <input type="button" class="btn btn-primary" value="ContinueAppoinment" onclick="continueapt(<?php echo $doctorid;?>, <?php echo $maxpid;?>)">
		  	 </center>   
		 </div>
		 
		  <div id="menu1" class="tab-pane fade">
		  <div class="space"></div>
		    <table id="example" class="table table-striped table-bordered" style="width:100%">
					<tr>
						<th>Doctor</th>
						<th>Time</th>
						<th>Date</th>
						<th></th>
					</tr>
				<?php
					$con=mysqli_connect("localhost","root","root","Healthcare");
					if (mysqli_connect_errno()){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT L_ID FROM PatientLogin where P_name='$name'");
					$row = mysqli_fetch_array($result);
					$lid =  $row['L_ID'];
					
					$today = date('Y-m-d');
					$currtime = date('G:i:s');
					$result2 = mysqli_query($con,"SELECT P_ID FROM PatientLoginPID where L_ID='$lid'");
					while($row2 = mysqli_fetch_array($result2)){
					$pid =  $row2['P_ID'];
					
					$result = mysqli_query($con,"SELECT * FROM Consults where P_ID='$pid' AND ConsultDate > '$today'");

					while($row = mysqli_fetch_array($result))
		
					{
						$did = $row['D_ID'];
						$result1 = mysqli_query($con,"SELECT D_name FROM Doctor where D_ID='$did'");
						$row1 = mysqli_fetch_array($result1);
						$name =  $row1['D_name'];
				?>
						<tr id="<?php echo $did;?>">
							<td ><?php echo $name;?></td>
							<td ><?php echo $row['AptTime'];?></td>
							<td ><?php echo $row['ConsultDate'];?></td>
							<td ><input type="button" class="btn btn-primary" value="Cancel" onclick="cancel(<?php echo $did;?>)"></td>
						<tr>
				<?php }} ?>		
			</table>
		  </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ appointment-->
	
  <!-- popup-->
<div class="modal fade" id="popup" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="text-primary">Your Prescription</h3>
        </div>
		 <table id="prescription" class="table table-striped table-bordered" style="width:100%">
		<tr>
			<th>Date</th>
			<th>Medicine</th>
			<th>Doseperday</th>
			<th>quantity</th>
		</tr>		
	</table>
      </div>      
    </div>
  </div>
<!--/ popup-->
<?php
		mysqli_close($con);
	?>
  <!--/ History-->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
  <script src="js/modify.js"></script>
  <script src="js/jquery.js"></script>

</body>

</html>
