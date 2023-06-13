<?php
include "connect2.php";

if (isset($_POST['email'])) {

  $email= $_POST['email'];
  
  # code...
}else{
  exit;
  }
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hussienelassy040@gmail.com';                     //SMTP username
    $mail->Password   = 'hussienmohamedhassanelassy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hussienelassy040@gmail.com', 'Admin');
    $mail->addAddress($email);

    $code = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'),0,10);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset';
    $mail->Body    = 'to reset ur password click <a href="http://localhost/him/him/change_password.php?code='.$code.'"> Here </a>. </br>Reset ur password in a day.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $verifyQuery =  $conn->query("SELECT * FROM token WHERE emaill='$email'");

    if($verifyQuery->num_rows){
      
      $codeQuery = $conn->query("UPDATE token SET code = '$code' WHERE email='$email'");

      
      $mail->send();
      echo 'Message has been sent, check ur email address';
    }
    $conn->close();
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Hospital Management System - Forgot Password</title>
    <link rel="stylesheet" href="css/Forgot_Password.css">
</head>

<body>
    <div class="login-box">
        <!-- <div class="logo"><img src="css/images/key.jpg" class="avatar" width="190" height="200" ></div> -->
        <div class="logo"><img src="css/images/logo2.png" class="avatar" width="100" height="100"></div>
        <div class="name">
            <h1>Hospital Information System</h1>
        </div>

        <div class="login-form">
            <div class="forgot_pass">
                <h2>Forgot Password</h2>
            </div>
            <div class="logo"><img src="css/images/key.jpg" class="avatar" width="190" height="200"></div>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Please enter your email" required>
                </div>
                <button type="submit">Submit</button>
            </form>
            <div class="form-group">
                <p>Remember your password? <a href="login.php">Login here</a></p>
            </div>
        </div>
</body>

</html>