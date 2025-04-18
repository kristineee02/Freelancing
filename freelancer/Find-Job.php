<?php
session_start();

$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
    
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
             <li> <a href="Find-Job.php" class="tight-text active-dash">Find Jobs</a> </li>
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
                    <h4><?php echo htmlspecialchars($fullName); ?></h4>
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
    <div class="discover-find-job">
        <div class="overlay-find"></div>
        <p class="info-find-job"><b>
            FIND THE BEST JOB SUITABLE<br> FOR YOU.
        </b></p>
        <div class="search-bar-job">
            <input type="text" placeholder="What are you looking for?" name="search">
            <button>Search</button>
        </div>
    </div>

    <div class="category">
        <p class="categories">Categories:</p>
    <div class="category-type">
        <input type="radio" id="skill1" name="category" value="30">
        <label for="skill1">Animation</label><br/><br/>

        <input type="radio" id="skill2" name="category" value="30">
        <label for="skill2">Graphic Design</label><br/><br/>

        <input type="radio" id="skill3" name="category" value="30">
        <label for="skill3">Product Design</label><br/><br/>

        <input type="radio" id="skill4" name="category" value="30">
        <label for="skill4">Web Design</label><br/><br/>

        <input type="radio" id="skill5" name="category" value="30">
        <label for="skill5">llustration</label><br/><br/>

        <input type="radio" id="skill6" name="category" value="30">
        <label for="skill6">Mobile Design</label><br/><br/>

        <input type="radio" id="skill7" name="category" value="30">
        <label for="skill7">Writing</label><br/><br/>
    </div>
    </div>

    <p class="post">
        <b>POSTED JOBS</b>
    </p>
    <div class="company-container">
        <div class="company">
            <div class="header">
                <div style="display: flex; align-items: center;">
                    <img src="../image/prof.jpg" alt="company logo">
                    <div class="company-name">Hello Corp.</div>
                </div>
                <div class="date">Posted 5 hours ago</div>
            </div>
            <div class="position">UX DESIGNER</div>
            <div class="price">Fixed Price | <span class="location">Location</span></div>
            <div class="description">
                We are looking for a UI Designer for our Bakery Website.<br>
                Designer must be creative and proficient in creating visually<br>appealing interfaces.
            </div>
            <div class="buttons">
                <div class="btn" onclick="goToViewJob()">View Job</div>
                <div class="btn" onclick="goToApplyJob()">Apply for Job</div>
            </div>
        </div>

        <div class="company">
            <div class="header">
                <div style="display: flex; align-items: center;">
                    <img src="../image/prof.jpg" alt="company logo">
                    <div class="company-name">Hello Corp.</div>
                </div>
                <div class="date">Posted 5 hours ago</div>
            </div>
            <div class="position">WEBSITE DESIGNER</div>
            <div class="price">Fixed Price | <span class="location">Location</span></div>
            <div class="description">
                We are looking for a UI Designer for our Bakery Website.<br>
                Designer must be creative and proficient in creating visually<br>appealing interfaces.
            </div>
            <div class="buttons">
                <div class="btn" onclick="goToViewJob()">View Job</div>
                <div class="btn" onclick="goToApplyJob()">Apply for Job</div>
            </div>
        </div>

        <div class="company">
            <div class="header">
                <div style="display: flex; align-items: center;">
                    <img src="../image/prof.jpg" alt="company logo">
                    <div class="company-name">Hello Corp.</div>
                </div>
                <div class="date">Posted 5 hours ago</div>
            </div>
            <div class="position">HELLO DESIGNER</div>
            <div class="price">Fixed Price | <span class="location">Location</span></div>
            <div class="description">
                We are looking for a UI Designer for our Bakery Website.<br>
                Designer must be creative and proficient in creating visually<br>appealing interfaces.
            </div>
            <div class="buttons">
                <div class="btn" onclick="goToViewJob()">View Job</div>
                <div class="btn" onclick="goToApplyJob()">Apply for Job</div>
            </div>
        </div>
    </div>   
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
    function goToViewJob() {
    window.location.href = "Find-job-details.php";
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
</body>
</html>