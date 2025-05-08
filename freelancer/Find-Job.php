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
    <link rel="stylesheet" href="../style/style.css">
    <link rel ="stylesheet" href="../style/responsive-freelancer.css">

</head>
<body>
    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="Explore.php">Explore</a> </li>
             <li> <a href="Find-Job.php" class="tight-text active-dash">Find Jobs</a> </li>
             <li><a href="buy-table.php" class="tight-text">Buy Work</a></li>
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
                    <h4 id="nameDisplay">name</h4>
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
            FIND THE BEST JOB SUITABLE<br> FOR YOU.
        </b></p>
        <div class="search-bar-job">
    <input type="text" placeholder="What are you looking for?" name="search" id="jobSearch" oninput="filterJobs()">
    <button>Search</button>
</div>
    </div>

    <div class="category">
        <p class="categories">Categories:</p>
        <div class="category-type">
            <input type="radio" id="skill" name="category" value="All" checked onchange="filterJobs()">
            <label for="skill">All</label><br/><br/>

            <input type="radio" id="skill1" name="category" value="ANIMATION" onchange="filterJobs()">
            <label for="skill1">Animation</label><br/><br/>

            <input type="radio" id="skill2" name="category" value="GRAPHIC DESIGN" onchange="filterJobs()">
            <label for="skill2">Graphic Design</label><br/><br/>

            <input type="radio" id="skill3" name="category" value="PRODUCT DESIGN" onchange="filterJobs()">
            <label for="skill3">Product Design</label><br/><br/>

            <input type="radio" id="skill4" name="category" value="WEB DESIGN" onchange="filterJobs()">
            <label for="skill4">Web Design</label><br/><br/>

            <input type="radio" id="skill5" name="category" value="ILLUSTRATION" onchange="filterJobs()">
            <label for="skill5">Illustration</label><br/><br/>

            <input type="radio" id="skill6" name="category" value="MOBILE DESIGN" onchange="filterJobs()">
            <label for="skill6">Mobile Design</label><br/><br/>

            <input type="radio" id="skill7" name="category" value="WRITING" onchange="filterJobs()">
            <label for="skill7">Writing</label><br/><br/>
        </div>
    </div>

    <p class="post">
        <b>POSTED JOBS</b>
    </p>

    <div class="company-container" id="company-section">

        <div class="company">
            <div class="header">
                <div>
                    <img src="../image/jayna.jpg" alt="company logo" >
                    <div class="company-name"></div>
                </div>
                <div class="date"></div>
            </div>
            <div class="position"></div>
            <div class="price">
                <i class="fa-solid fa-tag"></i>
                <span class="location">
                    <i class="fa-solid fa-location-dot"></i> 
                </span>
            </div>
            <div class="description"></div>
            <div class="buttons">
                <div class="btn">View Job</div>
                <div class="btn">Apply for Job</div>
            </div>
        </div>       
    </div>

    <script>
        let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open");
    }
    </script>
    <script src="../js/findJob.js"></script>
</body>
</html>
