<?php 
	include "dbconnect.php";

	$patient_name1 = $_POST["pname"];
	$consult1 = $_POST["conslt"];
	$a = $_POST["addr"];
	$phone1 = $_POST["phone1"];
	$phone2 = $_POST["phone2"];
	$age1 = $_POST["age"];
	$insco_name = $_POST["insconame"];
	$insco_addr = $_POST["inscoaddr"];
	$insco_p1 = $_POST["inscophone1"];
	$insco_p2 = $_POST["inscophone2"];
	
	$sql1 = "INSERT INTO Patient(P_name, Age, Address) VALUES ('$patient_name1', '$age1', '$a')";
	mysqli_query($conn, $sql1);
			
	$sql = "select Max(P_ID) as P_ID from Patient";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$P_ID = $row['P_ID'];
	$sql2 = "INSERT INTO Patient_Phone VALUES('$P_ID', '$phone1')";
	mysqli_query($conn, $sql2);
	if(!empty($phone2)){
		$sql3 = "INSERT INTO Patient_Phone VALUES('$P_ID', '$phone2')";
		mysqli_query($conn, $sql3);
	}
	$sql = "SELECT * FROM Doctor where D_name='".$consult1."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$D_ID = $row['D_ID'];
	$sql4 = "INSERT INTO Consults VALUES ('$P_ID', '$D_ID')";
	mysqli_query($conn, $sql4);

	mysqli_close($conn);
?>

