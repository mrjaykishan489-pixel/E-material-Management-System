<?php
session_start();
include("dbcon.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// AJAX handler
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'get_subjects' && isset($_POST['de_id'], $_POST['sem_id'])) {
        $de_id = intval($_POST['de_id']);
        $sem_id = intval($_POST['sem_id']);
        $res = mysqli_query($con, "SELECT sub_id, sub_name FROM subject_master WHERE de_id = $de_id AND sem_id = $sem_id");
        echo '<option value="">Choose Subject</option>';
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='{$row['sub_id']}'>{$row['sub_name']}</option>";
        }
        exit;
    }

    if ($_POST['action'] === 'get_faculty' && isset($_POST['de_id'])) {
        $de_id = intval($_POST['de_id']);
        $res = mysqli_query($con, "SELECT f_id, f_name FROM faculty_master WHERE de_id = $de_id");
        echo '<option value="">Choose Faculty</option>';
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='{$row['f_id']}'>{$row['f_name']}</option>";
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css_all/a_css/A_material_Student.css">
    <link rel="stylesheet" href="include/Sidebar-Header.css">
    <link rel="stylesheet" href="include/profile-card.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include_once('include/header.php'); ?>
<?php include_once('include/sidebar.php'); ?>

<div class="main">
    <div class="show-matirial">
        <form method="GET">
            <select name="department" id="department">
                <option value="">Choose Department</option>
                <?php
                $q = mysqli_query($con, "SELECT * FROM department");
                while ($d = mysqli_fetch_assoc($q)) {
                    $selected = ($_GET['department'] ?? '') == $d['de_id'] ? 'selected' : '';
                    echo "<option value='{$d['de_id']}' $selected>{$d['de_name']}</option>";
                }
                ?>
            </select>

            <select name="semester" id="semester">
                <option value="">Choose Semester</option>
                <?php
                $q = mysqli_query($con, "SELECT * FROM sem_master");
                while ($s = mysqli_fetch_assoc($q)) {
                    $selected = ($_GET['semester'] ?? '') == $s['sem_id'] ? 'selected' : '';
                    echo "<option value='{$s['sem_id']}' $selected>Semester {$s['sem_no']}</option>";
                }
                ?>
            </select>

            <select name="subject" id="subject">
                <option value="">Choose Subject</option>
            </select>

            <select name="faculty" id="faculty">
                <option value="">Choose Faculty</option>
            </select>

            <button type="submit" name="filter">Search</button>
            <button type="button" onclick="window.location.href=window.location.pathname">Reset</button>
            <hr>

            <div class="scroll-matirial">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File Name</th>
                            <th>Subject Name</th>
                            <th>Semester</th>
                            <th>Faculty</th>
                            <th>File Size</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch materials
                        $where = [];
                        if (isset($_GET['filter'])) {
                            if (!empty($_GET['department'])) $where[] = "s.de_id = " . intval($_GET['department']);
                            if (!empty($_GET['semester'])) $where[] = "m.sem_id = " . intval($_GET['semester']);
                            if (!empty($_GET['subject'])) $where[] = "m.sub_id = " . intval($_GET['subject']);
                            if (!empty($_GET['faculty'])) $where[] = "m.f_id = " . intval($_GET['faculty']);
                        }
                        $filter = $where ? "WHERE " . implode(" AND ", $where) : "";

                        $q = mysqli_query($con, "
                            SELECT m.*, f.f_name, s.sub_name, sem.sem_no 
                            FROM material_master m 
                            JOIN faculty_master f ON m.f_id = f.f_id 
                            JOIN subject_master s ON m.sub_id = s.sub_id 
                            JOIN sem_master sem ON m.sem_id = sem.sem_id 
                            $filter ORDER BY m.datetime DESC
                        ");

                        if (mysqli_num_rows($q) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($q)) {
                                $size = round($row['file_size'] / 1024, 2);
                                echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$row['file_name']}</td>
                                    <td>{$row['sub_name']}</td>
                                    <td>Semester {$row['sem_no']}</td>
                                    <td>{$row['f_name']}</td>
                                    <td>{$size} KB</td>
                                    <td>{$row['datetime']}</td>
                                    <td>
                                        <a href='{$row['file_path']}' target='_blank'>View</a>
                                    
                                    </td>
                                </tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>No materials found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    function loadSubjects() {
        const dept = $('#department').val();
        const sem = $('#semester').val();
        if (dept && sem) {
            $.post('', { action: 'get_subjects', de_id: dept, sem_id: sem }, function (data) {
                $('#subject').html(data);
                <?php if (!empty($_GET['subject'])): ?>
                    $('#subject').val("<?= $_GET['subject'] ?>");
                <?php endif; ?>
            });
        } else {
            $('#subject').html('<option value="">Choose Subject</option>');
        }
    }

    function loadFaculties() {
        const dept = $('#department').val();
        if (dept) {
            $.post('', { action: 'get_faculty', de_id: dept }, function (data) {
                $('#faculty').html(data);
                <?php if (!empty($_GET['faculty'])): ?>
                    $('#faculty').val("<?= $_GET['faculty'] ?>");
                <?php endif; ?>
            });
        } else {
            $('#faculty').html('<option value="">Choose Faculty</option>');
        }
    }

    $('#department').change(function () {
        loadSubjects();
        loadFaculties();
    });

    $('#semester').change(function () {
        loadSubjects();
    });

    <?php if (!empty($_GET['department']) && !empty($_GET['semester'])): ?>
        loadSubjects();
    <?php endif; ?>

    <?php if (!empty($_GET['department'])): ?>
        loadFaculties();
    <?php endif; ?>
});
</script>

</body>
</html>
