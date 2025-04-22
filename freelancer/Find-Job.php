<?php
session_start();
$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");

$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
  
$stmt = $db->prepare("
    SELECT j.*, c.firstname, c.lastname 
    FROM job j
    JOIN client c ON j.ClientId = c.client_id
    ORDER BY job_id DESC
");
$stmt->execute();
$works = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div class="company-container" id="company-section">
    <?php
    // Check if jobs array exists and has items
    if (isset($works) && is_array($works) && count($works) > 0) {
        foreach ($works as $job) {
            // Ensure these variables are set - either from the $job array or with default values
            $FullName = $job['FullName'] ?? 'Company Name';
            $Project_Category = $job['Project_Category'] ?? 'Job Category';
            $Description = $job['Description'] ?? 'No description available';
            $Budget = $job['Budget'] ?? 'N/A';
            $Location = $job['Location'] ?? 'Remote';
            $Date_created = $job['Date_created'] ?? 'Recently';
            $picture = $job['picture'] ?? '../image/prof.jpg';
            $job_id = $job['job_id'] ?? 0;
            
            echo '<div class="company">';
            echo '    <div class="header">';
            echo '        <div style="display: flex; align-items: center;">';
            echo '            <img src="' . htmlspecialchars($picture) . '" alt="company logo">';
            echo '            <div class="company-name">' . htmlspecialchars($FullName) . '</div>';
            echo '        </div>';
            echo '        <div class="date">' . htmlspecialchars($Date_created) . '</div>';
            echo '    </div>';
            echo '    <div class="position">' . htmlspecialchars($Project_Category) . '</div>';
            echo '    <div class="price"> <i class="fa-solid fa-tag"></i> ' . htmlspecialchars($Budget) . ' | ';
            echo '        <span class="location"> <i class="fa-solid fa-location-dot"></i> ' . htmlspecialchars($Location) . '</span></div>';
            echo '    <div class="description">' . htmlspecialchars($Description) . '</div>';
            echo '    <div class="buttons">';
            echo '        <div class="btn" onclick="goToViewJob(' . $job_id . ')">View Job</div>';
            echo '        <div class="btn" onclick="goToApplyJob(' . $job_id . ')">Apply for Job</div>';
            echo '    </div>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-jobs">No jobs available at this time.</div>';
    }
    ?>
</div>



<script>
    function goToViewJob(jobId) {
        window.location.href = "Find-job-details.php?id=" + jobId;
    }
    
    function goToApplyJob(jobId) {
        window.location.href = "Find-Job-Overview.php?id=" + jobId;
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