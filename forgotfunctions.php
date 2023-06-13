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
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

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
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hussienelassy040@gmail.com', 'Admin');
    $mail->addAddress($email);

    $code = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'),0,10);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset';
    $mail->Body    = 'to reset ur password click <a href="http://localhost/HIM/HIM/change_password.php?code='.$code.'"> Here </a>. </br>Reset ur password in a day.';
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