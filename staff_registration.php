<?php
include 'connection.php';
if(isset($_POST['submit'])){
  $PID = mysqli_real_escape_string($con,$_POST['PID']);
  $firstname = mysqli_real_escape_string($con,$_POST['firstname']);
  $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
  $phone = mysqli_real_escape_string($con,$_POST['phone']);
  $gender = mysqli_real_escape_string($con,$_POST['gender']);
  $birthdate = mysqli_real_escape_string($con,$_POST['birthdate']);
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $department = mysqli_real_escape_string($con,$_POST['department']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $conpassword = mysqli_real_escape_string($con,$_POST['conpassword']);
  $qualifications = mysqli_real_escape_string($con,$_POST['qualifications']);
  $address = mysqli_real_escape_string($con,$_POST['address']);
  $q = mysqli_query($con, "SELECT * FROM staff WHERE PID = '$PID' or email ='$email'");
  if(mysqli_num_rows($q) > 0 ){
    echo 
    "<script> alert('ID of email has already taken'); </script>";
  }
  else{
    if($password == $conpassword){
      $query="INSERT INTO staff VALUES('','$PID','$firstname','$lastname','$phone','$gender','$birthdate','$email','$department','$password','$conpassword','$qualifications','$address')";
      mysqli_query($con,$query);
      echo 
      "<script> alert('Rigstration success'); </script>";
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
	<title>Hospital Link Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/staff_registration.css">
</head>
<body>
   <div class="logo">	<img src="css/images/logo.png" alt="Hospital Link Logo" width="100" height="100" > </div>
   <div class="h1"> <h1>Hospital Information System</h1> </div>
        
	<div class="container">
	<div class="staff_reg"> <h1>Staff Registration</h1>  </div>
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

			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>

            <label for="department">Department:</label>
			<select id="department" name="department">
				<option value="Administrator">Administrator</option>
                <option value="staff">Staff</option>
                <option value="IT">IT</option>
                <option value="accountant">Accountant</option>
			</select>

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>

			<label for="conpassword">Confirm Password:</label>
			<input type="password" id="conpassword" name="conpassword" required>

			<label for="qualifications">Qualifications:</label>
			<input type="text" id="qualifications" name="qualifications" >
			

			<label for="address">Address:</label>
			<textarea id="address" name="address" required></textarea>

			<input type="submit" name="submit" value="Register">

            <div class="signin">
                <p>Already have an account? <a href="login.html">Sign in</a></p>
              </div>

		</form>
	</div>
</body>
</html>

