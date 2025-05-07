<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Profile</title>
    <link rel="stylesheet" href="../style/freelancer-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
           .work-section{
            margin-top: 50px;
            gap: 30px;
        }
        .work-box:hover{
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(24, 24, 24, 0.3);
  
        }
        
    </style>

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
    
    <div class="profile-container" id="profileId" data-freelancer-id="1">
        <div class="profile-header">
            <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image" id="imageDisplayId">
            <div class="profile-info">
                <h1 id="nameDisplayId"></h1>
                <p class="profession" id="professionId"></p>
                <p class="location" id="addressId"></p>
            </div>
        </div>

        <div class="tabs">
            <a href="#work" class="tab active" data-tab="work">WORK</a>
            <a href="#about" class="tab" data-tab="about" id="aboutSection">ABOUT</a>
        </div>
        <div class="hr"></div>

        <div class="content-section">
            <div id="workSection" class="work-section active-content">
                <!-- Work content will be loaded here -->
            </div>
              
        </div>
    </div>

    
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open");
        }
        
        function logout() {
            alert("You have been logged out successfully.");
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
    <script src="../js/freelancerProfile.js"></script>
</body>
</html>