<?php
session_start();
include('dbcon.php');
$msg='';
if(isset($_POST['submit']))
{
    // get email from session
    $email=$_SESSION['mail'];
    $name=$_SESSION['name'];
    $e_no=$_SESSION['e_no'];
    $dep=$_SESSION['dep'];
    $sem=$_SESSION['sem'];
    $phone=$_SESSION['phone'];
    $f_pass=$_SESSION['f_pass'];
    // opt get from user
    $us_otp=$_POST['us_otp'];
    
    $sq1="SELECT otp from otp_master WHERE email_id ='$email'";
    $q1=mysqli_query($con,$sq1);
    $rows=mysqli_fetch_array($q1);
    // fatch otp form db
    $otp = $rows['otp'];
    
    if($otp == $us_otp)
    {
        $sql = "INSERT INTO Student_master (name, email_id, e_no, phone_no, de_id,sem_id,password) VALUES('$name','$email','$e_no','$phone','$dep','$sem','$f_pass');";
        $q1 = mysqli_query($con, $sql);
        if($q1)
        {

            $q2="UPDATE otp_master SET otp='',status='ACTIVE' WHERE email_id='$email'";
            $result=mysqli_query($con,$q2);
            if($result)
            {
                unset($_SESSION['name']);
                unset($_SESSION['f_pass']);
                unset($_SESSION['dep']);
                unset($_SESSION['sem']);
                unset($_SESSION['e_no']);
                unset($_SESSION['phone']);
                header('location:index.php');
            }
            
        }
        
    }
    else if($otp != $us_otp){
        $msg="OTP is Incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Varification</title>
    <link rel="stylesheet" href="css_all/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>OTP Verification</h2>
            <form action ="Otpverify.php" method="POST">
            <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
																					echo $msg;
																				}  ?> </p>
                <input type="number" placeholder="Enter your OTP" name="us_otp" maxlength="6" required>
                <button type="sub" id="btnforget" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
