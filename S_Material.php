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


  <link rel="stylesheet" href="css_all/s_css/style.css">
  <link rel="stylesheet" href="include/Sidebar-header.css">
  <link rel="stylesheet" href="include/profile-card.css">


</head>

<body>

  <?php include_once('include/header.php'); ?>
  <?php include_once('include/sidebar.php'); ?>


  <div class="main">

    <div class="show-matirial">
      <form>
      <select name="sem" required>
                    <option value="" disabled selected>Select your Semester</option>
                    <?php
                    $sq1 = "SELECT * FROM sem_master;";
                    $q1 = mysqli_query($con, $sq1);

                    while ($rows = mysqli_fetch_assoc($q1)) { ?>
                        <option value="<?php echo $rows['sem_id'] ?>"> <?php echo $rows['sem_no'] ?> </option>

                    <?php } ?>

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

        <div class="show-pdf">
          <table>
            <tr>
              <td><img src="file.png"></td>
              <td>AWP Chepter-1.pdf</td>
              <td>3.7Mb</td>
              <td>
                <a href="#" data-file="AWP Chepter-1.pdf" class="view-pdf">View</a>
              </td>
            </tr>
            <tr>
              <td><img src="file.png"></td>
              <td>AWP Chepter-2.pdf</td>
              <td>4.2Mb</td>
              <td>
                <a href="#" data-file="AWP Chepter-2.pdf" class="view-pdf">View</a>
              </td>
            </tr>
          </table>
        </div>

        <div id="pdfModal">
          <div id="pdfModal-content">
            <h2 id="pdfTitle">PDF Viewer</h2>
            <iframe id="pdfFrame" width="100%" height="500px"></iframe>
            <button id="closeModal">Close</button>
          </div>
        </div>

      </form>
    </div>
</body>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const viewLinks = document.querySelectorAll('.view-pdf');
    const pdfModal = document.getElementById('pdfModal');
    const pdfFrame = document.getElementById('pdfFrame');
    const pdfTitle = document.getElementById('pdfTitle');
    const closeModal = document.getElementById('closeModal');

    viewLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const fileName = this.getAttribute('data-file');

        // In a real scenario, replace with actual PDF path
        const pdfPath = `pdfs/${fileName}`;

        pdfTitle.textContent = fileName;
        pdfFrame.src = pdfPath;
        pdfModal.style.display = 'block';
      });
    });

    closeModal.addEventListener('click', function() {
      pdfModal.style.display = 'none';
      pdfFrame.src = '';
    });

    // Close modal if clicking outside the content
    pdfModal.addEventListener('click', function(e) {
      if (e.target === pdfModal) {
        pdfModal.style.display = 'none';
        pdfFrame.src = '';
      }
    });
  });
</script>

</html>
<?php } ?>