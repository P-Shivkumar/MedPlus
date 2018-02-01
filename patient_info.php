<?php 
	include "dbconnect.php";

	$patient_id1 = $_POST["pid"];
	$patient_name1 = $_POST["pname"];
	$consult1 = $_POST["conslt"];
	$a = $_POST["addr"];
	$phone1 = $_POST["phone"];
	$age1 = $_POST["age"];
	
	$sql = "INSERT INTO Patient VALUES ('$patient_id1', '$patient_name1', '$age1', '$a', NULL, NULL)";
	if(mysqli_query($conn, $sql)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}

	if(mysqli_query($conn, "INSERT INTO Consults VALUES ('$patient_id1', '$consult1')")) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}
	mysqli_close($conn);
?>
