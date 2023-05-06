<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/change_password.css">
  </head>
  <body>
    <?php include 'connection.php';

    if(isset($_POST['submit'])){
      $PID = $_POST["PID"];
    $currentpassword = $_POST["currentpassword"];
    $newpassword = $_POST["newpassword"];
    $conpassword = $_POST["conpassword"];

    $query1 = mysqli_query($con, "SELECT password FROM registration WHERE PID ='$PID' AND password='$currentpassword'");
    $query2 = mysqli_query($con, "SELECT passwords FROM staff WHERE PID='$PID' AND passwords='$currentpassword'");
    $num1 = mysqli_fetch_array($query1);
    $num2 = mysqli_fetch_array($query2);
    
    if($num1 > 0){
      
      $conn = mysqli_query($con," UPDATE registration SET password='$newpassword' WHERE PID ='$PID'");
      $_SESSION['msg1'] = "Password changed successfully";

     }else if ($num2 > 0){
      
      $conn = mysqli_query($con, "UPDATE staff SET  passwords ='$newpassword', conpassword='$newpassword' WHERE PID ='$PID'");
      $_SESSION['msg1'] = "Password changed successfully";

    }else {
      $_SESSION['msg1']= "Password doesnt match";
    }

    }
    



    ?>

    <p style="color:red;"><?php echo $_SESSION['msg1'];  ?><?php echo $_SESSION['msg1'] =""; ?></p>
    <div class="change-password-box">
      <div class="logo"><img src="css/images/logo2.png" class="avatar" width="100" height="100" ></div>
      <div class="name"><h1>Hospital Information System</h1></div>
      <div class="change-password-form">
        <h2>Change Password</h2>
        <form method="POST">
        <div class="form-group">
            <label for="PID">PID</label>
            <input type="PID" id="PID" name="PID" required>
          </div>
          <div class="form-group">
            <label for="currentpassword">Current Password</label>
            <input type="password" id="currentpassword" name="currentpassword" required>
          </div>
          <div class="form-group">
            <label for="newpassword">New Password</label>
            <input type="password" id="newpassword" name="newpassword" required>
          </div>
          <div class="form-group">
            <label for="conpassword">Confirm Password</label>
            <input type="password" id="conpassword" name="conpassword" required>
          </div>
          <button type="submit" name="submit">Submit</button>
        </form>
        <div class="form-group">
          <p>Back to <a href="home_page.html">Home Page</a></p>
        </div>
      </div>
    </div>
  </body>
</html>
