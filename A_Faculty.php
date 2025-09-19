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
  <link rel="stylesheet" href="css_all/a_css/A_Faculty.css">
  <link rel="stylesheet" href="include/Sidebar-Header.css">
    
  <link rel="stylesheet" href="include/profile-card.css">

  
</head>

<body>
    
  <?php include_once('include/header.php'); ?>
  <?php include_once('include/sidebar.php'); ?>
  

    <div class="main">
      <div class="box-container">
        <div class="addmaterial">
          <h2>ADD Faculty</h2>
          <form>
            <input type="text" placeholder="Enter your name" required>
            <input type="email" placeholder="Enter your email" required>
            <input type="tel" placeholder="Enter your number" required>

            <select name="dep" required>
                    <option value="" disabled selected>Select your Department</option>
                    <?php
                    $sq2 = "SELECT * FROM department;";
                    $q2 = mysqli_query($con, $sq2);

                    while ($rows = mysqli_fetch_assoc($q2)) { ?>
                        <option value="<?php echo $rows['de_id'] ?>"> <?php echo $rows['de_name'] ?> </option>

                    <?php } ?>

            </select>

            <label for="assignments">Assign Subjects</label>
            <div id="assignments">
              <div class="assignment-group">
                <select name="semester" required>
                  <option value="" disabled selected>Select semester</option>
                </select>
                <select name="subject" required>
                  <option value="" disabled selected>Select subject</option>
                </select>
              </div>
            </div>
            
            <div id="assignments">
              <div class="assignment-group">
                <select name="semester2" required>
                  <option value="" disabled selected>Select semester</option>
                </select>
                <select name="subject2" required>
                  <option value="" disabled selected>Select subject</option>
                </select>
              </div>
            </div>
            
            <div id="assignments">
              <div class="assignment-group">
                <select name="semester3" required>
                  <option value="" disabled selected>Select semester</option>
                </select>
                <select name="subject3" required>
                  <option value="" disabled selected>Select subject</option>
                </select>
              </div>
            </div>

            <button type="submit">Submit</button>
          </form>
        </div>

        <!-- Faculty Details Table -->
        <div class="faculty-table">
          <h2>Faculty Details</h2>
          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Faculty Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Semester 1</th>
                  <th>Subject 1</th>
                  <th>Semester 2</th>
                  <th>Subject 2</th>
                  <th>Semester 3</th>
                  <th>Subject 3</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>John Doe</td>
                  <td>john.doe@example.com</td>
                  <td>1234567890</td>
                  <td>1st Semester</td>
                  <td>Mathematics</td>
                  <td>3rd Semester</td>
                  <td>Physics</td>
                  <td>5th Semester</td>
                  <td>Programming</td>
                  <td>
                    <button class="btn-update">Update</button>
                    <button class="btn-delete">Delete</button>
                  </td>
                </tr>
                

                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
      </div>





    </div>
  </div>

  <script>
   $(document).ready(function () {
    // Load Departments from Database
    $.ajax({
        url: 'fetch_data.php',
        type: 'POST',
        data: { action: 'get_departments' },
        success: function (response) {
            $('#dep').append(response);
        }
    });

    // Populate Semesters (Fixed 1-8 for all departments)
    for (let i = 1; i <= 8; i++) {
        $('#semester').append(`<option value="${i}">Semester ${i}</option>`);
    }

    // Load Subjects When Both Department & Semester Are Selected
    $('#dep, #semester').change(function () {
        var dept_id = $('#dep').val();
        var sem_id = $('#semester').val();

        $('#subject').html('<option value="" disabled selected>Select subject</option>');

        if (dept_id && sem_id) {
            $.ajax({
                url: 'fetch_data.php',
                type: 'POST',
                data: { action: 'get_subjects', department_id: dept_id, semester_id: sem_id },
                success: function (response) {
                    $('#subject').append(response);
                }
            });
        }
    });
});

function validatePasswords() {
    var pass = document.getElementById("pass").value;
    var cpass = document.getElementById("cpass").value;

    var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (pass !== cpass) { 
        alert("Passwords do not match!");
        return false;
    }

    if (!passwordPattern.test(pass)) {
        alert("Password must be at least 8 characters, with 1 uppercase, 1 number, and 1 special character.");
        return false;
    }

    return true;
}


  </script>
</body>

</html>
<?php } ?>