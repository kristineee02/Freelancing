<?php
session_start();
require_once '../class/Freelancer.php';
$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");

// Ensure user is logged in
$account_id = $_SESSION['user_id'] ?? null;
if (!$account_id) {
    header("Location: ../login/UserLogin.php");
    exit;
}

$freelancer = new Freelancer($db);

// Load session data
$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
$address = $_SESSION['address'] ?? '';
$contact = $_SESSION['contact'] ?? '';
$birthday = $_SESSION['birthday'] ?? '';
$skills = $_SESSION['skills'] ?? '';
$history = $_SESSION['history'] ?? '';
$socials = $_SESSION['socials'] ?? '';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editname'])) {
    $newName = $_POST['editname'];
    $newContact = $_POST['editnumber'];
    $newBirthdate = $_POST['editbirthday'];
    $newSkills = $_POST['editskills'];
    $newHistory = $_POST['edithistory'];
    $newSocials = $_POST['editsocials'];

    // Update profile
    if ($freelancer->updateAbout($account_id, $newName, $newContact, $newBirthdate, $newSkills, $newHistory, $newSocials)) {
        // Parse the name to update session
        $nameParts = explode(' ', $newName, 2);
        $_SESSION['firstName'] = $nameParts[0];
        $_SESSION['lastName'] = isset($nameParts[1]) ? $nameParts[1] : '';
        $_SESSION['contact'] = $newContact;
        $_SESSION['birthday'] = $newBirthdate;
        $_SESSION['skills'] = $newSkills;
        $_SESSION['history'] = $newHistory;
        $_SESSION['socials'] = $newSocials;

        // Redirect
        header("Location: freelancer-about.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel ="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>

    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="Explore.php">Explore</a>  </li>
             <li> <a href="Find-Job.php" class="tight-text">Find Jobs</a> </li>
             <li> <a href="About.php" >About</a></li>
            </ul>
        </div>

        <div class="notif-profile">
            <img src="../image/3119338.png" alt="Notification icon" class="notif" id="notifBtn" />
            <div class="notification-popup" id="notifPopup">
                <p><strong>New Message:</strong> Your job application has been viewed!</p>
                <p><strong>Reminder:</strong> Update your profile today.</p>
              </div>
            <img class="profile" src="../image/prof.jpg" alt="profile" onclick="toggleMenu()">
        </div>

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img class="profile" src="../image/prof.jpg">
                    <h4> <?php echo htmlspecialchars($fullName); ?> </h4>
                </div>
                <hr>

                <a href="freelancer-work.php" class="sub-menu-link">
                    <img src="../image/prof.jpg">
                    <p>Profile</p>
                    <span>></span>
                </a>
                <a href="../home/Home.php" class="sub-menu-link" onclick="logout()">
                    <img src="../image/logo.png">
                    <p>Logout</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="profile-container">
    <div class="profile-header">
    <img src="<?php echo $_SESSION['profile_pic'] ?? '../image/yellow circle.png'; ?>" alt="Profile Image" class="profile-image">            
        <div class="profile-info">
            <h1> <?php echo htmlspecialchars($fullName); ?></h1>
            <p class="location"><?php echo htmlspecialchars($address); ?></p>
            <p class="follow-info">0 Followers  |  20 Following</p>
            <button class="edit-profile" onclick="goToEditProfile()">EDIT PROFILE</a></button>
        </div>
    </div>

    <div class="tabs">
        <a href="freelancer-work.php">WORK</a>
        <a href = "freelancer-about.php" class="active">ABOUT</a>
        <a href="freelancer-likedpost.php">LIKED POST</a>
    </div>
    <hr>
</div>


<div class="about-section">
    <div class="about-left">
        <h2>ABOUT YOU</h2>
        <p> Name: <?php echo htmlspecialchars($fullName); ?></p>
        <p> Contact: <?php echo htmlspecialchars($contact); ?></p>
        <p> Birthdate: <?php echo htmlspecialchars($birthday); ?></p>
        <br/>
        <h2>SKILLS</h2>
        <p>skills<?php echo htmlspecialchars($skills); ?></p>
    </div>
    <div class="about-right">
        <h2>WORK HISTORY AND EXPERIENCE</h2>
        <p>work history<?php echo htmlspecialchars($history); ?></p>
        <br/>
        <h2>SOCIALS</h2>
        <p>any socials<?php echo htmlspecialchars($socials); ?></p>
    </div>
    <button class="edit-about" id="editAbout">EDIT ABOUT</button>
</div>

 <!--edit modal-->
 <div id="editAboutModal" class="modal-about">
        <div class="modal-content-about">
            <span class="close_about">×</span>
            <h3>Edit About</h3>
            <form id="aboutUpdateForm" method="POST" action="freelancer-about.php">
                <div class="form-grid-about">
                    <div class="form-group-about">
                        <h1>ABOUT YOU</h1>
                        <label for="editname">Name</label>
                        <input type="text" id="editUserName" name="editname" placeholder="Name" value="<?php echo htmlspecialchars($fullName); ?>">

                        <label for="editnumber">Contact</label>
                        <input type="number" id="editUserNumber" name="editnumber" placeholder="Contact" value="<?php echo htmlspecialchars($contact); ?>">

                        <label for="editbirthday">Birth Date</label>
                        <input type="date" id="editUserBirthday" name="editbirthday" placeholder="Birthday" value="<?php echo htmlspecialchars($birthday); ?>">  

                        <label for="editskills">Skills</label>
                        <textarea name="editskills"><?php echo htmlspecialchars($skills); ?></textarea>

                        <label for="edithistory">Work History</label>
                        <textarea name="edithistory"><?php echo htmlspecialchars($history); ?></textarea>

                        <label for="editsocials">Socials</label>
                        <textarea name="editsocials"><?php echo htmlspecialchars($socials); ?></textarea>
                    </div>
                </div>
                <button type="submit" class="button-edit-about">Save Changes</button>
            </form>
        </div>
    </div>

 
<script>
    function goToEditProfile() {
    window.location.href = "freelancer-work.php";
}
</script>
<script>
let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open");
}
</script>

<script>
function logout() {
alert("You have been logged out successfully."); 
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const notifBtn = document.getElementById('notifBtn');  
    const notifPopup = document.getElementById('notifPopup');  

 
    notifBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        notifPopup.style.display = notifPopup.style.display === 'block' ? 'none' : 'block';
    });

    
    document.addEventListener('click', function (e) {
        if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
            notifPopup.style.display = 'none';
        }
    });
});
</script>

<script src="../js/freelancer.js"></script>
</body>
</html>