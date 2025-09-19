<?php
// session_start(); 
error_reporting(0);
include('dbcon.php');;
$role = $_SESSION['role']; 
$emms_id = $_SESSION['emms_uid'];

// Check if the user is logged in and has the role of 'Faculty'
if (isset($_SESSION['role']) && $_SESSION['role'] == 'Faculty') {
    $showNotificationCard = true; // Show notification card for Faculty
    $showNotificationIcon = true; // Show notification icon for Faculty
} else {
    $showNotificationCard = false; // Hide notification card for non-Faculty
    $showNotificationIcon = false; // Hide notification icon for non-Faculty
}
?>

<header>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="logosec">
        <div class="logo">VVP</div>
    </div>

    <div class="message">
        <div class="circle"></div>
        <?php if ($showNotificationIcon): ?>
            <!-- Show notification icon only for Faculty -->
            <button onclick="toggleCard()">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="Notification Icon">
            </button>
        <?php endif; ?>
        <div class="dp">
            <button onclick="toggleProfile()">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </button>
        </div>
    </div>
</header>

<?php if ($showNotificationCard): ?>
    <!-- Notification Card will only show if the user is Faculty -->
    <div class="notification-card" id="notificationCard">
        <select name="sem" required>
            <option value="" disabled selected>Select your Semester</option>
            <?php
                // Fetch semester data from the database
                $sq1 = "SELECT * FROM sem_master;";
                $q1 = mysqli_query($con, $sq1);
                while ($rows = mysqli_fetch_assoc($q1)) { ?>
                    <option value="<?php echo $rows['sem_id']; ?>"> <?php echo $rows['sem_no']; ?> </option>
                <?php } ?>
        </select>

        <button type="button">Search</button>
        <button type="button">All</button>

        <hr>
        <table>
            <thead>
                <tr>
                    <th>Sem</th>
                    <th>Enrollment</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows for students (can be dynamically fetched from the database) -->
                <tr>
                    <td>6</td>
                    <td>123456789</td>
                    <td>John Doe</td>
                    <td>23it379.dhaval.parmar@vvpedulink.ac.in</td>
                    <td>9876543210</td>
                    <td>
                        <span class="icons correct" onclick="markCorrect(this)">&#10004;</span>
                        <span class="icons wrong" onclick="markWrong(this)">&#10006;</span>
                    </td>
                </tr>
                <!-- More rows can be added here -->
            </tbody>
        </table>
    </div>
<?php endif; 
    if("Student" == $role)
    {
        $q1 = mysqli_query($con, "SELECT s.name, s.email_id, s.e_no, s.phone_no, d.de_name, se.sem_no
    FROM 
        student_master s
    JOIN 
        department d ON s.de_id = d.de_id
    JOIN 
        sem_master se ON s.sem_id = se.sem_id
    WHERE 
        s.u_id = '$emms_id';");

// Fetch the result
$result = mysqli_fetch_array($q1);

    }
    else if("Admin"==$role)
    {   
        $q1 = mysqli_query($con, "select email_id,username from Admin_master where Admin_id = '$emms_id';");
        $result = mysqli_fetch_array($q1);
      
    }
    else if("Faculty"== $role)
    {
        $q1 = mysqli_query($con, "select f_name,email_id,phone_no,dep_id from faculty_master where f_id = '$emms_id';");
        $result = mysqli_fetch_array($q1);
        
    }
?>

<!-- Profile Card Section -->
<div class="profile-card" id="profile">
    <div class="sub-profile-card">
        <div class="profile-header">
            <img id="profilePhoto" src="user.png" alt="Profile Photo" class="profile-photo">
            <div class="profile-name" id="profileName">
                <?php
                    // Check the session role to display the correct name
                    if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 'Student') {
                            // Display student's name
                            echo $result['name']; // Student's name from DB
                        } elseif ($_SESSION['role'] == 'Faculty') {
                            // Display faculty's first name (assuming 'f_name' in the database for faculty)
                            echo $result['f_name']; // Faculty's first name from DB
                        } elseif ($_SESSION['role'] == 'Admin') {
                            // For Admin, display the username (assuming 'username' in the database for admin)
                            echo $result['username']; // Admin's username from DB
                        }
                    }
                ?>
</div>

            <div class="profile-department" id="profileDepartment"><?php echo $result['de_name'] ?> Department</div>
        </div>
        <div class="profile-details">
            <div class="detail-item">
                <div class="detail-icon">✉️</div>
                <div class="detail-text">
                    <span class="detail-label">Email</span>
                    <span class="detail-value" id="profileEmail"><?php echo $result['email_id'] ?></span>
                </div>
            </div>
            <div class="detail-item">
    <div class="detail-icon">📱</div>
    <div class="detail-text">
        <span class="detail-label">
            <?php
            // Check if the user is a student, admin, or faculty
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'Student') {
                    echo 'Enrollment Number'; // For Student, show Enrollment Number
                } else {
                    echo 'Contact Number'; // For Admin and Faculty, show Contact Number
                }
            }
            ?>
        </span>
        <span class="detail-value" id="profileContact">
            <?php
            // Fetch the data based on the session user_role
            if ($_SESSION['role'] == 'Student') {
                // If student, display enrollment number
                echo $result['e_no']; 
            } else {
                // If admin or faculty, display contact number
                echo $result['phone_no'];
            }
            ?>
        </span>
    </div>
</div>

        <div class="logout-container">
            <button class="logout-btn" onclick="handleLogout()">
                <span class="logout-icon">🔐</span>
                Logout
            </button>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.querySelector(".navcontainer").classList.toggle("active");
    }

    function toggleCard() {
        const card = document.getElementById('notificationCard');
        card.style.display = card.style.display === 'none' || card.style.display === '' ? 'block' : 'none';
    }

    const profile = document.getElementById("profile");

    function toggleProfile() {
        profile.classList.toggle("open-profile");
    }

    function handleLogout() {
        if (confirm('Are you sure you want to logout?')) {
            // Clear local storage
            localStorage.clear();

            // You can redirect to login page here
            window.location.href = 'logout.php';

            // For demo purposes, we'll just reload the page
            alert('Logged out successfully!');
            window.location.reload();
        }
    }
</script>
</body>