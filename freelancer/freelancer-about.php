<?php
session_start();

$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
$address = $_SESSION['address'] ?? '';
    
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
        <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image">
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
        <p>NAME:</p>
        <p>CONTACT:</p>
        <p>EMAIL:</p>
        <br/>
        <h2>SKILLS</h2>
        <p>DESIGNING</p>
        <p>WRITING</p>
    </div>
    <div class="about-right">
        <h2>WORK HISTORY AND EXPERIENCE</h2>
        <p>DESIGNER FOR AZ COMPANY</p>
        <p>PROJECT MANAGER</p>
        <br/>
        <h2>SOCIALS</h2>
        <p>Instagram:</p>
        <p>Facebook:</p>
    </div>
    <button class="edit-about" id="editAbout">EDIT ABOUT</button>
</div>

    <!--edit modal-->
    <div id="editAboutModal" class="modal-about">
    <div class="modal-content-about">
        <span class="close_about">&times;</span>
        <h3>Edit About</h3>
        <form id="aboutUpdateForm">
            <div class="form-grid-about">
                <div class="form-group-about">
                    <h1>ABOUT YOU</h1>
                    <label for="editname">Name</label>
                    <input type="text" id="editname" name="editname" placeholder="Name">

                    <label for="editnumber">Contact</label>
                    <input type="number" id="editnumber" name="editnumber" placeholder="Contact">

                    <label for="editemail">Email</label>
                    <input type="email" id="editemail" name="editemail" placeholder="Email">  
                    
                    <label for="editskill">Skills</label>
                    <textarea name="editskills" placeholder="Skills" ></textarea>

                    <label for="edit_History">Work History</label>
                    <textarea name="edithistory" placeholder="Work History & Experience"></textarea>

                    <label for="edit_Social">Socials</label>
                    <textarea name="editsocials" placeholder="Social Media" ></textarea>
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