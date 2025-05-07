<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["userId"])){
            echo '<script>window.location.href = "../login/UserLogIn.php";</script>';
            exit();
        }

        if(isset($_GET['action']) && $_GET['action'] == 'logout') {
            session_destroy();
            echo '<script>window.location.href = "../home/Home.php";</script>';
            exit();
        }
    ?>
    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="Explore.php">Explore</a> </li>
             <li> <a href="Find-Job.php" class="tight-text">Find Jobs</a> </li>
             <li><a href="buy-table.php" class="tight-text">Buy Work</a></li>
             <li> <a href="About.php">About</a></li>
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
                    <img class="profile" src="../image/prof.jpg" id="imageSubMenu">
                    <h4 id="nameSubMenu"></h4>
                </div>
                <hr>

                <a href="client-profile.php" class="sub-menu-link">
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
        <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image" id="profileImageDisplay">
        <div class="profile-info">
            <h1 id="nameDisplay"></h1>
            <p class="location" id="addressDisplay"></p>
        </div>
    </div>

    <div class="tabs">
        <a href="client-profile-about.php" class="active">ABOUT</a>
    </div>
    <hr>
</div>

<div class="about-section">
    <div class="about-left">
        <h2>ABOUT YOU</h2>
        <p id="contactAbout"></p>
        <p id="professionAbout"></p>
        <br/>
        <h2>SKILLS</h2>
        <p id="skillsAbout"></p>
    </div>
    <div class="about-right">
        <h2>WORK HISTORY AND EXPERIENCE</h2>
        <p id="historyAbout"></p>
        <br/>
        <h2>SOCIALS</h2>
        <p id="socialsAbout"></p>
    </div>
</div>

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open");
    }
</script>


<script src="../js/freelancer-clientabout.js"></script>

</body>
</html>