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
                    <img class="profile" src="../image/prof.jpg" id="imageDisplay">
                    <h4 id="nameDisplay">Kristine Sabuero</h4>
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
    <div class="discover-about">
        <div class="overlay-find-about"></div>
        <p class="info-about">
           <b> THE WORLD'S DESTINATION<br> FOR DESIGN.
           </b>
    </div>
    <p class="taskflow"><b>TASKFLOW</b></p>
    <div class="about">
        <div class="overlay-about-img"></div>
        <img class="about-img" src="../image/group.jpg" alt="group picture">
        <p class="about-text">
            Welcome to WorkHub, your ultimate freelancing platform designed to connect 
            skilled professionals with businesses and individuals seeking top-notch talent. 
            Whether you are a freelancer looking for new opportunities or a client aiming to 
            hire experts for your projects, WorkHub is built to make freelancing secure, 
            efficient, and rewarding.
            <br/><br/>

            Our platform offers a seamless experience, empowering freelancers to showcase their 
            skills while enabling clients to find the right talent quickly. With a user-friendly 
            interface, advanced search features, and secure payment gateways, WorkHub makes freelancing 
            easier than ever before.
            <br/><br/>

            At WorkHub, we believe in creating a dynamic environment where freelancers and clients 
            can collaborate effortlessly. Our mission is to build a trusted space where talent meets 
            opportunity, ensuring both parties can achieve their goals efficiently.
            <br/><br/>

            Join WorkHub today and take your freelancing journey to the next level!

        </p>
    </div>
        <div class="about-card">
            <strong>About us</strong>
        </div>
        <div class="mis-vis">
            <div class="mission" style="font-size: 1.4em;">
                <b>Mission</b>
                <p class="mission-list" style="font-size: .7em;">
                    Our mission is to empower freelancers and businesses by providing a dynamic, 
                    secure, and user-friendly platform that connects skilled professionals with 
                    clients seeking exceptional talent. We are dedicated to fostering a thriving 
                    ecosystem where creativity, expertise, and collaboration converge to deliver 
                    outstanding results. 
                </p>
            </div>
            <div class="vision" style="font-size: 1.4em;">
                <b>Vision</b>
                <p class="vision-list" style="font-size: .7em;">
                    Our vision is to become the leading global platform that revolutionizes the 
                    freelancing industry by creating limitless opportunities for professionals 
                    and businesses alike. We aspire to build a world where talent transcends 
                    geographical boundaries, enabling individuals to showcase their skills, connect 
                    with clients, and thrive in a flexible work environment.
                </p>
            </div>
        </div>
    <div class="developers">
        <b>Developers</b></div>
        <section class="developer-container">
            <div class="developer-card">
                <div class="developer-image">
                    <img src="../image/ui.png">
                    Kristine Sabuero
                    <h6>UX Designer</h6>
                </div>
            </div>
            <div class="developer-card">
                <div class="developer-image">
                <img src="../image/ui.png">
                Kristine Sabuero
                <h6>UX Designer</h6>
                </div>
          </div>
            <div class="developer-card">
                <div class="developer-image">
                <img src="../image/ui.png">
                Kristine Sabuero
                <h6>UX Designer</h6>
                </div>
            </div>
        </section>
        <section class="developer-container">
            <div class="developer-card">
                <div class="developer-image">
                    <img src="../image/ui.png">
                    Kristine Sabuero
                    <h6>UX Designer</h6>
                </div>
            </div>
            <div class="developer-card">
                <div class="developer-image">
                <img src="../image/ui.png">
                Kristine Sabuero
                <h6>UX Designer</h6>
                </div>
          </div>
            <div class="developer-card">
                <div class="developer-image">
                <img src="../image/ui.png">
                Kristine Sabuero
                <h6>UX Designer</h6>
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
});
</script>
</body>
</html>