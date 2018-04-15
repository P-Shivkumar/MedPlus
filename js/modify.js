var time;
var pid;
var flag;

/* New User from SignUP-form*/
function NewUser(){
	var name = document.getElementById("signupname").value;
	var age = document.getElementById("age").value;
	var address = document.getElementById("address").value;
	var email = document.getElementById("signupemail").value;
	var password = document.getElementById("password").value;	
	$.ajax({
            type: "POST",
            url: "PHP/modify.php",
            data: { 
			newuser: 'newuser',
			name : name,
			age : age,
			address : address,
			email : email,
			password : password
		  },
            success: function(response){
            }
        });
}

/* New User not logged in*/
function NewPatient(){
	var name = document.getElementById("newname").value;
	if(name == ""){
		$("#newname").addClass("redborder");
    		return;
	}
	var age = document.getElementById("newage").value;
	if(age == ""){
		$("#newage").addClass("redborder");
    		return;
	}
	var address = document.getElementById("newaddress").value;
	if(address == ""){
		$("#newaddress").addClass("redborder");
    		return;
	}
	var email = document.getElementById("newemail").value;	
	if(email == ""){
		$("#newemail").addClass("redborder");
    		return;
	}
	
	var dropDown = document.getElementById("DoctorDropdown");
    	var doctor = dropDown.options[dropDown.selectedIndex].value;
	
	$.ajax({
	    type: "POST",
	    url: "PHP/modify.php",
	    data: { 
		Newpatient: 'Newpatient',
		name : name,
		age : age,
		address : address,
		email : email,
		doctor : doctor
	  },
	  success: function(response){
		  alert(response);
	  }
	});
}

function NewPatientNotLogin(){
	var name = document.getElementById("newname").value;
	if(name == ""){
		$("#newname").addClass("redborder");
    		return;
	}
	var age = document.getElementById("newage").value;
	if(age == ""){
		$("#newage").addClass("redborder");
    		return;
	}
	var address = document.getElementById("newaddress").value;
	if(address == ""){
		$("#newaddress").addClass("redborder");
    		return;
	}
	var email = document.getElementById("newemail").value;	
	if(email == ""){
		$("#newemail").addClass("redborder");
    		return;
	}
	var dropDown = document.getElementById("DoctorDropdown");
    	var doctor = dropDown.options[dropDown.selectedIndex].value;
	
	$.ajax({
	    type: "POST",
	    url: "PHP/modify.php",
	    data: { 
		NewPatientNotLogin: 'NewPatientNotLogin',
		name : name,
		age : age,
		address : address,
		email : email,
		doctor : doctor
	  },
	  success: function(response){
		  alert(response);
	  }
	});
}

function checkPassword(){
	var password = document.getElementById("password").value;
	var repassword = document.getElementById("repassword").value;
	if(password != repassword){
	    document.getElementById('message').style.color = 'red';
	    document.getElementById('message').innerHTML = 'not matching';
	} else{
	    document.getElementById('message').style.color = 'green';
	    document.getElementById('message').innerHTML = 'matching';
	}
}

function CheckLogin(){
	var email = document.getElementById("emailid").value;
	var password = document.getElementById("loginpassword").value;
	$.ajax({
            type: "POST",
            url: "PHP/modify.php",
            data: { 
			login: 'login',
			email : email,
			password : password
		  },
            success: function(response){
            	if(response == "wrongmail"){
			alert("Please enter valid Email address.");	
		}
            	if(response == "true0"){
			window.location="temp.php";
			flag = 0;	
		}
		else if(response == "true1"){
			window.location="doctor.php";
			flag = 1;	
		}
		else if(response == "true2"){
			window.location="appointment.php";
			flag = 2;
		}
		else
			alert("Email ID or Password is wrong.");
            }
        });
}

function loaddoctor(){
    var dropDown = document.getElementById("SpecialityDropdown");
    var speciality = dropDown.options[dropDown.selectedIndex].value;
    $.ajax({
            type: "POST",
            url: "PHP/modify.php",
            data: { 'speciality': speciality  },
	    dataType: "json",
            success: function(response){
		var len = response.length;	
                $("#DoctorDropdown").empty();
		$("#DoctorDropdown").append("<option>"+"Nothing selected"+"</option>");
                for( var i = 0; i<len; i++){                    
                    $("#DoctorDropdown").append("<option>"+response[i]+"</option>");	
                }
            }
        });
}

function givedate(){
    var dropDown = document.getElementById("DoctorDropdown");
    var doctor = dropDown.options[dropDown.selectedIndex].value;
    $.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: { 
            	givedate: 'givedate',
            	doctor: doctor
            },
	    success: function(response){
		alert(response);
            }
    });
}

function writePrescription(id){  //NOT COMPLETE
	  var tr = document.getElementById(id);
	  var td = tr.getElementsByTagName("td");
	  time = td[2].innerHTML;
	  pid = id;
}

function createNextRow(){
	var table=document.getElementById("targettable");
	var table_len=(table.rows.length);
	var tr = document.getElementById(table_len);
	var td = tr.getElementsByTagName("td");
	var disease = td[0].innerHTML;
	if(disease == ""){
		td[0].style.borderColor = "red";
    		td[0].style.borderStyle = "solid";
    		return;
	}
	td[0].style.borderColor = "gray";
	var medicine = td[1].innerHTML;
	if(medicine == ""){
		td[1].style.borderColor = "red";
    		td[1].style.borderStyle = "solid";
    		return;
	}	
	td[1].style.borderColor = "gray";
	var dailydose = td[2].innerHTML;
	if(dailydose == ""){
		td[2].style.borderColor = "red";
    		td[2].style.borderStyle = "solid";
    		return;
	}
	td[2].style.borderColor = "gray";
	var quantity = td[3].innerHTML;
	if(quantity == ""){
		td[3].style.borderColor = "red";
    		td[3].style.borderStyle = "solid";
    		return;
	}
	td[3].style.borderColor = "gray";
	var rowid = table_len + 1;
	var row = table.insertRow(table_len).outerHTML="<tr id = '"+rowid+"'><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true' ></td></tr>";
	 $.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	insertprescription: 'insertprescription', 
            	id: pid,
            	time: time,
            	disease : disease,
            	medicine : medicine,
            	dailydose : dailydose,
            	quantity : quantity
            },
	    success: function(response){
            }
         });
}


function removeappointment(id){
	var time = document.getElementById("time"+id).innerHTML;
	alert(time);
	var row=document.getElementById(id);
	row.parentNode.removeChild(row);
	 $.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	consulted: 'consulted', 
            	id: id,
            	time: time
            },
	    success: function(response){
            }
         });
}


function loadDoctor(){
	$("#contact").load( "DoctorProfile.php" );
}

function onloadpatient(){
	$("#contact").load( "PatientProfile.php" );
	$("#newpatient").hide();
}

function emergency(){
	$("#emergency").load( "Emergency.php" );
}

function emergencyDoctor(){
    var dropDown = document.getElementById("SpecialityDropdown");
    var speciality = dropDown.options[dropDown.selectedIndex].value;
    $.ajax({
            type: "POST",
            url: "PHP/modify.php",
            data: { 
            	    emergencyspecialist: speciality,
          	    emergency: 'emergency'  		
            },
	    dataType: "json",
            success: function(response){
		var len = response.length;	
                $("#DoctorDropdown").empty();
		$("#DoctorDropdown").append("<option>"+"Nothing selected"+"</option>");
                for( var i = 0; i<len; i++){                    
                    $("#DoctorDropdown").append("<option>"+response[i]+"</option>");	
                }
            }
        });
}

function emergencyApt(){
	var name = document.getElementById("newname").value;
	if(name == ""){
		$("#newname").addClass("redborder");
    		return;
	}
	var age = document.getElementById("newage").value;
	if(age == ""){
		$("#newage").addClass("redborder");
    		return;
	}
	var address = document.getElementById("newaddress").value;
	if(address == ""){
		$("#newaddress").addClass("redborder");
    		return;
	}
	var email = document.getElementById("newemail").value;	
	if(email == ""){
		$("#newemail").addClass("redborder");
    		return;
	}
	
	var dropDown = document.getElementById("DoctorDropdown");
    	var doctor = dropDown.options[dropDown.selectedIndex].value;
	
	$.ajax({
	    type: "POST",
	    url: "PHP/modify.php",
	    data: { 
		EmergencyPatient: 'EmergencyPatient',
		name : name,
		age : age,
		address : address,
		email : email,
		doctor : doctor
	  },
	  success: function(response){
		  alert("Appointment placed successfully");
	  }
	});

}

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#myimage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
    
        }
}


function update(id, flag){
	var name = document.getElementById("name").value;
	var age = document.getElementById("age").value;
	var address = document.getElementById("address").value;
	var email = document.getElementById("email").value;
	var password = 112;
	$.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	updateProfile: 'updateProfile', 
            	id: id,
            	flag: flag,
            	name: name,
            	age: age,
            	address: address,
            	email: email,
            	password: password
            },
	    success: function(response){
	    	alert("Uploaded Successfully");
            }
         });
}

function updateimage(){//NOT WORKING
	window.location = "doctor.php"
	$("#contact").load( "DoctorProfile.php" );
}

function showprescription(id){
	$.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	showprescription: 'showprescription',
            	id: id
            },
            dataType: "json",
	    success: function(response){
	    	var len = response.length;
                var table = document.getElementById("prescription");
                var table_len=(table.rows.length);
                
                var i = 0;
                var k = 0;
                len = len / 4;
                while(i < len){
                	var j;
                	var row = table.insertRow(table_len);
                	for(j = 0; j < 4; j++){
                		row.insertCell(j).innerHTML = response[k];
                		k++;	
                	} 
                	table_len++;
                	i++;               
                }
                
            }
         });

}

function continueapt(id, pid){
	$.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	continueapt: 'continueapt',
            	id: id,
            	pid: pid
            },
	    success: function(response){
	    	alert(response);
            }
         });
}

function cancel(id){
	var tr = document.getElementById(id);
	var td = tr.getElementsByTagName("td");
	var name = td[0].innerHTML;
	var time = td[1].innerHTML;
	var date = td[2].innerHTML;
	var row=document.getElementById(id);
	row.parentNode.removeChild(row);
	$.ajax({
	    type: "POST",
            url: "PHP/modify.php",
            data: {
            	cancel: 'cancelapt',
            	id: id,
            	name: name,
            	time: time,
            	date: date
            },
	    success: function(response){
	    	alert("Your appointment has been canceled successfully!!");
            }
         });
}




