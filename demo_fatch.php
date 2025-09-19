<?php
// Include database connection
include 'dbcon.php'; 

// Fetch faculty details along with department
$faculty_sql = "
    SELECT f.f_id, f.f_name, f.email_id, f.phone_no, d.de_name 
    FROM faculty_master f
    LEFT JOIN department d ON f.de_id = d.de_id
";
$faculty_result = mysqli_query($con, $faculty_sql);

// Check if faculty exist
if (mysqli_num_rows($faculty_result) > 0) {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Faculty Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Department</th>
                    <th>Semester 1</th>
                    <th>Subject 1</th>
                    <th>Semester 2</th>
                    <th>Subject 2</th>
                    <th>Semester 3</th>
                    <th>Subject 3</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    // Loop through each faculty
    while ($faculty = mysqli_fetch_assoc($faculty_result)) {
        $f_id = $faculty['f_id'];

        // Fetch subjects and semesters for the current faculty
        $subject_sql = "
            SELECT sm.sem_no, sub.sub_name 
            FROM faculty_subject fs
            LEFT JOIN sem_master sm ON fs.sem_id = sm.sem_id
            LEFT JOIN subject_master sub ON fs.sem_id = sub.sem_id
            WHERE fs.f_id = '$f_id'
            ORDER BY sm.sem_no
            LIMIT 3"; // Fetch max 3 subjects
        
        $subject_result = mysqli_query($con, $subject_sql);

        // Store subjects in an array (max 3)
        $subjects = [];
        while ($subject = mysqli_fetch_assoc($subject_result)) {
            $subjects[] = [
                'semester' => $subject['sem_no'],
                'subject'  => $subject['sub_name']
            ];
        }

        // Ensure there are exactly 3 subject slots (fill empty slots if necessary)
        while (count($subjects) < 3) {
            $subjects[] = ['semester' => '', 'subject' => ''];
        }

        // Display faculty details in a row with subjects in separate columns
        echo "<tr>
                <td>{$faculty['f_name']}</td>
                <td>{$faculty['email_id']}</td>
                <td>{$faculty['phone_no']}</td>
                <td>{$faculty['de_name']}</td>
                <td>{$subjects[0]['semester']}</td>
                <td>{$subjects[0]['subject']}</td>
                <td>{$subjects[1]['semester']}</td>
                <td>{$subjects[1]['subject']}</td>
                <td>{$subjects[2]['semester']}</td>
                <td>{$subjects[2]['subject']}</td>
                <td>
                    <button class='btn-update'>Update</button>
                    <button class='btn-delete'>Delete</button>
                </td>
            </tr>";
    }
    
    echo "</tbody></table>";
} else {
    echo "No faculty found.";
}

// Close connection
mysqli_close($con);
?>
