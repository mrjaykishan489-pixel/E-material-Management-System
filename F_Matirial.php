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
    <link rel="stylesheet" href="css_all/F_css/dashboard.css">
    <link rel="stylesheet" href="include/Sidebar-Header.css">

    <link rel="stylesheet" href="include/profile-card.css">
</head>

<body>


    <?php include_once('include/header.php'); ?>


    <?php include_once('include/sidebar.php'); ?>




    <!-- Main Content -->
    <div class="main">
        <div class="box-container">
            <!-- Add Material Form -->
            <div class="addmaterial">
                <h1>Add Material</h1>
                <form>
                    <label for="file1">Choose File:</label>
                    <input type="file" id="file1" name="file"><br>

                    <label for="filename1">File Name:</label>
                    <input type="text" id="filename1" name="filename"><br>

                    <label for="semester1">Choose Semester:</label>
                    <select name="semester" id="semester1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select><br>

                    <label for="subject1">Choose Subject:</label>
                    <select name="subject" id="subject1">
                        <option value="maths">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="chemistry">Chemistry</option>
                        <option value="cs">Computer Science</option>
                    </select><br>

                    <button type="submit">ADD</button>
                </form>
            </div>

            <div class="show-matirial">
                <form>
                    <select name="semester" id="semester">
                        <option value="" disabled selected>Choose Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                    </select>

                    <select name="subject" id="subject">
                        <option value="" disabled selected>Choose Subject</option>
                        <option value="maths">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="chemistry">Chemistry</option>
                        <option value="cs">Computer Science</option>
                    </select>

                    <button type="button">Search</button>

                    <hr>
                    <div class="scroll-matirial">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>Subject Name</th>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Semester 1</td>
                                    <td>Mathematics</td>
                                    <td>Algebra Basics</td>
                                    <td>1.2 MB</td>
                                    <td>2025-01-11 12:30 PM</td>
                                    <td>
                                        <a href="#">View</a>
                                        <a href="#">Delete</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
        </div>

    </div>

</body>

</html>
<?php } ?>