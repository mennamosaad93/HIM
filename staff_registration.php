<?php
// include 'connection.php';
include 'connect2.php';
if (isset($_POST['submit'])) {
  $PID = mysqli_real_escape_string($conn, $_POST['PID']);
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $department = mysqli_real_escape_string($conn, $_POST['department']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $conpassword = mysqli_real_escape_string($conn, $_POST['conpassword']);
  $qualifications = mysqli_real_escape_string($conn, $_POST['qualifications']);
  $salary = mysqli_real_escape_string($conn, $_POST['salary']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $q = mysqli_query($conn, "SELECT * FROM employee WHERE PID = '$PID' or emaill ='$email'");
  if (mysqli_num_rows($q) > 0) {
    echo
    "<script> alert('ID of email has already taken'); </script>";
  } else {
    if ($password == $conpassword) {
      
      $query = "INSERT INTO employee VALUES('$PID','$firstname','$lastname','$phone','$gender','$birthdate','$email','$department','$password','$conpassword','$qualifications','$salary','$address')";
      mysqli_query($conn, $query);
      if ($query > 0) {
       if($department == 'Admin'){
        $query1 = "INSERT INTO administrator VALUES('','$firstname','$email','$PID')";
        mysqli_query($conn, $query1);
       }elseif($department == 'accountant'){
        $query2 = "INSERT INTO accountant VALUES('','$firstname','$email','$PID')";
        mysqli_query($conn, $query2);
       }elseif($department == 'doctor'){
        $query3 = "INSERT INTO doctor VALUES('','$firstname','$email','$PID')";
        mysqli_query($conn, $query3);
       }elseif($department == 'nurse'){
        $query4 = "INSERT INTO nurse VALUES('','$firstname','$email','$PID')";
        mysqli_query($conn, $query4);
       }
      }
      echo
      "<script> alert('Rigstration success'); </script>";
    } else {
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

  <title>Hospital Link Registration</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/staff_registration.css">
</head>

<body>
  <div class="logo"> <img src="css/images/logo2.png" alt="Hospital Link Logo" width="100" height="100"> </div>
  <div class="h1">
    <h1>Hospital Information System</h1>
  </div>

  <div class="container">
    <div class="staff_reg">
      <h1>Staff Registration</h1>
    </div>
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
        <option value="Admin">Admin</option>
        <option value="doctor">Doctor</option>
        <option value="nurse">Nurse</option>
        <option value="accountant">Accountant</option>
      </select>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="conpassword">Confirm Password:</label>
      <input type="password" id="conpassword" name="conpassword" required>

      <label for="qualifications">Qualifications:</label>
      <input type="text" id="qualifications" name="qualifications">


      <label for="salary">Salary:</label>
      <input type="number" id="salary" name="salary">


      <label for="address">Address:</label>
      <textarea id="address" name="address" required></textarea>

      <input type="submit" name="submit" value="Register">

      <div class="signin">
        <p>Already have an account? <a href="login.php">Sign in</a></p>
      </div>

    </form>
  </div>
</body>

</html>