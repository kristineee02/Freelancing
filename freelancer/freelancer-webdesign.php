<?php
session_start();
require_once '../class/Work.php';
require_once '../class/Freelancer.php';

$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");
$work = new Work($db);
$freelancer = new Freelancer($db);

// Ensure user is logged in
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: ../login/UserLogin.php");
    exit;
}

// Get work details
$workId = $_GET['id'] ?? null;
if (!$workId) {
    echo "Invalid work ID.";
    exit;
}

$workDetails = $work->getWorkById($workId);
if (!$workDetails) {
    echo "Work not found.";
    exit;
}

// Get freelancer/uploader ID from the work details
$uploaderId = $workDetails['freelancer_id'] ?? null;

if ($uploaderId) {
    $freelancerDetails = $freelancer->getFreelancerById($uploaderId);
    $fullName = trim($freelancerDetails['firstname'] . " " . $freelancerDetails['lastname']);
    $profilePic = $freelancerDetails['profile_pic'] ?? '../image/prof.jpg';
} else {
    $fullName = 'Unknown';
    $profilePic = '../image/prof.jpg';
}

// Format date
$datePosted = date('F j, Y', strtotime($workDetails['date_posted'] ?? 'now'));

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
                    <img class="profile" src="../image/prof.jpg">
                    <h4>Kristine Sabuero</h4>
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
    <main>
        <form class="design-showcase" >
            <div class="design-profile">
            <div class="avatar" style="background-image: url('<?php echo htmlspecialchars($profilePic); ?>');"></div>
            <span>
                <?php 
                $uploaderName = trim($freelancerDetails['firstname'] . ' ' . $freelancerDetails['lastname']);
                echo htmlspecialchars($uploaderName); 
                ?>
            </span>
            <button class="follow-btn">FOLLOW +</button>
            </div>
            <h2><?php echo htmlspecialchars($workDetails['title'] ?? 'Untitled'); ?></h2>
            <span class="work-category"><?php echo htmlspecialchars($workDetails['category'] ?? ''); ?></span>
            <div class="time" id="date"><?php echo $datePosted; ?></div>
            <div class="design-preview" style="background-image: url('<?php echo htmlspecialchars("../api/" . $workDetails['picture']); ?>');"></div>
            <div class="heart-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </div>
            <div class="work-description">
                <p><?php echo htmlspecialchars($workDetails['description'] ?? 'No description available.'); ?></p>
            </div>
        </form>
        
        <section class="more-projects">
            <h3>More by <?php echo htmlspecialchars($fullName); ?></h3>
            <div class="project-gallery" id="moreWorks"></div>
        </section>
    </main>

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

<script>
    // Load more works by the same freelancer
    fetch(`../api/work_api.php?freelancer_id=<?php echo $userId; ?>`)
                .then(response => response.json())
                .then(data => {
                    const moreWorks = document.getElementById('moreWorks');
                    if (data.status === 'success' && data.works && data.works.length > 0) {
                        data.works.forEach(work => {
                            if (work.work_id != <?php echo $workId; ?>) { // Exclude current work
                                const projectItem = document.createElement('div');
                                projectItem.className = 'project-item';
                                projectItem.style.backgroundImage = `url('${work.picture.split(',')[0]}')`;
                                projectItem.onclick = () => window.location.href = `work-details.php?id=${work.work_id}`;
                                moreWorks.appendChild(projectItem);
                            }
                        });
                    } else {
                        moreWorks.innerHTML = '<p>No other works available.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching more works:', error);
                    document.getElementById('moreWorks').innerHTML = '<p>Failed to load more works.</p>';
                });
    </script>
</body>
</html>