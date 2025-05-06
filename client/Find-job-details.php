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
    <link rel ="stylesheet" href="../style/clients.css">
</head>
<body>
    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="client-explore.php">Explore</a>  </li>
             <li> <a href="Find-Freelancer.php" class="tight-text active-dash">Find Designer  <i class="fa fa-caret-down"></i></a> 
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
                    <img class="profile" src="../image/prof.jpg"  id="imageDisplay">
                    <h4 id="nameDisplay"></h4>
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
    <hr>

    <section class="job-details">
        <p class="details-job">JOB DETAILS</h2>
        <p class="skill-name" id="skillNameId">WEBSITE DESIGNER</h1>
        <div class="job-content">
            <div class="job-description" >
                <p id="jobDescription">We are seeking a highly creative and design-driven Content Analyst to join our dynamic team. As a Content Analyst, you will be building websites using our website builder platform for our diverse range of small business customers. If you have an eye for great design, understand how to create engaging online experiences, and enjoy helping businesses stand out, this is the perfect role for you.</p>
                <h3>Job requirements</h3>
                <h4>Education:</h4>
                <p id="educationId"></p>
                <h4>Experience:</h4>
                <p id="experienceId"></p>
            </div>
            <div class="company-info">
                <p id="locationId"></p>
                <p id="datePostedId"></p>
                <p id="timeframeId"></p>
                <p id="budgetId"></p>
            </div>
        </div>
    </section>

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


<script>
    document.addEventListener('DOMContentLoaded', function () {
    
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const freelancerId = data.userId;
            return fetch("../api/client_api.php?userId=" + freelancerId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageDisplay").src = `../uploads/${data.clientData.profile_pic}`;
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
        }
    })
    .catch(error => console.error(error));
    });
</script>

<script src="../js/clientFindJobDetails.js"></script>
</body>
</html>