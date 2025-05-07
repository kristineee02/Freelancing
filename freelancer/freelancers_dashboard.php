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
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <div class="logo">
        <img class="picture" src="../image/logo.png">
        <p>TaskFlow</p>

        <div class="dashboard">
            <ul>
              <li><a href="Explore.php">Explore</a> </li>
             <li> <a href="Find-Job.php" class="tight-text">Find Jobs</a> </li>
             <li><a href="buy-table.php">Buy</a></li>
             <li> <a href="About.php" class="active-dash">About</a></li>
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
                    <h4>name</h4>
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

    <div class="discover">
        <div class="overlay"></div>
        <p class="info">
            <b>DISCOVER JOBS THAT BEST ALIGN<br/>WITH YOUR SKILLS</b><br/><br/>
            <p class="text">Be Creative and Show your Imaginative Mind</p>
        </p>
        <div class="search-bar">
            <input type="text" placeholder="What are you looking for?" name="search">
            <button>Search</button>
        </div>
    </div>

    <div class="carousel-container">
        <div class="carousel-slide" id="carouselSlide">
            <div class="slide">ANIMATION</div>
            <div class="slide">GRAPHIC DESIGN</div>
            <div class="slide">PRODUCT DESIGN</div>
            <div class="slide">WEB DESIGN</div>
            <div class="slide">ILLUSTRATION</div>
            <div class="slide">MOBILE DESIGN</div>
            <div class="slide">WRITING</div>
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
        <section class="container">
            <div class="card" data-id="freelancer-webdesign.php?id=1" data-category="GRAPHIC DESIGN">
                <div class="card-image" style="background-image: url('../image/sample1.jpg');"></div>
                <div class="footer">
                    <h5 id="text">John Doe</h5>
                    <span>&hearts; 0</span>
                </div>
            </div>

            <div class="card" data-id="freelancer-webdesign.php?id=2" data-category="WEB DESIGN">
                <div class="card-image" style="background-image: url('../image/sample2.jpg');"></div>
                <div class="footer">
                    <h5 id="text">Jane Smith</h5>
                    <span>&hearts; 0</span>
                </div>
            </div>

            <div class="card" data-id="freelancer-webdesign.php?id=3" data-category="ANIMATION">
                <div class="card-image" style="background-image: url('../image/sample3.jpg');"></div>
                <div class="footer">
                    <h5 id="text">Michael Brown</h5>
                    <span>&hearts; 0</span>
                </div>
            </div>

            <div class="card" data-id="freelancer-webdesign.php?id=4" data-category="ILLUSTRATION">
                <div class="card-image" style="background-image: url('../image/sample4.jpg');"></div>
                <div class="footer">
                    <h5 id="text">Emily White</h5>
                    <span>&hearts; 0</span>
                </div>
            </div>
        </section>
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
        const designCards = document.querySelectorAll('.card');

        designCards.forEach(Card => {
            Card.addEventListener('click', function() {
                const redirectPage = this.getAttribute('data-id');
                window.location.href = redirectPage;
            });
        });
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

    <script src="../js/explore.js"></script>

</body>
</html>
