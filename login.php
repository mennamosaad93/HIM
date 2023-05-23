<?php
include 'connection.php';
session_start();
    if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Result = mysqli_query($con, "SELECT * FROM staff WHERE emaill='$email'" );
    $row = mysqli_fetch_array($Result);
    if(mysqli_num_rows($Result) > 0 ){
        if($password == $row["passwords"])
        {
            
            $_SESSION["login"] = true;
            if($row['department'] == 'Admin'){
                header("location: page-of-admin.html");

            }elseif($row['department'] == 'Doctor'){
                header("location: page-of-doctor.html");

            }elseif($row['department'] == 'Nurse'){
                header("location: page-of-nurse.html");

            }elseif($row['department'] == 'accountant'){
                header("location: page-of-accountant.html");
            }
            
            
            
        }
        else{
            echo 
    "<script> alert('Wrong Password'); </script>"; 
        }
    }
    else{
        echo 
    "<script> alert('User Not Rigstered'); </script>"; 
    }
    }
?>



<!DOCTYPE html>
<html>
<head>
	<title>Hospital Information System- Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="login-box">
        <div class="logo"><img src="css/images/logo2.png" class="avatar" width="100" height="100" ></div>
		<div class="hl"><h1>Hospital Information System</h1></div>
        <h2>Login</h2>
		<form action="login.php" method="POST">
			<p>email</p>
			<input type="text" name="email" placeholder="Enter your email" required>
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter password" required>
			<input type="submit" name="submit" value="Login">
		</form>
		<a href="Forgot_Password.html">Forgot Password?</a> | <a href="staff_registration.html">Create an Account</a>
	</div>
</body>
</html>
