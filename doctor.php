<!DOCTYPE html>
<html lang="en">
<?php
	$con=mysqli_connect("localhost","root","root","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	session_start();
	$doctor = $_SESSION["name"];
	$date = date("Y-m-d", strtotime("today"));
	$result = mysqli_query($con, "select * from Consults where D_ID = (select D_ID from Doctor where D_name = '$doctor') AND ConsultDate = '$date'");
	
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
              <a class="navbar-brand" href="#"><font color="white">Hello <?php echo $doctor; ?> !!</font></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a onclick="loadDoctor()">Profile</a></li>
		<li class=""><a href="doctor.php">Appointment</a></li>
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
          <h2 class="ser-title">Your today's appointments: </h2>
          <hr class="botm-line">
        </div>           
  <table id="" class="table table-striped table-bordered" style="width:100%">
		<tr>
			<th>Name</th>
			<th>Age</th>
			<th>Time</th>
			<th>Actions</th>
		</tr>
	<?php	
		while($row = mysqli_fetch_array($result))
		{
			$pid = $row['P_ID'];
			$time = $row['AptTime'];
			$islogin = $row['islogin'];
			if($islogin == 1){
				$temp = mysqli_query($con, "select * from PatientLoginPID where P_ID = '$pid'");
				$row2 = mysqli_fetch_array($temp);
				$lid = $row2['L_ID'];
				
				$query = mysqli_query($con, "select * from PatientLogin where L_ID = '$lid'");
			}
			else if($islogin == 0)
				$query = mysqli_query($con, "select * from PatientNotLogin where P_ID = '$pid'");
			$patient = mysqli_fetch_array($query);
	?>
			<tr id="<?php echo $pid; ?>">
				<td id="name<?php echo $pid; ?>"><?php echo $patient['P_name'];?></td>
				<td id="age<?php echo $pid; ?>"><?php echo $patient['Age'];?></td>
				<td id="time<?php echo $pid; ?>"><?php echo $time;?></td>
				<td ><a data-toggle="modal" data-target="#popup" onclick="writePrescription(<?php echo $pid; ?>)">write Prescription</a> <button type="button" class="close" onclick="removeappointment(<?php echo $pid; ?>)"><font color="red">&times;</font></button></td>
			<tr>		
	<?php }	?>
	</table>
         </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ History-->
    <!-- popup-->
<div class="modal fade" id="popup" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="text-primary">Your Prescription</h3>
        </div>
	<table id="targettable" class="table table-striped table-bordered" style="width:100%">
		<tr>
			<th>Disease</th>
			<th>Medicine</th>
			<th>Daily Dose</th>
			<th>Quantity</th>
		</tr>
		<tr id="2" >
			<td contenteditable="true"></td>
			<td contenteditable="true"></td>
			<td contenteditable="true"></td>
			<td contenteditable="true"></td>
		</tr>		
	</table>
	<center><button onclick = "createNextRow()" class="btn btn-info">Next</button> <input type="reset" name="Reset" value="Reset" class="btn btn-default"></center> 
      </div>      
    </div>
  </div>
<!--/ popup-->
  <?php
		mysqli_close($con);
	?>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
  <script src="js/modify.js"></script>
  <script src="js/jquery.js"></script>

</body>

</html>
