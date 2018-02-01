<?php 
	include "dbconnect.php";
	$p_id = $_POST["p_id"];
	$cat = $_POST["categry"];
	$med_name = $_POST["medicine"];
	$dose = $_POST["dose"];
	$quant = $_POST["med_quant"];
	$r1 = $_POST["record1"];
	$r2 = $_POST["record2"];
	$r3 = $_POST["record3"];

	$sql = "INSERT INTO prescription(M_name, quantity, daily_dose) VALUES('$med_name', '$quant', '$dose')";
	if(mysqli_query($conn, $sql)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}
	$sql = "INSERT INTO Temp(P_ID) values('$p_id')";
	mysqli_query($conn, $sql);
	
	$sql = "select Max(num) as num from Temp ";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$dg_id = $row['num'];
	
	$sql = "INSERT INTO diagnosis VALUES('$cat', '$dg_id')";
	mysqli_query($conn, $sql);

	$sql = "select Max(prescription_ID) as num from prescription";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$ps_id = $row['num'];

	$sql = "INSERT INTO yeilds VALUES('$ps_id', '$dg_id')";
	mysqli_query($conn, $sql);
	if(!empty($_POST["record1"])){
		$qery2 = "Insert into Records Values ('$p_id', '$r1')";
		mysqli_query($conn, $qery2);
	}
	else{
		echo "Error In Query";
	}
	if(!empty($_POST["record2"])){
		$qery2 = "Insert into Records Values ('$p_id', '$r2')";
		mysqli_query($conn, $qery2);
	}
	if(!empty($_POST["record3"])){
		$qery2 = "Insert into Records Values ('$p_id', '$r3')";
		mysqli_query($conn, $qery2);
	}
	
	mysqli_close($conn);
?>
