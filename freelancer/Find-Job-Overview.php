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
                    <img class="profile" src="../image/prof.jpg" id="imageDisplay">
                    <h4 id="nameDisplay">Kristine Sabuero</h4>
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
        <p class="info-find-job" id="projectTitleDisplay"><b>
            COMPANY NAME
        </b></p>
    </div>

    <div class="tabs-application">
        <p class="active" id="overview" style="cursor:pointer;">OVERVIEW</p>
        <p id="application" style="cursor:pointer;">APPLICATION</p>
    </div>

    <main class="container-overview">
        <section>
            <h2 class="section-title">ABOUT US</h2>
            <p class="overview-details" id="aboutUsDisplay">Roots is an early-stage startup building an innovative platform to revolutionize how films are financed, distributed, and monetized.
                We're building a comprehensive digital ecosystem that serves as a permanent home for films, combining sophisticated rights management with cutting-edge fintech solutions. 
                Our mission is to extend the commercial lifespan of films indefinitely while democratizing film investment through micro-investment opportunities.
            </p>
        </section>

        <section class="role">
            <h2 class="section-title">THE ROLE</h2>
            <p class="overview-details" id="roleDisplay">We're seeking a highly skilled React Frontend Developer to join our team and help build the next generation of film industry tools. 
                We are looking for a strong software engineer who deeply understands frontend architecture, performance optimization and scalability. 
            </p>
        </section>

        <section class="task">
            <h2 class="section-title">YOUR TASKS</h2>
            <p class="overview-details" id="taskDisplay">
            </p>
        </section>

        <section class="benefits">
            <h2 class="section-title">BENEFITS</h2>
            <p class="overview-details" id="benefitsDisplay">
            </p>
        </section>

        <section class="requirements">
            <h2 class="section-title">REQUIREMENTS</h2>
            <p class="overview-details" id="requirementsDisplay">
            </p>
        </section>
    </main>

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu(){
            subMenu.classList.toggle("open");
        }
    </script>
    <script src="../js/findJobOverview.js"></script>
</body>
</html>