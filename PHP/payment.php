<?php 
		include "dbconnect.php";

		$vid = $_POST["vid2"];
		$p_date = $_POST["pay_date"];
		$status = $_POST["status"];
		$method = $_POST["method"];
		$payno = $_POST["pay_no"];
		
		$sql = "select Bill_num from visit where visit_ID = $vid";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$bno = $row['Bill_num'];
		
		$sql = "INSERT INTO Payment VALUES ('$payno', '$method', '$status', '$bno', '$p_date')";
		if(mysqli_query($conn, $sql)) {
			$msg = "Record Successfully Inserted into database";
		}
		else{
			$error = "Error In Query";
		}

		
?>
