<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/freelancer-profile.css">
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
              <li><a href="client-explore.php">Explore</a></li>
              <li><a href="Find-Freelancer.php" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
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
                    <img class="profile" src="../image/prof.jpg" id="imageSubMenu">
                    <h4 id="nameSubMenu"></h4>
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
            <h1 id="nameDisplay"></h1>
            <p class="location" id="addressDisplay"></p>
        </div>
    </div>

    <div class="tabs">
        <a href="client-profile.php">MY PROFILE</a>
        <a href="client-profile-about.php" class="active">ABOUT</a>
    </div>
    <hr>
</div>

<div class="about-section">
    <div class="about-left">
        <h2>ABOUT YOU</h2>
        <p id="contactAbout"></p>
        <p id="professionAbout"></p>
        <br/>
        <h2>SKILLS</h2>
        <p id="skillsAbout"></p>
    </div>
    <div class="about-right">
        <h2>WORK HISTORY AND EXPERIENCE</h2>
        <p id="historyAbout"></p>
        <br/>
        <h2>SOCIALS</h2>
        <p id="socialsAbout"></p>
    </div>
    <button class="edit-about" id="editAbout">EDIT ABOUT</button>
</div>

<!--edit modal-->
<div id="editAboutModal" class="modal-about">
    <div class="modal-content-about">
        <span class="close_about" id="close_about">&times;</span>
        <h3>Edit About</h3>
        <form id="aboutUpdateForm">
            <div class="form-grid-about">
                <div class="form-group-about">
                    <h1>ABOUT YOU</h1>

                    <label for="editNumber">Contact</label>
                    <input type="text" id="editNumber" name="editNumber" placeholder="Contact">

                    <label for="editProfession">Profession</label>
                    <input type="text" id="editProfession" name="editProfession" placeholder="Profession">  
                    
                    <label for="editskill">Skills</label>
                    <textarea id="editSkills" placeholder="Skills"></textarea>

                    <label for="edit_History">Work History</label>
                    <textarea id="editHistory" placeholder="Work History & Experience"></textarea>

                    <label for="edit_Social">Socials</label>
                    <textarea id="editSocials" placeholder="Social Media"></textarea>
                </div>
            </div>
            <button type="submit" class="button-edit-about">Save Changes</button>
        </form>
    </div>
</div>

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open");
    }
</script>


<script src="../js/client-about.js"></script>

</body>
</html>