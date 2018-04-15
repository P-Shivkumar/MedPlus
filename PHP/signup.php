

<?php
$con=mysqli_connect("localhost","root","k136616","Healthcare");
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$name	= $_POST['name'];
$age	= $_POST['age'];
$address= $_POST['address'];
$username= $_POST['username'];
mysqli_query($con,"insert into PatientLogin values (12, '$name', '$age', '$address', 0)");
header("location:../index.php");
?>


