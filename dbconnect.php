<?php
	$host = "localhost";
	$user = "root";
	$password = "Ganeshay@751997";
	$dbname = "Hospital";
	
	$conn = mysqli_connect($host, $user, $password, $dbname);
	if(!$conn) {
		die("Error in connection to database");
	}
?>
