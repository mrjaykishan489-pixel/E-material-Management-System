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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> </title>
  <link rel="stylesheet" href="include/Sidebar-Header.css">
  
  <link rel="stylesheet" href="include/profile-card.css">

  
</head>

<body>
    
  <?php include_once('include/header.php'); ?>
  <?php include_once('include/sidebar.php'); ?>
  


  <script src="index.js"></script>
</body>

</html>
<?php } ?>