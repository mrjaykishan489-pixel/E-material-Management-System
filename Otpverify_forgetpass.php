<?php
$msg='';
session_start();
include('dbcon.php');
$msg='';
if(isset($_POST['sub']))
{
    // get email from session
    $u_email_f=$_SESSION['email_f'];
    // otp get from user
    $us_otp_f=$_POST['us_otp_f'];
    
    $sq1="SELECT otp from otp_master WHERE email_id ='$u_email_f'";
    $q1=mysqli_query($con,$sq1);
    $rows=mysqli_fetch_array($q1);
    // fatch otp form db
    $otp_f = $rows['otp'];
    
    if($otp_f == $us_otp_f)
    {
        header('location:new_password_set.php');
    }
    else if($otp_f != $us_otp_f){
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
            <h2>OTP Verification Forget</h2>
            <form action ="Otpverify_forgetpass.php" method="POST">
            <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
																					echo $msg;
															}  ?> </p>
                <input type="number" placeholder="Enter your OTP" name="us_otp_f" maxlength="6" required>
                <button type="sub" id="btnforget" name="sub">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
