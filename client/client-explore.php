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
              <li><a href="client-explore.html" class="active-dash">Explore</a>  </li>
             <li> <a href="Find-Freelancer.html" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
             <div class="dropdown_menu">
                <ul>
                    <li><a href="client-freelancer-work.html" class="tight-text">Post Job</a></li>
                </ul>
             </div>
            </li>
             <li> <a href="client-about.html">About</a></li>
            </ul>
        </div>

        <div class="notif-profile">
        <img class="notif" src="../image/3119338.png" alt="notif">
        <img class="profile" src="../image/prof.jpg" alt="profile" onclick="toggleMenu()">
        </div>

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img class="profile" src="../image/prof.jpg">
                    <h4>Kristine Sabuero</h4>
                </div>
                <hr>

                <a href="freelancer-work.html" class="sub-menu-link">
                    <img src="../image/prof.jpg">
                    <p>Profile</p>
                    <span>></span>
                </a>
                <a href="UserLogIn.html" class="sub-menu-link" onclick="logout()">
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

        <section class="container">
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                    <img src="../image/ui.png" alt="UI Design">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h5>
                    <span>&hearts; 100</span>
                </div>
            </div>            
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>            
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
        </section>
        
        <section class="container">
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
<<<<<<<< HEAD:client/client-explore.php
                    <img src="../image/ui.png">
========
                    <img src="./image/ui.png">
>>>>>>>> 3853dc42f7ee191f257ec6f4f9638e8628d274b7:client/client-explore.html
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                    <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
                </div>
            </div>
            <div class="card" data-id="client-webdesign.html">
                <div class="card-image">
                <img src="../image/ui.png">
                </div>
                <div class="footer">
                    <h5 id="text">Name</h6>
                    <span>&hearts; 100</span>
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
        
        window.location.href = "Home.html"; 
    }
</script>

<script>
    const designCards = document.querySelectorAll('.card');

    // Add click event listener to each card
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
</body>
</html>