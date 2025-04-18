<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");

$firstName = $_SESSION['firstName'] ?? '';
$lastName = $_SESSION['lastName'] ?? '';
$fullName = trim($firstName . " " . $lastName);

// Query to fetch all posts for the explore page
$stmt = $db->prepare("
    SELECT w.*, f.firstname, f.lastname 
    FROM work w
    JOIN freelancer f ON w.freelancer_id = f.account_id
    ORDER BY work_id DESC
");
$stmt->execute();
$works = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
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
              <li><a href="client-explore.php" class="active-dash">Explore</a>  </li>
             <li> <a href="Find-Freelancer.php" class="tight-text">Find Designer  <i class="fa fa-caret-down"></i></a> 
             <div class="dropdown_menu">
                <ul>
                    <li><a href="client-freelancer-work.php" class="tight-text">Post Job</a></li>
                </ul>
             </div>
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

    <div id="worksContainer">
        <?php
        // Check if there are any works
        if (count($works) > 0) {
            $worksPerRow = 4;
            $totalWorks = count($works);
            
            // Loop through works in groups of 4 to create rows
            for ($i = 0; $i < $totalWorks; $i += $worksPerRow) {
                echo '<section class="container">';
                
                // Create up to 4 cards per row
                for ($j = $i; $j < min($i + $worksPerRow, $totalWorks); $j++) {
                    $work = $works[$j];
                    $picture = htmlspecialchars("../api/" . $work['picture']);
                    $fullName = trim($work['firstname'] . ' ' . $work['lastname']);
                    
                    echo '<div class="card" data-id="freelancer-webdesign.php?id=' . $work['work_id'] . '" data-category="' . htmlspecialchars($work['category']) . '">';
                    echo '    <div class="card-image" style="background-image: url(\'' . $picture . '\');">';
                    echo '    </div>';
                    echo '    <div class="footer">';
                    echo '        <h5 id="text">' . htmlspecialchars($fullName) . '</h5>';
                    echo '        <span>&hearts; 0</span>'; // You can add likes functionality later
                    echo '    </div>';
                    echo '</div>';
                }
                
                echo '</section>';
            }
        } else {
            echo '<div class="no-works-message">No works available. Be the first to create a post!</div>';
        }
        ?>
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