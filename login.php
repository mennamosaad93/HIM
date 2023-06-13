<?php
include 'connect2.php';
session_start();
    if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Result = mysqli_query($conn, "SELECT * FROM employee WHERE emaill='$email'" );
    $row = mysqli_fetch_array($Result);
    if(mysqli_num_rows($Result) > 0 ){
        if($password == $row["passwords"])
        {
            
            $_SESSION["login"] = true;
            if($row['department'] == 'Admin'){
                $_SESSION['admin-name'] = $row['firstname'];
                header("location: page-of-admin.php");

            }elseif($row['department'] == 'doctor'){
                $_SESSION['admin-name'] = $row['firstname'];
                header("location: page-of-doctor.php");

            }elseif($row['department'] == 'nurse'){
                $_SESSION['admin-name'] = $row['firstname'];
                header("location: page-of-nurse.php");

            }elseif($row['department'] == 'accountant'){
                $_SESSION['admin-name'] = $row['firstname'];
                header("location: page-of-accountant.php");
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
        <div class="logo"><img src="css/images/logo2.png" class="avatar" width="100" height="100"></div>
        <div class="hl">
            <h1>Hospital Information System</h1>
        </div>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <p>email</p>
            <input type="text" name="email" placeholder="Enter your email" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="submit" name="submit" value="Login">
        </form>
        <a href="Forgot_Password.php">Forgot Password?</a> | <a href="staff_registration.php">Create an Account</a>
    </div>
</body>

</html>