<?php
	session_start();
	$user = $_SESSION["name"];
	$con=mysqli_connect("localhost","root","k136616","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con, "select * from Doctor where D_name = '$user'");
	$row = mysqli_fetch_assoc($result);
	$id = $row['D_ID'];
	$name = $row['D_name'];
	$age = $row['Age'];
	$address = $row['Address'];
	$email = $row['Email'];
	$result = mysqli_query($con, "select * from logininfo where Email = '$email'");
	$row = mysqli_fetch_assoc($result);
	$password = $row['Password'];
	$flag = $row['flag'];
	$result = mysqli_query($con, "select * from DoctorPhone where D_ID = '$id'");
	$row = mysqli_fetch_assoc($result);
	$image = $row['imagename'];
	
?>

 <section id="contact" class="section-padding">
    <div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img id="myimage" name="myimage" src="img/<?php echo $image;?>" width=100 height=100 class="avatar img-circle" alt="avatar">
          <h1></h1>
          <form enctype="multipart/form-data" action="updateimage.php" method="POST">
          <input type="file" name="myimage" class="form-control" onchange="readURL(this);">
          <h1></h1>
         <input type="submit" class="btn btn-primary" value="update">
	</form>
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div>
        <h3>Personal info</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
              <input id="name" class="form-control" type="text" value="<?php echo $name;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Age:</label>
            <div class="col-lg-8">
              <input id="age" class="form-control" type="text" value="<?php echo $age;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-8">
              <input id="address" class="form-control" type="text" value="<?php echo $address;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input id="email" class="form-control" type="text" value="<?php echo $email;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input id="password"class="form-control" type="password" value="<?php echo $password;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input id="repassword" class="form-control" type="password" value="<?php echo $password;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="button" class="btn btn-primary" value="Update" onclick="update(<?php echo $id;?>, <?php echo $flag;?>)">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
  </section>
 
