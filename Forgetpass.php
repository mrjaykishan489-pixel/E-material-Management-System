<?php
session_start();
include('dbcon.php');
$msg='';
if (isset($_POST['sub'])) {
    // enter email by user
    $email = $_POST['email'];
    $role = $_POST['role'];
    // Email register or not Check
    if("Student" == $role)
    {
        $q1 = mysqli_query($con, "select u_id from Student_master where email_id='$email';");
        $result = mysqli_fetch_array($q1);
        if ($result < 0) {   
            $msg = "Email Is Not Register";
        } else {
            $otp_f = rand(000000,999999);
            $re1 = mysqli_query($con, "INSERT INTO otp_master (email_id, otp) VALUES ('$email', '$otp_f')");
            if($re1)
            {
                $_SESSION['email_f']=$email;
                $_SESSION['otp_f']=$otp_f;
                $_SESSION['role_f']=$role;
                header('location:forget_pass_or_otpverify/index.php');
            } 
        }
    }
    else if("Admin"==$role)
    {
        $q1 = mysqli_query($con, "select Admin_id from Admin_master where email_id='$email';");
        $result = mysqli_fetch_array($q1);
        if ($result < 0) {
            $msg = "Email Is Not Register";
        } else {
            $otp_f = rand(000000,999999);
            $re1 = mysqli_query($con, "INSERT INTO otp_master (email_id, otp) VALUES ('$email', '$otp_f')");

            if($re1)
            {
                $_SESSION['email_f']=$email;
                $_SESSION['otp_f']=$otp_f;
                $_SESSION['role_f']=$role;
                header('location:forget_pass_or_otpverify/index.php');
            }
        }
    }
    else if("Faculty"== $role)
    {
        $q1 = mysqli_query($con, "select f_id from faculty_master where email_id='$email';");
        $result = mysqli_fetch_array($q1);
        if ($result < 0) {
            $msg = "Email Is Not Register";
        } else {
            $otp_f = rand(000000,999999);
            $re1 = mysqli_query($con, "INSERT INTO otp_master (email_id, otp) VALUES ('$email', '$otp_f')");
            if($re1)
            {
                $_SESSION['email_f']=$email;
                $_SESSION['otp_f']=$otp_f;
                $_SESSION['role_f']=$role;
                header('location:forget_pass_or_otpverify/index.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="css_all/styles.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h2>Forget Password</h2>
            <form action="forgetpass.php" method="POST">
                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) { echo $msg;} ?> </p>
                <input type="email" placeholder="Enter Regeister Email" name="email" required>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="Student">Student</option>
                    <option value="Admin">Admin</option>
                    <option value="Faculty">Faculty</option>
                </select>
                <button type="submit" id="btnforget" name="sub">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>