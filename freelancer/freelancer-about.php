<?php
    session_start();
    if(!$_SESSION["userId"]){
        header("Location: ../login/UserLogIn.php");
    }

    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header("Location: ../home/Home.php");
        exit();
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
                <div class="user-info" id="userInfoDocument">
                    <img class="profile" src="../image/prof.jpg">
                    <h4>name</h4>
                </div>
                <hr>
                <a href="freelancer-work.php" class="sub-menu-link">
                    <img src="../image/prof.jpg">
                    <p>Profile</p>
                    <span>></span>
                </a>
                <a href="?action=logout" name="logout" class="sub-menu-link">
                    <img src="../image/logo.png">
                    <p>Logout</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </div>

    <div class="profile-container">
        <div class="profile-header" id="profileHeaderDocument">
            <img src="../image/" alt="Profile Image" class="profile-image">
            <div class="profile-info">
                <h1>name</h1>
                <p class="location">address</p>
            </div>
        </div>

        <div class="tabs">
            <a href="freelancer-work.php">WORK</a>
            <a href="freelancer-about.php" class="active">ABOUT</a>
        </div>
        <hr>
    </div>

    <div class="about-section" id="aboutSection">
        <div class="about-left">
            <h2>ABOUT YOU</h2>
            <p id="contactData"></p>
            <p id="professionData"></p>
            <br/>
            <h2>SKILLS</h2>
            <p id="skillsData"></p>
        </div>
        <div class="about-right">
            <h2>WORK HISTORY AND EXPERIENCE</h2>
            <p id="historyData"></p>
            <br/>
            <h2>SOCIALS</h2>
            <p id="socialsData"></p>
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
                        <input type="text" id="editnumber" name="editnumber" placeholder="Contact">
                        <label for="editprofession">Profession</label>
                        <input type="text" id="editprofession" name="editprofession" placeholder="Profession">
                        <label for="editskills">Skills</label>
                        <textarea name="editskills" id="editSkills"></textarea>
                        <label for="edithistory">Work History</label>
                        <textarea name="edithistory" id="editHistory"></textarea>
                        <label for="editsocials">Socials</label>
                        <textarea name="editsocials" id="editSocials"></textarea>
                    </div>
                </div>
                <button type="submit" class="button-edit-about">Save Changes</button>
            </form>
        </div>
    </div>

    <script>

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