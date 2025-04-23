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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel ="stylesheet" href="../style/clients.css">

</head>
<body>

    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="client-explore.php" >Explore</a>  </li>
             <li> <a href="Find-Freelancer.php" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
             <div class="dropdown_menu">
                <ul>
                    <li><a href="client-freelancer-work.php" class="tight-text">Post Job</a></li>
                </ul>
             </div>
            </li>
             <li> <a href="client-about.php">About</a></li>
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
                <span><i class="fa-solid fa-heart"></i></span>
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

</body>
</html>