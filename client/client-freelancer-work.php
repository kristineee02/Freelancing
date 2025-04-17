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
                    <h4>Kristine Sabuero</h4>
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
    <div class="discover-find-job-freelancer">
        <div class="overlay-job"></div>
        <p class="info-find-job-freelancer"><b>
            START YOUR PROJECT WITH AN EXPERT SUPPORT
        </b></p>
        <p class="side">Let us help you find the perfect designer for your project</p>
    </div>

    <fieldset class="form-container">
        <h2 class="text-proj">TELL US ABOUT YOUR PROJECT</h2>
         <br><br>
         <form class="form-project">
             <label for="name" class="label-project">Name</label>
             <input type="text" id="name" placeholder="Enter your name here"  class="input-proj">
 
             <label for="email" class="label-project">Email</label>
             <input type="email" id="email" placeholder="Enter your email here" class="input-proj">
 
             <label class="project-category">Project Category</label>
             <div class="radio-group">
                 <label class="radio"><input type="radio" name="category"> Animation</label>
                 <label class="radio"><input type="radio" name="category"> Animation</label>
                 <label class="radio"><input type="radio" name="category"> Animation</label>
                 <label class="radio"><input type="radio" name="category"> Animation</label>
                 <label class="radio"><input type="radio" name="category"> Animation</label>
                 <label class="radio"><input type="radio" name="category"> Animation</label>
             </div>
 
             <label class="project-description">Project Description</label>
             <textarea placeholder="Describe your project" class="textholder"></textarea>
 
             <label for="timeframe" class="label-project">Timeframe</label>
             <input type="text" id="timeframe" placeholder="" class="input-proj">
 
             <label for="budget" class="label-project">Budget</label>
             <input type="text" id="budget" placeholder="" class="input-proj">
 
             <label for="business" class="label-project">Business Name (optional)</label>
             <input type="text" id="business" placeholder="" class="input-proj">
 
             <button type="submit" class="submit-project">Submit</button>
         </form>
     </fieldset>

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
</body>
</html>