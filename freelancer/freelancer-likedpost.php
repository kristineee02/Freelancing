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
    <link rel ="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>

    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="Explore.php">Explore</a> </li>
             <li> <a href="Find-Job.php" class="tight-text">Find Jobs</a> </li>
             <li><a href="buy-table.php">Buy</a></li>
             <li> <a href="About.php" class="active-dash">About</a></li>
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
</div>
<div class="profile-container">
    <div class="profile-header">
        <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image">
        <div class="profile-info">
            <h1>name</h1>
            <p class="location">address</p>
            <p class="follow-info">0 Followers  |  20 Following</p>
            <button class="edit-profile" onclick="goToEditProfile()">EDIT PROFILE</a></button>
        </div>
    </div>

    <div class="tabs">
        <a href="freelancer-work.php">WORK</a>
        <a href = "freelancer-about.php">ABOUT</a>
        <a href="freelancer-likedpost.php"class="active">LIKED POST</a>
    </div>
    <hr>
</div>
<div class="liked-posts-grid">
    <div class="post-card">
        <div class="post-footer">
            <div class="post-author">
                <div class="author-icon">J</div>
                <span>Jayna Sahibul</span>
            </div>
            <div class="heart-button">
                <img class="heart" src="../image/hearty.png">
            </div>
        </div>
    </div>
    
    <div class="post-card">
        <div class="post-footer">
            <div class="post-author">
                <div class="author-icon">A</div>
                <span>Amani Uri</span>
            </div>
            <div class="heart-button">
                <img class="heart" src="../image/hearty.png">
            </div>
        </div>
    </div>
    
    <div class="post-card">
        <div class="post-footer">
            <div class="post-author">
                <div class="author-icon">V</div>
                <span>Ven Malali</span>
            </div>
            <div class="heart-button">
                <img class="heart" src="../image/hearty.png">
            </div>
        </div>
    </div>
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
</body>
</html>