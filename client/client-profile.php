<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel ="stylesheet" href="../style/freelancer-profile.css">

    <style>
        /* Job Section Styles */
.job-section {
    margin-top: -30px;
    padding: 0 20px;
    margin-left: 30px;
    
}

.job-section h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}

.job-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    padding: 20px;
    transition: transform 0.2s;
    width: 90%;
}

.job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.job-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.job-header h3 {
    font-size: 18px;
    color: #444;
    margin: 0;
}

.job-budget {
    background-color: #f0f8ff;
    color: #0066cc;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: bold;
}

.job-category {
    margin-bottom: 15px;
}

.category-badge {
    background-color: #e6f7ff;
    color: #0099cc;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 14px;
}

.job-details p {
    color: #666;
    margin-bottom: 15px;
    line-height: 1.5;
}

.job-location {
    display: flex;
    gap: 15px;
    color: #888;
    font-size: 14px;
}

.job-location span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.job-actions {
    margin-top: 15px;
    display: flex;
    justify-content: flex-end;
}

.view-job-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.view-job-btn:hover {
    background-color: #45a049;
}

.no-jobs {
    text-align: center;
    padding: 40px 0;
}

.post-job-btn {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 4px;
    margin-top: 15px;
    transition: background-color 0.3s;
}

.post-job-btn:hover {
    background-color: #45a049;
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
                    <img class="profile" src="../image/prof.jpg" id="imageSubMenu">
                    <h4 id="nameSubMenu">Name</h4>
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
        <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image" id="profileImageDisplay">            
        <div class="profile-info">
                <h1 id="nameDisplay">name</h1>
                <p class="location" id="addressDisplay">address</p>
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
                <input type="text" id="editfirstName" name="editfname" required>
                <label for="lname">Last Name</label>
                <input type="text" id="editlastName" name="editlname" required>                
                <label for="address">Address</label>
                <input type="text" id="editUserAddress" name="editaddress">
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
            
        </div>
        <hr>
    </div>

    <div class="content-section">
    <div id="jobSection" class="job-section">
        <h2>My Posted Jobs</h2>
      <!--js-->
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

<script>
function viewJobDetails(jobId) {
    alert("Viewing job details for job ID: " + jobId);
}
</script>

<script src="../js/client.js"></script>
</body>
</html>