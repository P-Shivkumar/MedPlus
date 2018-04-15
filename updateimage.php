<?php
	$con=mysqli_connect("localhost","root","root","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	session_start();
	$user = $_SESSION["name"];
	$imagename=$_FILES["myimage"]["name"]; 

	//Get the content of the image and then add slashes to it 
	$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

	//Insert the image name and image content in image_table
	$result = mysqli_query($con, "select * from Doctor where D_name = '$user'");
	$row = mysqli_fetch_assoc($result);
	$id = $row['D_ID'];
	
	$result = mysqli_query($con, "select * from DoctorPhone where D_ID = '$id'");
	$row = mysqli_fetch_row($result);
	if (implode(null,$row) == null){
		$result = mysqli_query($con, "insert into DoctorPhone values ('$id','$imagename')");
	} else {
		$result = mysqli_query($con, "update DoctorPhone set imagename = '$imagename'");
	}
	
	$uploaddir = '/var/www/html/Medilab/img/';
	$uploadfile = $uploaddir . basename($_FILES['myimage']['name']);

	echo "<p>";

	if (move_uploaded_file($_FILES['myimage']['tmp_name'], $uploadfile)) {
	  echo "File is valid, and was successfully uploaded.\n";
	} else {
	   echo "Upload failed";
	}
?>
  <script src="js/modify.js"></script>
  <script src="js/jquery.js"></script>	

<body onload="updateimage()">

