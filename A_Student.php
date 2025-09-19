<?php
session_start();
error_reporting(0);
include('dbcon.php');
if (strlen($_SESSION['emms_uid'] == 0)) {
	header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css_all/a_css/A_material_Student.css">
    <link rel="stylesheet" href="include/Sidebar-Header.css">

    <link rel="stylesheet" href="include/profile-card.css">
</head>

<body>


    <?php include_once('include/header.php'); ?>


    <?php include_once('include/sidebar.php'); ?>




    <!-- Main Content -->
    <div class="main">
        <div class="show-matirial">
            <form>
                <select name="semester" id="semester">
                    <option value="" disabled selected>Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                </select>

                <select name="semester" id="semester">
                    <option value="" disabled selected>Department</option>
                    <option value="1">IT</option>
                    <option value="2">Electrical</option>
                    <option value="3">Mechanical</option>
                    <option value="4">Civil</option>
                    <option value="5">Chemical</option>
                    <option value="6">Computer Engineering</option>
                    <option value="7">Electronics and Communication</option>
                </select>


                <button type="button">Search</button>
                <hr>

                <div class="scroll-matirial">
                    <table>
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Semester</th>
                                <th>Enrollment No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>230473116031</td>
                                <td>Dhaval Parmar</td>
                                <td>Electrical</td>
                                <td>dnparmar@gmail.com</td>
                                <td>8155050590</td>
                                <td>
                                    <a href="#">Update</a>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1</td>
                                <td>230473116031</td>
                                <td>Dhaval Parmar</td>
                                <td>Electrical</td>
                                <td>dnparmar@gmail.com</td>
                                <td>8155050590</td>
                                <td>
                                    <a href="#">Update</a>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>

    </div>

</body>

</html>
<?php } ?>