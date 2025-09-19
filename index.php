<?php
session_start();
include('dbcon.php');
$msg = '';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $role=$_POST['role'];
    if("Student" == $role)
    {
        $q1 = mysqli_query($con, "select u_id from Student_master where email_id='$email' && password ='$pass';");
        $result = mysqli_fetch_array($q1);
        if ($result > 0) {
            $_SESSION['emms_uid'] = $result['u_id'];
            $_SESSION['role'] = $role;
            header('location:Dashboard.php');
        } else {
            $msg = "Invalid Details.";
        }
    }
    else if("Admin"==$role)
    {
        
        $q1 = mysqli_query($con, "select Admin_id from Admin_master where email_id='$email' && password ='$pass';");
        $result = mysqli_fetch_array($q1);
        if ($result > 0) {
            $_SESSION['emms_uid'] = $result['Admin_id'];
            $_SESSION['role'] = $role;
            header('location:Dashboard.php');
        } else {
            $msg = "Invalid Details.";
        }
    }
    else if("Faculty" == $role)
    {
        
        $q1 = mysqli_query($con, "select f_id from faculty_master where email_id='$email' && password ='$pass';");
        $result = mysqli_fetch_array($q1);
        if ($result > 0) {
            $_SESSION['emms_uid'] = $result['f_id'];
            $_SESSION['role'] = $role;
            header('location:Dashboard.php');
        } else {
            $msg = "Invalid Details.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css_all/styles.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                            echo $msg;
                                                                        }  ?> </p>
                <input type="email" placeholder="Enter your email" name="email" required>
                <input type="password" placeholder="Enter your password" name="password" required>
                <select name="role">
                    <option value="">Select Role</option>
                    <option value="Student">Student</option>
                    <option value="Admin">Admin</option>
                    <option value="Faculty">Faculty</option>
                    
                </select>
                <div class="options">
                    <a href="Forgetpass.php">Forgot Password</a>
                    <!-- <a href="Forgetpass.php">& Otp verify</a> -->
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
            <p>If you are new here? <a href="register.php">Register now</a></p>
        </div>
    </div>
</body>

</html> 