<?php
	$con=mysqli_connect("localhost","root","k136616","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if(isset($_POST['submit']))
		 echo $_POST['select'];
?>
