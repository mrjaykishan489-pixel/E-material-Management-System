<?php 
session_start();
include('dbcon.php');
$msg = '';
$f_pass = '';
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $e_no = $_POST['e_no'];
    $phone = $_POST['phone'];
    $sem=$_POST['sem'];
    $dep = $_POST['dep'];
    $pass = $_POST['password'];
    $cpass = $_POST['c_password'];
    $otp= rand(000000,999999);

    // Both password match or not
    if ($pass != $cpass) {
        $msg = "Password Are not Matched";
    } else {
        // Passowrd encrypt
        $f_pass = md5($pass);


        // Check Email is Alreday or not
        $ret = mysqli_query($con, "select email_id from Student_master where email_id='$email' ");
        $result = mysqli_fetch_array($ret); 
        if ($result > 0) {
            $msg = "This email associated with another account";
        } 
        else {
            $ret1 = mysqli_query($con, "select email_id from otp_master where email_id='$email' ");
            $result1 = mysqli_fetch_array($ret1); 
            if ($result1 > 0) {
                $ret2 = mysqli_query($con, "select email_id,otp from otp_master where email_id='$email' ");
                $result2 = mysqli_fetch_array($ret2);


                // $sql = "INSERT INTO Student_master (name, email_id, e_no, phone_no, dep,sem,password) VALUES('$name', '$email', '$e_no', '$phone', '$dep','$sem','$f_pass');";
                // $q1 = mysqli_query($con, $sql);
                if ($result2) {
                    $msg = "You have successfully registered";
                    $_SESSION['mail'] = $email;
                    $_SESSION['f_otp'] = $result2['otp'];
                    $_SESSION['f_pass'] = $f_pass;
                    $_SESSION['name'] = $name;
                    $_SESSION['e_no'] = $e_no;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['dep'] = $dep;
                    $_SESSION['sem'] = $sem;
                    header('location:Email_send/index.php');
                } else {
                    $msg = "Something Went Wrong. Please try again";
                }
            } 
            else {
                $ret3 = mysqli_query($con, "INSERT INTO otp_master (email_id,otp) VALUES('$email','$otp')");
                if($ret3)
                {
                    // $sql = "INSERT INTO Student_master (name, email_id, e_no, phone_no, dep,sem,password) VALUES('$name', '$email', '$e_no', '$phone', '$dep','$sem','$f_pass');";
                    // $q1 = mysqli_query($con, $sql);
                    $msg = "You have successfully registered";
                    $_SESSION['mail'] = $email;
                    $_SESSION['f_otp'] = $otp;
                    
                    $_SESSION['mail'] = $email;
                    // $_SESSION['f_otp'] = $result2['otp'];
                    $_SESSION['f_pass'] = $f_pass;
                    $_SESSION['name'] = $name;
                    $_SESSION['e_no'] = $e_no;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['dep'] = $dep;
                    $_SESSION['sem'] = $sem;
                    header('location:Email_send/index.php');
                    }else {
                        $msg = "Something Went Wrong. Please try again";
                }
            }
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css_all/styles.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</head>

<body>
    <div class="container">
        <div class="form-box">
            <h2>Registration</h2>
            <form action="" method="POST">
                <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                            echo $msg;
                                                                        }  ?> </p>
                <input type="text" placeholder="Enter your name" name="name" required>
                <input type="email" placeholder="Enter your email" name="email" required>
                <input type="number" placeholder="Enter your Enrollment No." name="e_no" required>
                <input type="tel" placeholder="Enter your phone no." name="phone" pattern="\d{10}" maxlength="10" minlength="10" required>
                <select name="sem" required>
                    <option value="" disabled selected>Select your Semester</option>
                    <?php
                    $sq1 = "SELECT * FROM sem_master;";
                    $q1 = mysqli_query($con, $sq1);

                    while ($rows = mysqli_fetch_assoc($q1)) { ?>
                        <option value="<?php echo $rows['sem_id'] ?>"> <?php echo $rows['sem_no'] ?> </option>

                    <?php } ?>

                </select>
                <select name="dep" required>
                    <option value="" disabled selected>Select your Department</option>
                    <?php
                    $sq2 = "SELECT * FROM department;";
                    $q2 = mysqli_query($con, $sq2);

                    while ($rows = mysqli_fetch_assoc($q2)) { ?>
                        <option value="<?php echo $rows['de_id'] ?>"> <?php echo $rows['de_name'] ?> </option>

                    <?php } ?>

                </select>
                <!-- <select id="State" name="state" required>
                    <option value="">Select state</option>

                </select>
                <select id="City" name="city" required>
                    <option value="">Select City</option>
                </select> -->
                <input type="password" placeholder="Create password" name="password" required>
                <input type="password" placeholder="Confirm password" name="c_password" required><br>
                <input type="checkbox" name="terms" id="condition" required>
                <label for="condition">I accept all terms & condition</label>
                <button type="submit" name="sub">Register Now</button>
            </form>
            <p>Already have an account? <a href="index.php">Login now</a></p>
        </div>
    </div>
    

    <!-- For load City data depend on state are select -->
    <!-- <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type, cate_id) {
                $.ajax({
                    url: "load_s.php",
                    type: "POST",
                    data: {
                        type: type,
                        id: cate_id
                    },
                    success: function(data) {
                        if (type == "citydata") {
                            $("#City").html(data);
                        } else {
                            $("#State").append(data);
                        }

                    }

                });
            }
            loadData();
            $('#State').on("change", function() {
                var state = $("#State").val();

                loadData("citydata", state);
            })
        });
    </script> -->
</body>

</html>