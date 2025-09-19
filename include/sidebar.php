<?php
session_start();
error_reporting(0);
include('dbcon.php');
?>
<div class="navcontainer">
<div class="nav-option option1">
      <a class="nav1" href="Dashboard.php">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">   
        <h3> Dashboard</h3>
      </a>
    </div>
  <!-- Admin can see all options -->
  <?php if ($_SESSION['role'] == 'Admin') { ?>
    <!-- <div class="nav-option option1">
      <a class="nav1" href="Dashbord.php">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">   
        <h3> Dashboard</h3>
      </a>
    </div> -->

    <div class="option2 nav-option">
      <a href="A_material.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png" class="nav-img" alt="articles">
        <h3> Material</h3>
      </a>
    </div>

    <div class="nav-option option3">
      <a href="A_Faculty.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png" class="nav-img" alt="report">
        <h3> Faculty</h3>
      </a>
    </div>

    <div class="nav-option option4">
      <a href="A_Student.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png" class="nav-img" alt="institution">
        <h3> Student</h3>
      </a>
    </div>

  <?php } ?>

  <!-- Faculty should not see the Faculty page, but see the rest -->
  <?php if ($_SESSION['role'] == 'Faculty') { ?>
    <!-- <div class="nav-option option1">
      <a class="nav1" href="F_Dashbord.php">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">   
        <h3> Dashboard</h3>
      </a>
    </div> -->

    <div class="option2 nav-option">
      <a href="F_Matirial.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png" class="nav-img" alt="articles">
        <h3> Material</h3>
      </a>
    </div>

    <div class="nav-option option4">
      <a href="F_Student.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png" class="nav-img" alt="institution">
        <h3> Student</h3>
      </a>
    </div>
  <?php } ?>

  <!-- Student should only see the Material page and the Student page -->
  <?php if ($_SESSION['role'] == 'Student') { ?>
    <div class="nav-option option2 nav-option">
      <a href="
      S_Material.php" class="nav1">
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png" class="nav-img" alt="articles">
        <h3> Material</h3>
      </a>
    </div>

  <?php } ?>

  <!-- Logout option visible for all users -->
  <div class="nav-option logout">
    <a href="logout.php" class="nav1">
      <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img" alt="logout">
      <h3>Logout</h3>
    </a>
  </div>
</div>
