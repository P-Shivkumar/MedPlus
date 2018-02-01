<?php 
	include "dbconnect.php";

	$med_name = $_POST["med_name"];
	$med_quant = $_POST["med_quant"];
	$med_price = $_POST["med_price"];
	$ex_date = $_POST["ex_date"];
	$manu_name = $_POST["manu_name"];
		
	$sql = "INSERT INTO Medicine VALUES ('$med_name', '$med_price', '$med_quant', '$ex_date', '$manu_name')";
	if(mysqli_query($conn, $sql)) {
		echo "Record Successfully Inserted into database";
	}
	else{
		echo "Error In Query";
	}

	mysqli_close($conn);
?>
