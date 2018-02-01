<?php 
	include('dbconnect.php');

	$d_name = $_POST["dname"];
	$office = $_POST["office"];
	$addrs = $_POST["addr2"];
	$age = $_POST["age2"];
	$phone1 = $_POST["dphone1"];
	$phone2 = $_POST["dphone2"];

	$qery = "INSERT INTO Doctor(D_name, Office, Address, Age) VALUES('$d_name', '$office', '$addrs', '$age')";
	
	if(mysqli_query($conn, $qery)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}
	$sql = "select D_ID from Doctor WHERE D_name = '$d_name'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$d_id = $row['D_ID'];
	
	$qery1 = "INSERT INTO Doctor_Phone VALUES('$d_id', '$phone1')";
	if(mysqli_query($conn, $qery1)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}
	
	if(!empty($_POST["dphone2"])){
		$qery2 = "INSERT INTO Doctor_Phone VALUES('$d_id', '$phone2')";
		mysqli_query($conn, $qery2);
	}
	mysqli_close($conn);
?>
