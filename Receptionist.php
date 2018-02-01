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
	input[type=submit], [type=reset]{
	    background-color: #0cb8b6;
	    border: none;
	    color: white;
	    padding: 10px 32px;
	    text-decoration: none;
	    margin: 4px 2px;
	    cursor: pointer;
	}
</style>

<!-- patient php-->

<?php 
	if($_POST['submit_1']) {
		include "dbconnect.php";
	
		$patient_name1 = $_POST["pname"];
		$consult1 = $_POST["conslt"];
		$a = $_POST["addr"];
		$phone1 = $_POST["phone1"];
		$phone2 = $_POST["phone2"];
		$age1 = $_POST["age"];
		$msg = 0;
		
		if(!empty($_POST["insco"])) {
			$insco = $_POST["insco"];
			$sql1 = "INSERT INTO Patient(P_name, Age, Address, Insco_name) VALUES ('$patient_name1', '$age1', '$a', '$insco')";
				if(!mysqli_query($conn, $sql1)) {
				$msg = 1;
			}
		}
		else {
			$sql1 = "INSERT INTO Patient(P_name, Age, Address, Insco_name) VALUES ('$patient_name1', '$age1', '$a', NULL)";
				if(!mysqli_query($conn, $sql1)) {
				$msg = 1;
			}
		}		
			
		$sql = "select Max(P_ID) as P_ID from Patient";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$P_ID = $row['P_ID'];
	
		$sql2 = "INSERT INTO Patient_Phone VALUES('$P_ID', '$phone1')";	
		if(!mysqli_query($conn, $sql2)) {
			$msg = 1;
		}
		if(!empty($phone2)){
			$sql3 = "INSERT INTO Patient_Phone VALUES('$P_ID', '$phone2')";
			if(!mysqli_query($conn, $sql3)) {
				$msg = 1;
			}
		}
	
		$sql = "SELECT * FROM Doctor where D_name='".$consult1."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$D_ID = $row['D_ID'];
	
		$sql4 = "INSERT INTO Consults VALUES ('$P_ID', '$D_ID')";
		if(!mysqli_query($conn, $sql4)) {
			$msg = 1;
		}
	
		mysqli_close($conn);
		if(!$msg) {
			$result =  '<script type="text/javascript"> alert("Record Saved Successfully. Your User ID is: '.$P_ID.'")</script>';
		}
		else {
			$result = '<div class="alert alert-danger alert-dismissable">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.
  				</div>';
		}
	}

?>

<!-- patient update php-->
<?php 
	if($_POST['submit_8']) {
		include "dbconnect.php";
		$P_ID = $_POST["pid7"];
		$conslt = $_POST["conslt2"];
		$msg = 0;
	
		$sql = "SELECT * FROM Doctor where D_name='".$conslt."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$D_ID = $row['D_ID'];

		$sql4 = "INSERT INTO Consults VALUES ('$P_ID', '$D_ID')";
		if(!mysqli_query($conn, $sql4)) {
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
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.
  				</div>';
		}
	}
?>

<!-- visit php-->
<?php 
	if($_POST['submit_4']) {
		include "dbconnect.php";
		$patient_id1 = $_POST["pid1"];
		$complaint = $_POST["complent"];
		$date = $_POST["date"];
		$msg = 0;
	
		$sql = "select num from Temp where P_ID = '$patient_id1'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$diagnosis_id = $row['num'];
	

		$sql = "select D_ID from Consults where P_ID = '$patient_id1'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$d_id = $row['D_ID'];
	
		$sql1 = "INSERT INTO visit(visit_date, copmlaint, diagnosis_ID, D_ID, Bill_num) VALUES ('$date', '$complaint', '$diagnosis_id', '$d_id', NULL)";
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}

		$sql = "select max(visit_ID) as V_ID FROM visit";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$vid = $row['V_ID'];
	
		$sql2 = "INSERT INTO attends VALUES('$patient_id1', '$vid')";
		if(!mysqli_query($conn, $sql2)) {
			$msg = 1;
		}

		mysqli_close($conn);
		if(!$msg) {
			$result = '<script type="text/javascript"> alert("Record Saved Successfully. Your Visit ID is: '.$vid.'")</script>';
		}
		else {
			$result = '<div class="alert alert-danger alert-dismissable">
    				<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database. Check date(yyyy-mm-dd).
  				</div>';
		}
	}
?>

<!-- bill php-->
<?php 
	if($_POST['submit_5']) {
		include "dbconnect.php";

		$vid = $_POST["vid1"];
		$b_no = $_POST["bill_no"];
		$dfees = $_POST["D_fees"];
		$mbill = $_POST["M_bill"];
		$b_date = $_POST["bill_date"];
		$d_date = $_POST["due_date"];

		$amount = $dfees + $mbill;
		$msg = 0;

		$sql1 = "INSERT INTO Bill(amount, Bill_date, Due_date) VALUES ('$amount', '$b_date', '$d_date')";
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}

		$sql = "select max(Bill_num) as b_no from Bill";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$b_no = $row['b_no'];

		$sql2 = "UPDATE visit SET visit.Bill_num = '$b_no' WHERE visit_ID = '$vid'";
		if(!mysqli_query($conn, $sql2)) {
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
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.</br> check date(yyyy-mm-dd). </br> Bill date must be lower than due date.
  				</div>';
		}
	}
?>

<!-- payment php-->
<?php 
	if($_POST['submit_6']) {
		include "dbconnect.php";

		$vid = $_POST["vid2"];
		$p_date = $_POST["pay_date"];
		$status = $_POST["status"];
		$method = $_POST["method"];
		$payno = $_POST["pay_no"];
		$msg = 0;
		
		$sql = "select Bill_num from visit where visit_ID = $vid";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$bno = $row['Bill_num'];
		
		$sql1 = "INSERT INTO Payment VALUES ('$payno', '$method', '$status', '$bno', '$p_date')";
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
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.
  				</div>';
		}
	}		
?>

<!-- Doctor php-->
<?php 
	if($_POST['submit_3']) {
		include('dbconnect.php');

		$d_name = $_POST["dname"];
		$office = $_POST["office"];
		$addrs = $_POST["addr2"];
		$age = $_POST["age2"];
		$dphone1 = $_POST["dphone1"];
		$dphone2 = $_POST["dphone2"];
		$msg = 0;

		$sql1 = "INSERT INTO Doctor(D_name, Office, Address, Age) VALUES('$d_name', '$office', '$addrs', '$age')";
	
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}
	
		$sql = "select D_ID from Doctor WHERE D_name = '$d_name'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$d_id = $row['D_ID'];
	
		$sql2 = "INSERT INTO Doctor_Phone VALUES('$d_id', '$dphone1')";
		if(!mysqli_query($conn, $sql2)) {
			$msg = 1;
		}
	
		if(!empty($_POST["dphone2"])){
			$sql3 = "INSERT INTO Doctor_Phone VALUES('$d_id', '$dphone2')";
			if(!mysqli_query($conn, $sql3)) {
				$msg = 1;
			}
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
    				<strong>Failure!</strong> Problem with data. Record is NOT saved into database.
  				</div>';
		}
	}
?>

<!-- receptionist php -->
<?php 
	if($_POST['submit_2']) {
		include "dbconnect.php";
		$insco_name = $_POST["insconame"];
		$insco_addr = $_POST["inscoaddr"];
		$insco_p1 = $_POST["inscophone1"];
		$insco_p2 = $_POST["inscophone2"];
		$msg = 0;
		
		$sql1 = "INSERT INTO Insurance_Company VALUES ('$insco_name', '$insco_addr')";
		if(!mysqli_query($conn, $sql1)) {
			$msg = 1;
		}
		$sql2 = "INSERT INTO Insurance_Company_phone VALUES ('$insco_name', '$insco_p1')";
		if(!mysqli_query($conn, $sql2)) {
			$msg = 1;
		}
		if(!empty($insco_p2)){
			$sql3 = "INSERT INTO Insurance_Company_phone VALUES('$insco_name', '$insco_p2')";
			if(!mysqli_query($conn, $sql3)) {
				$msg = 1;
			}
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
                <li class="active"><a href="#banner">Receptionist</a></li>
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

<!--/ Receptionist fields-->
  <section id="" class="section-padding">
    
    <!--/ Patient-->
    <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#patient"><h2 class="ser-title">New Patient Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="patient" class="collapse col-md-8 col-sm-8">
	  <form role="form" id="patient_form" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Patient Name</h4></label>
    			<input type="text reset" name="pname" class="form-control" id="exampleInputPassword1" placeholder="Patient name" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Age</h4></label>
    			<input type="text reset" name="age" class="form-control" id="exampleInputPassword1" placeholder="Patient age" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Address</h4></label>
    			<input type="text" name="addr" class="form-control" id="exampleInputPassword1" placeholder="1234 Main st city" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Phone</h4></label>
    			<input type="text" name="phone1" class="form-control" id="exampleInputPassword1" placeholder="1234567890" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Alternate Phone</h4></label>
    			<input type="text" name="phone2" class="form-control" id="exampleInputPassword1" placeholder="1234567890" >
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Consults </h4></label></br>
			<select name="conslt" required>
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT D_name FROM Doctor");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['D_name'] . "</option>";
					}
				?>
			</select>
			</br></br>	
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Insurance Company </h4></label></br>
			<select name="insco">
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT Insco_name FROM Insurance_Company");
					while ($row = $sql->fetch_assoc()){
						echo "<option>" . $row['Insco_name'] . "</option>";
					}
				?>
			</select>
  		</div>
		

  			<input type="submit" name = "submit_1"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br> 
	  </form>
	</div>
	</div>
     </div>

  <!-- /patient -->

<!--/update Patient-->
    <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#patient1"><h2 class="ser-title">Update Patient Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="patient1" class="collapse col-md-8 col-sm-8">
	  <form role="form" id="patient_form" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Patient ID</h4></label>
    			<input type="text" name="pid7" class="form-control" id="exampleInputPassword1" placeholder="400000" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Consults </h4></label></br>
			<select name="conslt2" required>
				<option selected value> -- select an option -- </option>
				<?php 
					include('dbconnect.php');
					$sql = mysqli_query($conn, "SELECT D_name FROM Doctor");
					while ($row = $sql->fetch_assoc()){
						echo "<option >" . $row['D_name'] . "</option>";
					}
				?>
			</select>
			</br></br>	
  		</div>
			

  			<input type="submit" name = "submit_8"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br> 
	  </form>
	</div>
	</div>
     </div>

  <!-- /update patient -->
	
     <!--/ Visit -->
     <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#visit"><h2 class="ser-title">Visit Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="visit" class="collapse col-md-8 col-sm-8">
	  <form role="form" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Patient ID</h4></label>
    			<input type="text" name="pid1" class="form-control" id="exampleInputPassword1" placeholder="400000" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Complaint </h4></label>
    			<input type="text" name="complent" class="form-control" id="exampleInputPassword1" placeholder="Enter your complaint here" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Date </h4></label>
    			<input type="text" name="date" class="form-control" id="exampleInputPassword1" placeholder="yyyy-mm-dd" required>
  		</div>
  			<input type="submit" name = "submit_4"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br>
	  </form>
	</div>
	</div>
     </div>
     <!--/ Visit -->

     <!--/ Bill -->
     <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#bill"><h2 class="ser-title">Bill Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="bill" class="collapse col-md-8 col-sm-8">
	  <form role="form" method="post">
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Visit ID</h4></label>
    			<input type="text" name="vid1" class="form-control" id="exampleInputPassword1" placeholder="800000" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Doctor Fees </h4></label>
    			<input type="text" name="D_fees" class="form-control" id="exampleInputPassword1" placeholder="111" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Medical Bill </h4></label>
    			<input type="text" name="M_bill" class="form-control" id="exampleInputPassword1" placeholder="Enter bill" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Bill Date</h4></label>
    			<input type="text" name="bill_date" class="form-control" id="exampleInputPassword1" placeholder="yyyy-mm-dd" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Due Date </h4></label>
    			<input type="text" name="due_date" class="form-control" id="exampleInputPassword1" placeholder="yyyy-mm-dd" required>
  		</div>
  			<input type="submit" name = "submit_5" value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br>
	  </form>
	</div>
	</div>
     </div>
     <!--/ Bill -->


     <!-- /payment -->
     <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#payment"><h2 class="ser-title">Payment Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="payment" class="collapse col-md-8 col-sm-8">
	  <form role="form" method="post">
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Visit ID</h4></label>
    			<input type="text" name="vid2" class="form-control" id="exampleInputPassword1" placeholder="800000" required>
  		</div>
  		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Payment Transaction Number</h4></label>
    			<input type="text" name="pay_no" class="form-control" id="exampleInputPassword1" placeholder="Enter Transaction Number" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Status </h4></label>
    			<input type="text" name="status" class="form-control" id="exampleInputPassword1" placeholder="Enter Status" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Method</h4></label>
    			<input type="text" name="method" class="form-control" id="exampleInputPassword1" placeholder="Enter Method" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword1"><h4>Pay Date </h4></label>
    			<input type="text" name="pay_date" class="form-control" id="exampleInputPassword1" placeholder="yyyy-mm-dd" required>
  		</div>
  			<input type="submit" name = "submit_6"value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br>
	  </form>
	</div>
	</div>
     </div>
     <!-- /payment -->

     <!-- /Insurance Company -->
		
		<div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#insco_comp"><h2 class="ser-title">New Insurance Company</h2></button>
          <hr class="botm-line">
        </div>
	<div id="insco_comp" class="collapse col-md-8 col-sm-8">
		  <form role="form" method="post">
  			<div class="form-group">
    				<label for="exampleInputPassword1"><h4>Insurance company Name</h4></label>
    				<input type="text reset" name="insconame" class="form-control" id="exampleInputPassword1" placeholder="Insurance company name" required>
  			</div>
			<div class="form-group">
    				<label for="exampleInputPassword1"><h4>Address</h4></label>
    				<input type="text" name="inscoaddr" class="form-control" id="exampleInputPassword1" placeholder="1234 Main st city" required>
  			</div>
			<div class="form-group">
    				<label for="exampleInputPassword1"><h4>Phone</h4></label>
    				<input type="text" name="inscophone1" class="form-control" id="exampleInputPassword1" placeholder="1234345321" required>
  			</div>
			<div class="form-group">
    				<label for="exampleInputPassword1"><h4>Alternate Phone</h4></label>
    				<input type="text" name="inscophone2" class="form-control" id="exampleInputPassword1" placeholder="1234567890">
  			</div>
							
	  			<input type="submit" name="submit_2" value="Add Insurance Company"> </t> <input type="reset" value="Reset"> </br> <hr> </br>
	 	 </form>
		</div>
		</div>
	     </div>
     <!-- /Insurance Company -->

          
     <!-- /Doctor -->
     <div class="container">
      <div class="row">
	<div class="col-md-12">
          <button data-toggle="collapse" data-target="#doctor"><h2 class="ser-title">New Doctor Details</h2></button>
          <hr class="botm-line">
        </div>
	<div id="doctor" class="collapse col-md-8 col-sm-8">
	  <form role="form" method="post">
		
		<div class="form-group">
    			<label for="exampleInputPassword10"><h4>Doctor Name</h4></label>
    			<input type="text" name="dname" class="form-control" id="exampleInputPassword10" placeholder="Doctor name" required>
  		</div>

		<div class="form-group">
    			<label for="exampleInputPassword40"><h4>Age</h4></label>
    			<input type="text" name="age2" class="form-control" id="exampleInputPassword40" placeholder="age" required>
  		</div>
		
		<div class="form-group">
    			<label for="exampleInputPassword30"><h4>Office Address</h4></label>
    			<input type="text" name="office" class="form-control" id="exampleInputPassword30" placeholder="1234 Main st city" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword20"><h4>Home Address</h4></label>
    			<input type="text" name="addr2" class="form-control" id="exampleInputPassword20" placeholder="1234 Main st city" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword30"><h4>Phone</h4></label>
    			<input type="text" name="dphone1" class="form-control" id="exampleInputPassword30" placeholder="0123456789" required>
  		</div>
		<div class="form-group">
    			<label for="exampleInputPassword30"><h4>Alternate Phone</h4></label>
    			<input type="text" name="dphone2" class="form-control" id="exampleInputPassword30" placeholder="0123456789">
  		</div>			
  			<input type="submit" name="submit_3" value="Submit"> </t> <input type="reset" value="Reset"> </br> <hr> </br>
	  </form>
	</div>
	</div>
     </div>
     <!--/ Doctor -->

</section>
  <!--/ Receptionist Fields-->


  
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
