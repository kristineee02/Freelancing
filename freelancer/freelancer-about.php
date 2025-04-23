<?php
session_start();
include '../api/database.php';
require_once '../class/Freelancer.php';

$database = new Database();
$conn = $database->getConnection();

// Ensure user is logged in
$account_id = $_SESSION['user_id'] ?? null;
if (!$account_id) {
    header("Location: ../login/UserLogin.php");
    exit;
}

$freelancer = new Freelancer($conn);

// Fetch freelancer and about data from the database
$freelancerData = $freelancer->getFreelancerById($account_id);
if ($freelancerData && $freelancerData['about_id']) {
    $query = "SELECT * FROM about WHERE about_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$freelancerData['about_id']]);
    $aboutData = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update session with database data
$_SESSION['firstName'] = $freelancerData['firstname'] ?? '';
$_SESSION['lastName'] = $freelancerData['lastname'] ?? '';
$_SESSION['address'] = $freelancerData['address'] ?? '';
$_SESSION['profile_pic'] = $freelancerData['profile_pic'] ?? '../image/yellow circle.png';
$_SESSION['contact'] = $aboutData['contact'] ?? '';
$_SESSION['profession'] = $aboutData['profession'] ?? '';
$_SESSION['skills'] = $aboutData['skills'] ?? '';
$_SESSION['history'] = $aboutData['history'] ?? '';
$_SESSION['socials'] = $aboutData['socials'] ?? '';

// Load session data for display
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$fullName = trim($firstName . " " . $lastName);
$address = $_SESSION['address'];
$contact = $_SESSION['contact'];
$profession = $_SESSION['profession'];
$skills = $_SESSION['skills'];
$history = $_SESSION['history'];
$socials = $_SESSION['socials'];

// Handle Edit About form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContact = $_POST['editnumber'] ?? '';
    $newProfession = $_POST['editprofession'] ?? '';
    $newSkills = $_POST['editskills'] ?? '';
    $newHistory = $_POST['edithistory'] ?? '';
    $newSocials = $_POST['editsocials'] ?? '';

    // Update profile
    if ($freelancer->updateAbout($account_id, $newContact, $newSkills, $newHistory, $newSocials, $newProfession)) {
        // Update session variables
        $_SESSION['contact'] = $newContact;
        $_SESSION['profession'] = $newProfession;
        $_SESSION['skills'] = $newSkills;
        $_SESSION['history'] = $newHistory;
        $_SESSION['socials'] = $newSocials;

        // Redirect to refresh the page with updated data
        header("Location: freelancer-about.php");
        exit;
    } else {
        echo "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>
    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
                <li><a href="Explore.php">Explore</a></li>
                <li><a href="Find-Job.php" class="tight-text">Find Jobs</a></li>
                <li><a href="About.php">About</a></li>
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
                    <h4><?php echo htmlspecialchars($fullName); ?></h4>
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

    <div class="profile-container">
        <div class="profile-header">
            <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="Profile Image" class="profile-image">
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($fullName); ?></h1>
                <p class="location"><?php echo htmlspecialchars($address); ?></p>
                <p class="follow-info">0 Followers | 20 Following</p>
                <button class="edit-profile" onclick="goToEditProfile()">EDIT PROFILE</button>
            </div>
        </div>

        <div class="tabs">
            <a href="freelancer-work.php">WORK</a>
            <a href="freelancer-about.php" class="active">ABOUT</a>
            <a href="freelancer-likedpost.php">LIKED POST</a>
        </div>
        <hr>
    </div>

    <div class="about-section">
        <div class="about-left">
            <h2>ABOUT YOU</h2>
            <p>Contact: <?php echo htmlspecialchars($contact); ?></p>
            <p>Profession: <?php echo htmlspecialchars($profession); ?></p>
            <br/>
            <h2>SKILLS</h2>
            <p><?php echo htmlspecialchars($skills); ?></p>
        </div>
        <div class="about-right">
            <h2>WORK HISTORY AND EXPERIENCE</h2>
            <p><?php echo htmlspecialchars($history); ?></p>
            <br/>
            <h2>SOCIALS</h2>
            <p><?php echo htmlspecialchars($socials); ?></p>
        </div>
        <button class="edit-about" id="editAbout">EDIT ABOUT</button>
    </div>

    <!-- Edit About Modal -->
    <div id="editAboutModal" class="modal-about">
        <div class="modal-content-about">
            <span class="close_about">×</span>
            <h3>Edit About</h3>
            <form id="aboutUpdateForm" method="POST" action="freelancer-about.php">
                <div class="form-grid-about">
                    <div class="form-group-about">
                        <h1>ABOUT YOU</h1>
                        <label for="editnumber">Contact</label>
                        <input type="text" id="editnumber" name="editnumber" placeholder="Contact" value="<?php echo htmlspecialchars($contact); ?>">
                        <label for="editprofession">Profession</label>
                        <input type="text" id="editprofession" name="editprofession" placeholder="Profession" value="<?php echo htmlspecialchars($profession); ?>">
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

        function toggleMenu() {
            let subMenu = document.getElementById("subMenu");
            subMenu.classList.toggle("open");
        }

        function logout() {
            alert("You have been logged out successfully.");
        }

        document.addEventListener('DOMContentLoaded', function () {
            const notifBtn = document.getElementById('notifBtn');
            const notifPopup = document.getElementById('notifPopup');
            const editAboutBtn = document.getElementById('editAbout');
            const editAboutModal = document.getElementById('editAboutModal');
            const closeAbout = document.querySelector('.close_about');

            notifBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                notifPopup.style.display = notifPopup.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function (e) {
                if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
                    notifPopup.style.display = 'none';
                }
            });

            editAboutBtn.addEventListener('click', function () {
                editAboutModal.style.display = 'block';
            });

            closeAbout.addEventListener('click', function () {
                editAboutModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === editAboutModal) {
                    editAboutModal.style.display = 'none';
                }
            });
        });
    </script>
    <script src="../js/freelancer.js"></script>
</body>
</html>