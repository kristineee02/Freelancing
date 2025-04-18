<?php
session_start();
require_once '../class/Client.php';

$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");


// Ensure user is logged in
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: ../login/UserLogin.php");
    exit;
}

$client = new Client($db);


// Load session data
$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);
$address = $_SESSION['address'] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editfname'])) {
    $newFirstName = $_POST['editfname'];
    $newLastName = $_POST['editlname'];
    $newAddress = $_POST['editaddress'];
    $profilePicPath = null;

    // Handle file upload
    if (isset($_FILES['editProfile']) && $_FILES['editProfile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../Uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = uniqid() . '-' . basename($_FILES['editProfile']['name']);
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['editProfile']['tmp_name'], $uploadPath)) {
            $profilePicPath = $uploadPath;
        } else {
            echo "File upload failed.";
        }
    }
    
    // Update profile
    if ($client->updateProfile($userId, $newFirstName, $newLastName, $newAddress, $profilePicPath)) {
        // Update session data
        $_SESSION['firstName'] = $newFirstName;
        $_SESSION['lastName'] = $newLastName;
        $_SESSION['address'] = $newAddress;
        if ($profilePicPath) {
            $_SESSION['profile_pic'] = $profilePicPath;
        }
        header("Location: client-profile.php");
        exit;
    } else {
        echo "Error updating profile.";
    }
}    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel ="stylesheet" href="../style/freelancer-profile.css">
</head>
<body>

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
               </li>
             <li> <a href="client-about.php" >About</a></li>
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

    <div class="profile-container">
        <div class="profile-header">
        <img src="<?php echo $_SESSION['profile_pic'] ?? '../image/yellow circle.png'; ?>" alt="Profile Image" class="profile-image">            
        <div class="profile-info">
                <h1> <?php echo htmlspecialchars($fullName); ?></h1>
                <p class="location"><?php echo htmlspecialchars($address); ?></p>
                <p class="follow-info">0 Followers  |  20 Following</p>
                <button class="edit-profile" id="EditProfile">EDIT PROFILE</button>
            </div>
        </div>

        <!--EDIT PROFILE-->

          <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Update Profile</h3>
            <form id="profileUpdateForm" action="client-profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="editfirstName" name="editfname" value="<?php echo htmlspecialchars($firstName); ?>" required>
                <label for="lname">Last Name</label>
                <input type="text" id="editlastName" name="editlname" value="<?php echo htmlspecialchars($lastName); ?>" required>                
                <label for="address">Address</label>
                <input type="text" id="editUserAddress" name="editaddress" value="<?php echo htmlspecialchars($address); ?>">
                    <div class="file-input">
                    <label for="editProfile" class="profile-pic">Profile Picture</label>
                    <input type="file" id="edit-prof" name="editProfile" accept="image/*">
                    </div>                
                    </div>
                </div>
            <button type="submit" class ="button-edit">Save Changes</button>
            </form>
        </div>
        </div>
    

        <div class="tabs">
            <a href="client-profile.php" class="active">MY PROFILE</a>
            <a href = "client-profile-about.php">ABOUT</a>
           <a href = "client-likedpost.php">LIKED POST</a>
            
        </div>
        <div class="hr">            
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

<script src="../js/client.js"></script>

</body>
</html>