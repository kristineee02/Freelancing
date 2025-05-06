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
    <link rel ="stylesheet" href="../style/style.css">

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
                    <img class="profile" src="../image/prof.jpg" id="imageDisplay">
                    <h4 id="nameDisplay"></h4>
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
    <div class="discover-find-job">
        <div class="overlay-find"></div>
        <p class="info-find-job"><b>
        </b></p>
    </div>

    <div class="tabs-application">
        <p id="overview" style="cursor:pointer;">OVERVIEW</p>
        <p  class="active" id="application" style="cursor:pointer;">APPLICATION</p>
    </div>

    <main class="application-container">
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <h2 class="app-info">PERSONAL INFORMATION</h2>
            
            <div class="form-group">
                <label for="group">First Name</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>

            <div class="form-group">
                <label for="group">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="group">Contact Number</label>
                <input type="tel" id="contact" name="contact" required>
            </div>

            <div class="form-group">
                <label for="group">Address</label>
                <input type="text" id="address" name="address" required>
            </div>

            <h2 class="personal-profile">PERSONAL PROFILE</h2>
            <div class="form-group">
                <label for="resume">Resume</label>
                <input type="file" id="resume" name="resume" required>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>
            
        </form>
    </main>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu(){
            subMenu.classList.toggle("open");
        }
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
    <script src="../js/findJobApplication.js"></script>
</body>
</html>