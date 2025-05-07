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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>
    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="client-explore.php">Explore</a>  </li>
             <li> <a href="Find-Freelancer.php" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
             <div class="dropdown_menu">
                <ul>
                    <li><a href="client-freelancer-work.php" class="tight-text">Post Job</a></li>
                </ul>
             </div>
             <li><a href="application-home.php">Application</a></li>
            </li>
             <li> <a href="client-about.php" class="active-dash">About</a></li>
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
                    <img class="profile" alt="Profile" id="imageDisplay">
                    <h4 id="nameDisplay">name</h4>
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
        <div class="profile-header" id="profileHeaderDocument">
            <img src="../image/" alt="Profile Image" class="profile-image" id="imageDisplay2">
            <div class="profile-info">
                <h1 id="nameDisplay2">name</h1>
                <p class="location" id="addressId">address</p>
            </div>
        </div>

        <div class="tabs">
            <a id="workIdNav">WORK</a>
            <a class="active">ABOUT</a>
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
    </div>
    


    <script>

        function toggleMenu() {
            let subMenu = document.getElementById("subMenu");
            subMenu.classList.toggle("open");
        }

    </script>
    <script src="../js/clientFreelancerAbout.js"></script>
</body>
</html>