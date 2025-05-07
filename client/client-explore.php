<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/clients.css">
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
        <img class="picture" src="../image/taskflow-logo.jpg">

        <div class="dashboard">
            <ul>
              <li><a href="client-explore.php"  class="active-dash">Explore</a>  </li>
             <li> <a href="Find-Freelancer.php" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
             <div class="dropdown_menu">
                <ul>
                    <li><a href="client-freelancer-work.php" class="tight-text">Post Job</a></li>
                </ul>
             </div>
             <li><a href="application-home.php">Application</a></li>
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
                    <img class="profile" src="../image/prof.jpg" id="imageDisplay">
                    <h4 id="nameDisplay">Name</h4>
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
    <div class="discover">
        <div class="overlay"></div>
        <p class="info">
            <b>DISCOVER JOBS THAT BEST ALIGN<br/>WITH YOUR SKILLS
            </b><br/><br/>
            <p class="text">Be Creative and Show your Imaginative Mind</p>
        </p>
        <div class="search-bar">
            <input type="text" placeholder="What are you looking for?" name="search" oninput="searchWorks()">
            <button onclick="searchWorks()">Search</button>
        </div>
    </div>
    <div class="carousel-container">
        <div class="carousel-slide" id="carouselSlide">
            <div class="slide" onclick="filterByCategory('ANIMATION')" style="cursor: pointer;">ANIMATION</div>
            <div class="slide" onclick="filterByCategory('GRAPHIC DESIGN')" style="cursor: pointer;">GRAPHIC DESIGN</div>
            <div class="slide" onclick="filterByCategory('PRODUCT DESIGN')" style="cursor: pointer;">PRODUCT DESIGN</div>
            <div class="slide" onclick="filterByCategory('WEB DESIGN')" style="cursor: pointer;">WEB DESIGN</div>
            <div class="slide" onclick="filterByCategory('ILLUSTRATION')" style="cursor: pointer;">ILLUSTRATION</div>
            <div class="slide" onclick="filterByCategory('MOBILE DESIGN')" style="cursor: pointer;">MOBILE DESIGN</div>
            <div class="slide" onclick="filterByCategory('WRITING')" style="cursor: pointer;">WRITING</div>
        </div>
        <button class="carousel-btn prev" onclick="moveSlide(-1)">&lt;</button>
        <button class="carousel-btn next" onclick="moveSlide(1)">&gt;</button>
    </div>

    <select id="FilterCategory" onchange="filterEmployee()" class="filter">
        <option value="">Filter</option>
        <option value="new">New</option>
        <option value="popular">Popular</option>
    </select>

    <div id="worksContainer">
       <!--js-->
    </div>

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu(){
            subMenu.classList.toggle("open");
        }
    </script>

    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        const visibleSlides = 4.2;

        function moveSlide(direction) {
            const maxIndex = totalSlides - visibleSlides;
            if (direction === 1 && slideIndex < maxIndex) {
                slideIndex++;
            } else if (direction === -1 && slideIndex > 0) {
                slideIndex--;
            }
            const offset = -slideIndex * (100 / visibleSlides);
            document.getElementById('carouselSlide').style.transform = `translateX(${offset}%)`;
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
        function filterEmployee() {
            console.log("Filter selected: " + document.getElementById("FilterCategory").value);
        }
    </script>

    <script src="../js/clientExplore.js"></script>t
</body>
</html>