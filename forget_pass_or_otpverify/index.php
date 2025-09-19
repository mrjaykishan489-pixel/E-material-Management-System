<?php
session_start();
include('../dbcon.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Get email from session
$user_email = $_SESSION['email_f'];
// $otp_f = $rows['otp_f'];
$sq1 = "SELECT otp from otp_master WHERE email_id = '$user_email'";
$q1 = mysqli_query($con, $sq1);
$rows1 = mysqli_fetch_assoc($q1);


try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'gps749089@gmail.com';                     //SMTP username
    $mail->Password   = 'ibfvliphdpvzjces';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gps749089@gmail.com', 'VVP_Material');
    $mail->addAddress($user_email, 'Joe User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forget Password Otp';
    $mail->Body    = 'One time password <h1>' . $rows1['otp'] . '</h1> Your PassWord Send after Verify Successfully.<br>In Your Register Email';

    $mail->send();
    header('Location: ../Otpverify_forgetpass.php');
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
