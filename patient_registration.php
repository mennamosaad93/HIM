<?php
include 'connection.php';
include 'connect2.php';
if(isset($_POST['submit'])){
  $PID = mysqli_real_escape_string($conn,$_POST['PID']);
  $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
  $phone = mysqli_real_escape_string($conn,$_POST['phone']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $case = mysqli_real_escape_string($conn,$_POST['case']);
  $meds_on = mysqli_real_escape_string($conn,$_POST['meds_on']);
  $birthdate = mysqli_real_escape_string($conn,$_POST['birthdate']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
//   $password = mysqli_real_escape_string($conn,$_POST['password']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $room = mysqli_real_escape_string($conn,$_POST['room']);
  $q = mysqli_query($conn, "SELECT * FROM  patient WHERE PID ='$PID' OR email ='$email'");
  if(mysqli_num_rows($q) > 0 ){
    echo 
    "<script> alert('ID of email has already taken'); </script>";
  }
  // ('$PID','$firstname','$lastname','$phone','$gender','$birthdate','$email','$address')
  else{
    if($PID != $phone){
      $query="INSERT INTO patient VALUES('$PID','$firstname','$lastname','$phone','$age','$gender','$birthdate','$email','$case','$meds_on','$room','$address')";
      mysqli_query($conn,$query);
      // if($query > 0){
      //   $query2="INSERT INTO him.registration VALUES('$PID','$firstname' .'$lastname','$phone','$gender','$birthdate','$email','$address')";
       
      //   mysqli_query($conn,$query2); 
      // }
      
      echo
      "<script> alert('Registration success'); </script>";
    }
    else{
      echo 
      "<script> alert('Something is wrong'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="Website Icon" href="css/images/logo2.png" type="png" >

	<title>Hospital Management System Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/patient_registration.css">
</head>
<body>
	<div class="logo">	<img src="css/images/logo2.png" alt="Hospital Link Logo" width="100" height="100" > </div>
    <div class="h1"> <h1>Hospital Information System</h1> </div>
	         
	<div class="container">
	<div class="patient_reg">  <h1>Patient Registration</h1>  </div>	
		<form action="#" method="POST">
			
			<label for="firstname">First Name:</label>
			<input type="text" id="firstname" name="firstname" required>

			<label for="lastname">Last Name:</label>
			<input type="text" id="lastname" name="lastname" required>

			<label for="PID">ID:</label>
			<input type="text" id="PID" name="PID" required>

			<label for="phone">Phone Number:</label>
			<input type="tel" id="phone" name="phone" required>

			<label for="gender">Gender:</label>
			<select id="gender" name="gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>

			<label for="birthdate">Birthdate:</label>
			<input type="date" id="birthdate" name="birthdate" required>

            <label for="age">Age:</label>
			<input type="text" id="age" name="age" required>

			<label for="email">email:</label>
			<input type="email" id="email" name="email" required>

      <label for="room">Room:</label>
			<input type="text" id="room" name="room" required>

			<!-- <label for="password">password:</label>
			<input type="password" id="password" name="password" required> -->

			<label for="address">Address:</label>
			<textarea id="address" name="address" required></textarea>
			
			<label for="medical-history">Medical History:</label>
            <label for="case">What is your complain? Any chronic diseases?</label>
            <textarea id="case" name="case" required></textarea>
            <label for="meds_on">Any chronic meds? </label>
            <textarea id="meds_on" name="meds_on" required></textarea>

			<input type="submit" name="submit" value="Register">
              
		</form>
	</div>
</body>
</html>

