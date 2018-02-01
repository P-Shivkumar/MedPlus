<?php 
	include "dbconnect.php";

	$patient_id1 = $_POST["pid1"];
	$complaint = $_POST["complent"];
	$date = $_POST["date"];
	
	$sql = "select num from Temp where P_ID = '$patient_id1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$diagnosis_id = $row['num'];
	

	$sql = "select D_ID from Consults where P_ID = '$patient_id1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$d_id = $row['D_ID'];
	
	$sql1 = "INSERT INTO visit(visit_date, copmlaint, diagnosis_ID, D_ID, Bill_num) VALUES ('$date', '$complaint', '$diagnosis_id', '$d_id', NULL)";
	if(mysqli_query($conn, $sql1)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}

	$sql = "select max(Visit_ID) as V_ID FROM attends";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$vid = $row['V_ID'];
	
	$sql2 = "INSERT INTO attends VALUES('$patient_id1', '$vid')";
	if(mysqli_query($conn, $sql2)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}

	mysqli_close($conn);
?>
