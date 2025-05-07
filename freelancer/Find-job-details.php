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
                    <h4>Kristine Sabuero</h4>
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
    <hr>

    <section class="job-details">
        <p class="details-job">JOB DETAILS</h2>
        <p class="skill-name" id="skillNameId">WEBSITE DESIGNER</h1>
        <div class="job-content">
            <div class="job-description" >
                <p id="jobDescription">We are seeking a highly creative and design-driven Content Analyst to join our dynamic team. As a Content Analyst, you will be building websites using our website builder platform for our diverse range of small business customers. If you have an eye for great design, understand how to create engaging online experiences, and enjoy helping businesses stand out, this is the perfect role for you.</p>
                <h3>Job requirements</h3>
                <h4>Education:</h4>
                <p id="educationId"></p>
                <h4>Experience:</h4>
                <p id="experienceId"></p>
                <button class="apply" id="applyBtn">APPLY FOR THIS JOB</button>
            </div>
            <div class="company-info">
                <p id="locationId"></p>
                <p id="datePostedId"></p>
                <p id="timeframeId"></p>
                <p id="budgetId"></p>
            </div>
        </div>
    </section>

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
        function goToApplyJob() {
        window.location.href = "Find-Job-Overview.php";
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

<script src="../js/findJobDetails.js"></script>
</body>
</html>