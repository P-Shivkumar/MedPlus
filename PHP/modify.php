<?php
	$con=mysqli_connect("localhost","root","root","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	session_start();
	if(isset($_POST['speciality'])){
		$speciality = $_POST['speciality'];
		$result = mysqli_query($con, "select D_name from Doctor where Speciality='$speciality'");
		$data = array();
		$i = 0;		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row['D_name'];
		}
		echo json_encode($data);
		exit();
	}
	
	if(isset($_POST['emergency'])){
		$speciality = $_POST['emergencyspecialist'];
		$currtime = date("G:i:s");
		$today = date('Y-m-d');
		$time = date("G:i:s", strtotime('12:30:00'));
		if($currtime > $time)
			$time = date("G:i:s", strtotime('09:00:00'));
		else
			$time = date("G:i:s", strtotime('13:00:00'));
		$result = mysqli_query($con, "select D_name from Doctor where Speciality='$speciality' AND StartTime = '$time'");
		$data = array();
		$i = 0;		
		while($row = mysqli_fetch_assoc($result)){
			$flag = 0;
			$doctor = $row['D_name'];
			$arry = mysqli_query($con, "select Time from EmergencyApt where Date='$today' AND D_ID=(select D_ID from Doctor where D_name='$doctor')");
			while($row3 = mysqli_fetch_assoc($arry)){
				$apttime = date('G:i:s', strtotime('-30 minutes', strtotime($currtime)));
				if(row3['Time'] > $apttime)
					$flag = 1;
			}
			if($flag == 0)
				$data[$i++] = $row['D_name'];
		}
		echo json_encode($data);
		exit();
	}
	
	if(isset($_POST['EmergencyPatient'])){
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$doctor = $_POST['doctor'];
		$query = mysqli_query($con, "insert into PatientNotLogin (P_name, Age, Address, Email, VisitCount, islogin) values ('$name', '$age', '$address', '$email', 0, 2)");
		$result = mysqli_query($con, "select P_ID from PatientNotLogin where P_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$pid = intval($row['P_ID']);
		
		$result = mysqli_query($con, "select * from Doctor where D_name = '$doctor'");
		$row = mysqli_fetch_assoc($result);
		$did = intval($row['D_ID']);
		$date = date('Y-m-d');
		$time = date('G:i:s');
		$apttime = date('G:i:s', strtotime('+10 minutes', strtotime($time)));

		$result = mysqli_query($con, "insert into EmergencyApt values ('$pid', '$did','$date', '$apttime')");
		exit();
	}
	
	if(isset($_POST['newuser'])){
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$query = mysqli_query($con, "insert into PatientLogin (P_name, Age, Address, Email, VisitCount) values ('$name', '$age', '$address', '$email', 0)");
		$query = mysqli_query($con, "insert into logininfo values ('$email', '$password', 0)");
		$message = "Congrats!!!\nNow you are our premier member. Now Log in to get more services ";
		mail($email, 'Signed Up successfully!!', $message);
		exit();
	}
	
	if(isset($_POST['Newpatient'])){
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$doctor = $_POST['doctor'];
		$query = mysqli_query($con, "insert into PatientNotLogin (P_name, Age, Address, Email, VisitCount) values ('$name', '$age', '$address', '$email', 0)");
		$result = mysqli_query($con, "select P_ID from PatientNotLogin where P_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$pid = intval($row['P_ID']);
		
		$result = mysqli_query($con, "select * from Doctor where D_name = '$doctor'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		$slot  = $row['Slot'];
		$limit = 180 / $slot;
		$did = intval($row['D_ID']);
		
		$d = strtotime("tomorrow");
		$date = date("Y-m-d", $d);
		$i = 0;
		while($i < 7){
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_assoc($result);
			$slotnum = $row['slot'];
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_row($result);
			if (implode(null,$row) == null){
				$slotnum = 0;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '1')");
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`) VALUES ('$pid', '$did', '$date', '$starttime')");
				echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
				exit();
			} else if($slotnum > $limit){
				$date = date("Y-m-d",strtotime("+1 day", strtotime($date)));
				$i = $i + 1;
				continue;
			} else {
				$hours = floor(($slot * $slotnum) / 60);
				$minutes = (($slot * $slotnum) % 60);
				$time = "+" . "$hours" . " hours +" . "$minutes" . " minutes";
				$time = date("G:i:s", strtotime($time, strtotime($starttime)));	
				$slotnum = intval($slotnum) + 1;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotnum')");		
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`) VALUES ('$pid', '$did', '$date', '$time')");
				echo "You have appointment on " . $date . "\n\t\t at " . $time . " O'clock";
				exit();			
			}
		
			exit();
		}
	}
	
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$result = mysqli_query($con, "select * from logininfo where Email = '$email'");
		$row = mysqli_fetch_assoc($result);
		
		$flag = $row['flag'];
		if($flag == '0'){
			
			$result = mysqli_query($con, "select P_name from PatientLogin where Email='$email'");
			$name = mysqli_fetch_array($result);
			$_SESSION["name"] = $name['P_name'];
			error_log("i am a patient");
		} else if($flag == '1'){
			$result = mysqli_query($con, "select D_name from Doctor where Email='$email'");
			$name = mysqli_fetch_array($result);
			$_SESSION["name"] = $name['D_name'];
			error_log("i am a doctor");
		}
		if($password == $row['Password'])
			echo "true".$flag;
		else
			echo "false";
		exit();
	}
	
	
	if(isset($_POST['givedate'])){
		$doctor = $_POST['doctor'];
		
		$name = $_SESSION["name"];
		$result = mysqli_query($con, "select L_ID from PatientLogin where P_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$lid = intval($row['L_ID']);
		$email = $row['Email	'];
		$result = mysqli_query($con, "select MAX(P_ID) as P_ID from PatientLoginPID");
		$row = mysqli_fetch_assoc($result);
		$pid = intval($row['P_ID']);
		$pid = $pid + 1;
		$result = mysqli_query($con, "INSERT INTO `PatientLoginPID` VALUES ('$lid', '$pid')");
		
		$result = mysqli_query($con, "select * from Doctor where D_name = '$doctor'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		$slot  = $row['Slot'];
		$limit = 180 / intval($slot);
		$did = intval($row['D_ID']);
		
		$d = strtotime("tomorrow");
		$date = date("Y-m-d", $d);
		$curtime = date("h:i:s");
		$i = 0;
		while($i < 7){
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_assoc($result);
			$slotnum = $row['slot'];
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_row($result);
			if (implode(null,$row) == null){
				$slotnum = 0;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '1')");
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$starttime', 1)");
				echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
				$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
				mail($email, 'Appointment', $message);
				exit();
			} else if($slotnum > $limit){
				$date = date("Y-m-d",strtotime("+1 day", strtotime($date)));
				$i = $i + 1;
				continue;
			} else {
				$hours = floor(($slot * $slotnum) / 60);
				$minutes = (($slot * $slotnum) % 60);
				$time = "+" . "$hours" . " hours +" . "$minutes" . " minutes";
				$time = date("G:i:s", strtotime($time, strtotime($starttime)));	
				$slotnum = intval($slotnum) + 1;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotnum')");		
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$time', 1)");
				echo "You have appointment on " . $date . "\n\t\t at " . $time . " O'clock";
				$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
				mail($email, 'Appointment', $message);
				exit();			
			}
			exit();
		}	
	}
	
	if(isset($_POST['updateProfile'])){
		$id = $_POST['id'];
		$flag = $_POST['flag'];
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		if($flag == 1){	
			$result = mysqli_query($con, "update Doctor set D_name='$name', Age='$age', Address='$address', Email='$email' where D_ID='$id'");
		} else {
			$result = mysqli_query($con, "update PatientLogin set P_name='$name', Age='$age', Address='$address', Email='$email' where L_ID='$id'");
		}
		exit();
	}
	
	if(isset($_POST['consulted'])){
		$id = $_POST['id'];
		$time = $_POST['time'];
		$result = mysqli_query($con, "select * from Consults where P_ID = '$id' AND AptTime = '$time'");
		$row = mysqli_fetch_assoc($result);
		$did = $row['D_ID'];
		$date = $row['ConsultDate'];
		$result = mysqli_query($con, "delete from Consults where P_ID = '$id' AND AptTime = '$time'");
		$result = mysqli_query($con, "insert into consulted values ('$id', '$did', '$date', '$time')");
		exit();
	}
	
	
	if(isset($_POST['NewPatientNotLogin'])){
		$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$doctor = $_POST['doctor'];
		$query = mysqli_query($con, "insert into PatientNotLogin (P_name, Age, Address, Email, VisitCount) values ('$name', '$age', '$address', '$email', 0)");
		$result = mysqli_query($con, "select * from PatientNotLogin where P_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$pid = intval($row['P_ID']);
		$email = $row['Email'];
		
		$result = mysqli_query($con, "select * from Doctor where D_name = '$doctor'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		$endtime = $row['EndTime'];
		$slot  = $row['Slot'];
		$limit = 180/intval($slot);
		$did = intval($row['D_ID']);
		
		$time = date("G:i:s");
		if($time > $endtime)
			$date = date("Y-m-d", strtotime("tommorow"));
		else
			$date = date("Y-m-d");
		$i = 0;
		while($i < 7){
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_assoc($result);
			$slotnum = $row['slot'];
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_row($result);
			if (implode(null,$row) == null){
				error_log("in null!!!!!!!");
				if($time < $starttime ||  $date == date("Y-m-d", strtotime("tomorrow"))){
					$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '1')");
					$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`,`islogin`) VALUES ('$pid', '$did', '$date', '$starttime', 0)");
					echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}
				else if($time > $endtime) {
					$date = date("Y-m-d",strtotime("tomorrow"));
					$i++;
					continue;
				}
				else  if($time < $endtime && $time > $starttime && $date == date("Y-m-d")){
					$startTime = new DateTime($starttime);
					$endTime = new DateTime($time);
					$duration = $startTime->diff($endTime); //$duration is a DateInterval object
					$time    = explode(':', $duration->format("%H:%I:%S"));
					$slotcount =floor( ($time[0] * 60.0 + $time[1] * 1.0)/10+1);
					$minutes = $slotcount*10;
					$apttime =  date('G:i:s', strtotime('+'.$minutes.' minutes', strtotime($starttime)));
					$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotcount')");
					$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`,`islogin`) VALUES ('$pid', '$did', '$date', '$apttime', 0)");
					echo "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}
				exit();
			} else if($slotnum > $limit){
				$date = date("Y-m-d",strtotime("+1 day", strtotime($date)));
				$i = $i + 1;
				error_log("----------Slot full---------");
				continue;
			} else if($date == date("Y-m-d", strtotime("today"))){
				error_log("--------in today not full-------");
				$hours = floor(($slot * $slotnum) / 60);
				$minutes = (($slot * $slotnum) % 60);
				$apttime = "+" . "$hours" . " hours +" . "$minutes" . " minutes";
				$apttime = date("G:i:s", strtotime($time, strtotime($starttime)));
				echo "==>".$apttime;
				$currtime = date("G:i:s");
				if($currtime < $apttime){
					$slotnum = intval($slotnum) + 1;
					$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotnum')");		
					$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`,`islogin`) VALUES ('$pid', '$did', '$date', '$time', 0)");
					echo "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}else if($currtime > $endtime){
					$date = date("Y-m-d",strtotime("+1 day", strtotime($date)));
					$i = $i + 1;
					continue;
				}else {
					
					error_log("-----------------------in balu sdfsdf------------------------------");
					$startTime = new DateTime($starttime);
					$currtime = date("G:i:s");
					$endTime = new DateTime($currtime);
					$duration = $startTime->diff($endTime); //$duration is a DateInterval object
					$time    = explode(':', $duration->format("%H:%I:%S"));
					$slotcount =floor(($time[0] * 60.0 + $time[1] * 1.0)/10)+1;
					$minutes = $slotcount*10;
					$apttime =  date('G:i:s', strtotime('+'.$minutes.' minutes', strtotime($starttime)));
					$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotcount')");
					$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$apttime', 0)");
					echo "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}
			
			} else {
				$hours = floor(($slot * $slotnum) / 60);
				$minutes = (($slot * $slotnum) % 60);
				$apttime = "+" . "$hours" . " hours +" . "$minutes" . " minutes";
				$apttime = date("G:i:s", strtotime($time, strtotime($starttime)));	
				$slotnum = intval($slotnum) + 1;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotnum')");		
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$time', 0)");
				echo "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
				$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
				mail($email, 'Appointment', $message);
				exit();			
			}
		
			exit();
		}
	}
	
	
	
	if(isset($_POST['insertprescription'])){
		$id = $_POST['id'];
		$time = $_POST['time'];
		$disease = $_POST['disease'];
		$medicine = $_POST['medicine'];
		$dailydose = $_POST['dailydose'];
		$quantity = $_POST['quantity'];	
		$date = date('Y-m-d');
		$result = mysqli_query($con, "INSERT INTO `Prescription`(`P_ID`, `Disease`, `Medicine`, `DosePerDay`, `Quantity`, `PrescriptionDate`) VALUES ('$id','$disease','$medicine','$dailydose','$quantity', '$date')");
		exit();
	}
	
	if(isset($_POST['Trial'])){
		$d = strtotime("today");
		$result = mysqli_query($con, "select * from Doctor where D_name = 'Husen Bolt'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		$endtime = $row['EndTime'];
		$time = date("G:i:s");
		$date = date("Y-m-d");
		$i = 0;
		while($i < 7){
				if($time < $starttime ||  $date == date("Y-m-d", strtotime("tomorrow"))){
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '1')");
						$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`) VALUES ('$pid', '$did', '$date', '$starttime')");
					echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}
				else if($time > $endtime) {
					$date = date("Y-m-d",strtotime("tomorrow"));
					$i++;
					continue;
				}
				else  if($time < $endtime && $time > $starttime && $date == date("Y-m-d")){
					$startTime = new DateTime($starttime);
					$endTime = new DateTime($time);
					$duration = $startTime->diff($endTime); //$duration is a DateInterval object
					$time    = explode(':', $duration->format("%H:%I:%S"));
					$slotcount =floor( ($time[0] * 60.0 + $time[1] * 1.0)/10+1);
					$minutes = $slotcount*10;
					$apttime =  date('G:i:s', strtotime('+'.$minutes.' minutes', strtotime($starttime)));
					$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotcount')");
					$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`) VALUES ('$pid', '$did', '$date', '$apttime')");
					echo "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					$message = "You have appointment on " . $date . "\n\t\t at " . $apttime . " O'clock";
					mail($email, 'Appointment', $message);
					exit();
				}
				exit();
		}
	}
	
	if(isset($_POST['cancel'])){
		$id = $_POST['id'];
		$currtime = $_POST['time'];
		$name = $_POST['name'];
		$date = $_POST['date'];
		$Pname = $_SESSION['name'];
		
		$result = mysqli_query($con, "select * from Doctor where D_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		
		$result = mysqli_query($con, "select * from PatientLogin where P_name = '$Pname'");
		$row = mysqli_fetch_assoc($result);
		$email = $row['Email'];

		$startTime = new DateTime($starttime);
		$endTime = new DateTime($currtime);
		$duration = $startTime->diff($endTime); //$duration is a DateInterval object
		$time    = explode(':', $duration->format("%H:%I:%S"));
		$slotcount =floor( ($time[0] * 60.0 + $time[1] * 1.0)/10 + 1);
		
		$result = mysqli_query($con, "delete from Consults where D_ID='$id' AND ConsultDate='$date' AND AptTime='$currtime'");
		$result = mysqli_query($con, "delete from Appointment where D_ID='$id' AND AptDate='$date' AND SlotCount='$slotcount'");
		
		$result = mysqli_query($con,"select * from Appointment where D_ID='$id' AND AptDate ='$date' AND SlotCount >='$slotcount'");
		while($row = mysqli_fetch_assoc($result)){
			$did = $row['D_ID'];
			$date = $row['AptDate']; 
			$slotcount = $row['SlotCount']; 
			$res = mysqli_query($con,"update Appointment set SlotCount = $slotcount - 1 where D_ID='$did' AND AptDate ='$date' AND SlotCount >='$slotcount'");
		}
		
		$result = mysqli_query($con, "select * from Consults where D_ID='$id' AND ConsultDate='$date' AND AptTime >='$currtime'");
		while($row = mysqli_fetch_assoc($result)){
			$did = $row['D_ID'];
			$date = $row['ConsultDate']; 
			$apttime = $row['AptTime']; 
			$pid = $row['P_ID'];
			$time = date("G:i:s", strtotime("-10 minutes", strtotime($apttime)));
			error_log("time is :". $time." ".$currtime);
			echo $time;
			$res = mysqli_query($con, "update Consults set AptTime = '$time' where D_ID='$did' AND ConsultDate='$date' AND AptTime > '$currtime'");
			$query = mysqli_query($con, "select * from PatientLogin where L_ID = '$pid'");
			$array = mysqli_fetch_assoc($query);
			$mailid = $array['Email']; 
			$message = "Your appointment has been preponed by 10 minutes. Now your appointment is on ".$date." at ". $time." O'clock";
			mail($email, 'Preponed appointment', $message); 
		}
		
		$message = "Your appointment has been cancelled successfully";
		mail($email, 'Appointment', $message);
		exit();
	}
	
	
	if(isset($_POST['continueapt'])){
		$did = $_POST['id'];
		$pid = $_POST['pid'];
		$name = $_SESSION['name'];
		$result = mysqli_query($con, "select * from PatientLogin where P_name = '$name'");
		$row = mysqli_fetch_assoc($result);
		$email = $row['Email'];
		
		$result = mysqli_query($con, "select * from Doctor where D_ID = '$did'");
		$row = mysqli_fetch_assoc($result);
		$starttime = $row['StartTime'];
		$slot  = $row['Slot'];
		$limit = 180 / intval($slot);
		
		$d = strtotime("tomorrow");
		$date = date("Y-m-d", $d);
		$curtime = date("h:i:s");
		$i = 0;
		while($i < 7){
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_assoc($result);
			$slotnum = $row['slot'];
			$result = mysqli_query($con, "select MAX(SlotCount) as slot from Appointment where D_ID = '$did' AND AptDate = '$date' ");
			$row = mysqli_fetch_row($result);
			if (implode(null,$row) == null){
				$slotnum = 0;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '1')");
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$starttime', 1)");
				echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
				$message = "Your appointment has been scheduled on" . $date . "\n\t\t at " . $starttime . " O'clock";
				mail($email, 'Appointment continued', $message);
				exit();
			} else if($slotnum > $limit){
				$date = date("Y-m-d",strtotime("+1 day", strtotime($date)));
				$i = $i + 1;
				continue;
			} else {
				$hours = floor(($slot * $slotnum) / 60);
				$minutes = (($slot * $slotnum) % 60);
				$time = "+" . "$hours" . " hours +" . "$minutes" . " minutes";
				$time = date("G:i:s", strtotime($time, strtotime($starttime)));	
				$slotnum = intval($slotnum) + 1;
				$result = mysqli_query($con, "INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES ('$did', '$date', '$slotnum')");		
				$result = mysqli_query($con, "INSERT INTO `Consults`(`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES ('$pid', '$did', '$date', '$time', 1)");
				echo "You have appointment on " . $date . "\n\t\t at " . $time . " O'clock";
				echo "You have appointment on " . $date . "\n\t\t at " . $starttime . " O'clock";
				$message = "Your appointment has been scheduled on" . $date . "\n\t\t at " . $starttime . " O'clock";
				mail($email, 'Appointment continued', $message);
				exit();			
			}
			exit();
		}
		
	}
	
	if(isset($_POST['showprescription'])){
		$id = $_POST['id'];
		$result = mysqli_query($con,"SELECT * FROM Prescription where P_ID='$id'");
		$data = array();
		$i = 0;		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row['PrescriptionDate'];
			$data[$i++] = $row['Medicine'];
			$data[$i++] = $row['DosePerDay'];
			$data[$i++] = $row['Quantity'];
			
		}
		echo json_encode($data);
		exit();
	}
?>
