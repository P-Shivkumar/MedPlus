<?php 
		include "dbconnect.php";

		$vid = $_POST["vid1"];
		$b_no = $_POST["bill_no"];
		$dfees = $_POST["D_fees"];
		$mbill = $_POST["M_bill"];
		$b_date = $_POST["bill_date"];
		$d_date = $_POST["due_date"];

		$amount = $dfees + $mbill;

		$sql = "INSERT INTO Bill(amount, Bill_date, Due_date, Insco_name) VALUES ('$amount', '$b_date', '$d_date', NULL)";
		if(mysqli_query($conn, $sql)) {
			$msg = "Record Successfully Inserted into database";
		}
		else{
			$error = "Error In Query";
		}

		$sql = "select max(Bill_num) as b_no from Bill";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$b_no = $row['b_no'];

		$sql1 = "UPDATE visit SET visit.Bill_num = '$b_no' WHERE visit_ID = '$vid'";
		if(mysqli_query($conn, $sql1)) {
			$msg = "Record Successfully Inserted into database";
		}
		else{
			$error = "Error In Query";
		}
		mysqli_close($conn);
		if($msg) {
			$result = '<div class="alert alert-success"> <strong>Success!</strong> Record Successfully stored in database </div>';
		}

?>
