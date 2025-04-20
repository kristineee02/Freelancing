<?php
session_start();
include '../api/database.php';
include '../class/Client.php';

$client_id = $_SESSION['user_id'];
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
         <form class="form-project" method="POST" id="projectForm" action="../api/job_api.php">
         <label for="name" class="label-project">Name</label>
             <input type="text" id="name" name="name" placeholder="Enter your full name"  class="input-proj" required>
 
             <label for="email" class="label-project">Email</label>
             <input type="email" id="email" name="email" placeholder="Enter your email" class="input-proj" required>

             <label for="business" class="label-project">Project Title</label>
             <input type="text" id="business" name="business_name" placeholder="Project Title" class="input-proj" required>
 
             <label class="project-category">Project Category</label>
             <div class="radio-group" required>
                 <label class="radio"><input type="radio" name="category" value="Animation"> Animation</label>
                 <label class="radio"><input type="radio" name="category" value="Graphic Design"> Graphic Design</label>
                 <label class="radio"><input type="radio" name="category" value="Product Design"> Product Design</label>
                 <label class="radio"><input type="radio" name="category" value="Web Design"> Web Design</label>
                 <label class="radio"><input type="radio" name="category" value="Illustration"> Illustration</label>
                 <label class="radio"><input type="radio" name="category" value="Mobile Design"> Mobile Design</label>
                 <label class="radio"><input type="radio" name="category" value="Writing"> Writing</label>
             </div>
 
             <label class="project-description">Project Description</label>
             <textarea placeholder="Describe your project" class="textholder" name="description" required></textarea>

             <label for="location" class="label-project">Location</label>
             <input type="text" id="location" name="location" placeholder="Location" class="input-proj" required>
 
             <label for="start-date" class="label-project">Start Date</label>
             <input type="date" id="start-date" name="start_date" class="input-proj" required>

             <label for="end-date" class="label-project">End Date</label>
             <input type="date" id="end-date" name="end_date" class="input-proj" required>
 
             <label for="budget" class="label-project">Budget</label>
             <input type="number" name="budget" placeholder="budget" class="input-proj" required>

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
      // Form validation and submission
      form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Additional validation if needed
                const startDate = new Date(document.getElementById('start-date').value);
                const endDate = new Date(document.getElementById('end-date').value);
                
                if (endDate <= startDate) {
                    formMessage.innerHTML = '<p style="color: red;">End date must be after start date</p>';
                    return;
                }
                
                // Submit form
                const formData = new FormData(form);
                
                fetch('../api/job_api.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        formMessage.innerHTML = '<p style="color: green;">Job posted successfully!</p>';
                        setTimeout(() => {
                            window.location.href = 'client-explore.php?success=1';
                        }, 1500);
                    } else {
                        formMessage.innerHTML = `<p style="color: red;">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    formMessage.innerHTML = '<p style="color: red;">Error submitting form. Please try again.</p>';
                    console.error('Error:', error);
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