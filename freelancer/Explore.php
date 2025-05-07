<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
    <link rel ="stylesheet" href="../style/style.css">
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
                <div class="user-info" id="userInfoDocument">
                    <img class="profile" src="../image/prof.jpg">
                    <h4>John Doe</h4>
                </div>
                <hr>

                <a href="freelancer-work.php" class="sub-menu-link">
                    <img src="../image/prof.jpg">
                    <p>Profile</p>
                    <span>></span>
                </a>
                <a href="?action=logout" class="sub-menu-link" name="logout">
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
           <b> DISCOVER JOBS THAT BEST ALIGN<br/>WITH YOUR SKILLS
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
    <button class="carousel-btn prev" onclick="moveSlide(-1)"><</button>
    <button class="carousel-btn next" onclick="moveSlide(1)">></button>
</div>

<select id="FilterCategory" onchange="filterEmployee()" class="filter">
    <option value="">Filter</option>
    <option value="new">New</option>
    <option value="popular">Popular</option>
</select>
        
        <div id="worksContainer">
    <!--
            <section class="container" id="sectionContainer">
                <div class="card" data-id="freelancer-webdesign.php?id=1" data-category="web design">
                    <div class="card-image" style="background-image: url('../api/images/work1.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">John Smith</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=2" data-category="graphic design">
                    <div class="card-image" style="background-image: url('../api/images/work2.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Sarah Johnson</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=3" data-category="illustration">
                    <div class="card-image" style="background-image: url('../api/images/work3.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Michael Brown</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=4" data-category="animation">
                    <div class="card-image" style="background-image: url('../api/images/work4.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Emily Davis</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
            </section>
            <section class="container">
                <div class="card" data-id="freelancer-webdesign.php?id=5" data-category="mobile design">
                    <div class="card-image" style="background-image: url('../api/images/work5.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">David Wilson</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=6" data-category="writing">
                    <div class="card-image" style="background-image: url('../api/images/work6.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Jessica Taylor</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=7" data-category="product design">
                    <div class="card-image" style="background-image: url('../api/images/work7.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Robert Martinez</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
                <div class="card" data-id="freelancer-webdesign.php?id=8" data-category="web design">
                    <div class="card-image" style="background-image: url('../api/images/work8.jpg');">
                    </div>
                    <div class="footer">
                        <h5 id="text">Amanda Lewis</h5>
                        <span>&hearts; 0</span>
                    </div>
                </div>
            </section>
    -->
        </div>
        <script src="../js/explore.js"></script>

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