<?php
include('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Fetch Departments
    if ($action === 'get_departments') {
        $query = "SELECT * FROM department ORDER BY de_name ASC";
        $result = mysqli_query($con, $query);

        $options = '<option value="" disabled selected>Select your department</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= "<option value='{$row['de_id']}'>{$row['de  _name']}</option>";
        }

        echo $options;
        exit;
    }

    // Fetch Subjects Based on Selected Department & Semester
    if ($action === 'get_subjects' && isset($_POST['department_id']) && isset($_POST['semester_id'])) {
        $de_id = $_POST['department_id'];
        $sem_id = $_POST['semester_id'];
        $query = "SELECT * FROM subject_master WHERE de_id = $de_id AND sem_id = $sem_id ORDER BY sub_name ASC";
        $result = mysqli_query($con, $query);

        $options = '<option value="" disabled selected>Select subject</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= "<option value='{$row['sub_id']}'>{$row['sub_name']}</option>";
        }

        echo $options;
        exit;
    }
}

// If an invalid request is made
echo "Invalid request";
?>
