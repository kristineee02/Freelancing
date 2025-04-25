<?php
session_start();
require_once '../class/Freelancer.php';

$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");

// Check if viewing a specific freelancer profile or logged-in user's profile
$viewingId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$userId = $_SESSION['user_id'] ?? null;

// Create freelancer object
$freelancer = new Freelancer($db);

// Load session data for logged-in user
$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);

// Get freelancer data - either for the viewed profile or logged-in user
try {
    if ($viewingId) {
        // Fetch data for the specific freelancer being viewed
        $query = "SELECT f.account_id, f.firstname, f.lastname, f.profile_pic, f.address, a.profession 
                  FROM freelancer f 
                  LEFT JOIN about a ON f.about_id = a.about_id 
                  WHERE f.account_id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $viewingId, PDO::PARAM_INT);
        $stmt->execute();
        $freelancer = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$freelancer) {
            // Freelancer not found, redirect back
            header("Location: Find-Freelancer.php");
            exit;
        }
    } else {
        // Use current logged-in user's data
        $freelancer = $freelancer->getFreelancerById($userId);
    }
} catch (PDOException $e) {
    error_log("Error fetching freelancer data: " . $e->getMessage());
    $freelancer = []; // Set empty array if fetching fails
}
?>

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
            margin-top: 20px;
        }
        
    </style>

</head>
<body>

    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="client-explore.php">Explore</a></li>
              <li><a href="Find-Freelancer.php" class="tight-text">Find Designer <i class="fa fa-caret-down"></i></a> 
                <div class="dropdown_menu">
                   <ul>
                       <li><a href="client-freelancer-work.php" class="tight-text">Post Job</a></li>
                   </ul>
                </div>
              </li>
              <li><a href="client-about.php">About</a></li>
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
                    <img class="profile" src="<?php echo $_SESSION['profile_pic'] ?? '../image/prof.jpg'; ?>" alt="Profile">
                    <h4><?php echo htmlspecialchars($fullName); ?></h4>
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
    
    <div class="profile-container" id="profileId" data-freelancer-id="<?php echo $viewingId ?? $userId; ?>">
<?php
        // Ensure path is correct for profile pic
        $profilePic = $freelancer['profile_pic'] ?? '';
        $picture = !empty($profilePic) ? 
            (strpos($profilePic, '../') === 0 ? $profilePic : "../api/" . $profilePic) : 
            '../image/yellow circle.png';
        
        $freelancerName = trim(($freelancer['firstname'] ?? 'Unknown') . ' ' . ($freelancer['lastname'] ?? 'User'));
        $address = $freelancer['address'] ?? 'No address provided';
        $profession = $freelancer['profession'] ?? 'Freelancer';

        echo '<div class="profile-header">';
        echo '    <img src="' . htmlspecialchars($picture) . '" alt="Profile Image" class="profile-image">';
        echo '    <div class="profile-info">';
        echo '        <h1>' . htmlspecialchars($freelancerName) . '</h1>';
        echo '        <p class="profession">' . htmlspecialchars($profession) . '</p>';
        echo '        <p class="location">' . htmlspecialchars($address) . '</p>';
        echo '    </div>'; 
        echo '</div>'; 
        ?>

        <div class="tabs">
            <a href="#work" class="tab active" data-tab="work">WORK</a>
            <a href="#about" class="tab" data-tab="about">ABOUT</a>
        </div>
        <div class="hr"></div>

        <div class="content-section">
            <div id="workSection" class="work-section active-content"></div>
              
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
        <script src="../js/workClient.js"></script>
</body>
</html>