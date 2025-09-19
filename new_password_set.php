<?php


session_start();
include('dbcon.php');
$u_email=$_SESSION['email_f'];
$role=$_SESSION['role_f'];
$msg='';
if (isset($_POST['sub'])) {
    $pass = $_POST['password'];
    $cpass = $_POST['c_password'];
    if ($pass != $cpass) {
        $msg = "Password Are not Matched";
    }
    else{
        $n_pass = md5($pass);
        if("Student" == $role)
        {
            $q="UPDATE student_master set password = '$n_pass' where email_id='$u_email';" ;
            $result=mysqli_query($con,$q);
            $q1="DELETE from otp_master where email_id='$u_email';";
            $re=mysqli_query($con,$q1);
            unset($_SESSION['email_f']);
            unset($_SESSION['role_f']);
            header('location:login.php');
        }
        else if("Admin" == $role)
        {
            $q="UPDATE Admin_master set password = '$n_pass' where email_id='$u_email';" ;
            $result=mysqli_query($con,$q);
            $q1="DELETE from otp_master where email_id='$u_email';";
            $re=mysqli_query($con,$q1);
            unset($_SESSION['email_f']);
            unset($_SESSION['role_f']);
            header('location:login.php');
        }
        else if("Faculty" == $role)
        {
            $q="UPDATE Faculty_master set password = '$n_pass' where email_id='$u_email';" ;
            $result=mysqli_query($con,$q);
            $q1="DELETE from otp_master where email_id='$u_email';";
            $re=mysqli_query($con,$q1);
            unset($_SESSION['email_f']);
            unset($_SESSION['role_f']);
            header('location:login.php');
        }
    }
}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASSWORD RESET</title>
    <link rel="stylesheet" href="css_all/styles.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Password Reset</h2>
            <form action ="new_password_set.php" method="POST">
            <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
																					echo $msg;
															}  ?> </p>
                 <input type="password" placeholder="Create password" name="password" required>
                 <input type="password" placeholder="Confirm password" name="c_password" required><br>
                <button type="sub" id="btnforget" name="sub">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
