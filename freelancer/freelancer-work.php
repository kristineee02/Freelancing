
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancing</title>
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
              <li><a href="Explore.php">Explore</a> </li>
             <li> <a href="Find-Job.php" class="tight-text">Find Jobs</a> </li>
             <li><a href="buy-table.php" class="tight-text">Buy Work</a></li>
             <li> <a href="About.php">About</a></li>
            </ul>
        </div>

        <div class="notif-profile">
            <img src="../image/3119338.png" alt="Notification icon" class="notif" id="notifBtn" />
            <div class="notification-popup" id="notifPopup">
                <p><strong>New Message:</strong> Your job application has been viewed!</p>
                <p><strong>Reminder:</strong> Update your profile today.</p>
            </div>
            <img class="profile" src="../image/prof.jpg" alt="profile" id="profileImageSubMenuId" onclick="toggleMenu()">
        </div>

        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info" id="userInfoDocument">
                    <img class="profile" alt="Profile" id="imageDisplay">
                    <h4 id="nameDisplay">name</h4>
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

    <div class="profile-container">
        <div class="profile-header" id="profileHeaderDocument">
            <img src="../image/yellow circle.png" alt="Profile Image" class="profile-image" id="imageDisplay2">            
            <div class="profile-info">
                <h1 id="nameDisplay2">name</h1>
                <p class="location" id="addressDisplay">address</p>
                <button class="edit-profile" id="EditProfile">EDIT PROFILE</button>
            </div>
        </div>

        <!--EDIT PROFILE-->

        <div id="editProfileModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Update Profile</h3>
                <form id="profileUpdateForm" action="freelancer-work.php" method="POST" enctype="multipart/form-data">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="editfirstName" name="editfname" value="First Name" required>
                            <label for="lname">Last Name</label>
                            <input type="text" id="editlastName" name="editlname" value="Last Name" required>                
                            <label for="address">Address</label>
                            <input type="text" id="editUserAddress" name="editaddress" value="Address">
                            <div class="file-input">
                                <label for="editProfile" class="profile-pic">Profile Picture</label>
                                <input type="file" id="edit-prof" name="editProfile" accept="image/*">
                            </div>                
                        </div>
                    </div>
                    <button type="submit" class="button-edit">Save Changes</button>
                </form>
            </div>
        </div>

        <div class="tabs">
            <a href="freelancer-work.php" class="active">WORK</a>
            <a href="freelancer-about.php">ABOUT</a>
        </div>
        <div class="hr"></div>
    </div>

    <div class="content-section" id="workDisplay">
        <div class="content-box active add-box" onclick="togglePopup()">+</div>
    </div>

    <div class="publish-popup-overlay" id="PublishPopupOverlay" onclick="closePopup()"></div>

    <form class="publishing-popup" id="pubpopup" enctype="multipart/form-data">
        <button type="button" class="close-btn" onclick="closePopup()">X</button>
        <h3>CREATE POST</h3>
        <input type="text" name="title" placeholder="Title" id="Title" required>
        <div id="FilePreviewContainer" class="file-preview-container"></div>
        <div id="postForm">
            <label class="FileInputLabel">
                ADD PICTURE +
                <input type="file" id="fileInput" hidden>
            </label>
            <textarea name="description" id="Description" class="description" placeholder="Description" required></textarea>
            <select name="category" id="Category" required>
                <option value="" disabled selected>Select Category</option>
                <option value="ANIMATION">ANIMATION</option>
                <option value="GRAPHIC DESIGN">GRAPHIC DESIGN</option>
                <option value="WEBSITE DESIGN">WEB DESIGN</option>
                <option value="PRODUCT DESIGN">PRODUCT DESIGN</option>
                <option value="ILLUSTRATION">ILLUSTRATION</option>
                <option value="MOBILE DESIGN">MOBILE DESIGN</option>
                <option value="WRITING">WRITING</option>
            </select>
            <div class="btn-container">
                <button type="button" class="cancel-btn" onclick="closePopup()">CANCEL</button>
                <button type="submit" class="publish-btn">PUBLISH</button>
            </div>
        </div>
    </form>

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
            });
        });
    </script>

    <script>
        const fileInput = document.getElementById("fileInput");
        const FilePreviewContainer = document.getElementById("FilePreviewContainer");
        let selectedFiles = [];

        fileInput.addEventListener("change", function () {
            const newFiles = Array.from(fileInput.files);
            newFiles.forEach((file) => {
                selectedFiles.push(file);
            });
            updatePreviews();
        });

        function updatePreviews() {
            FilePreviewContainer.innerHTML = "";
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewBox = document.createElement("div");
                    previewBox.classList.add("file-preview-box");
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    const RemoveBtn = document.createElement("button");
                    RemoveBtn.innerText = "X";
                    RemoveBtn.classList.add("remove-btn");
                    RemoveBtn.onclick = () => {
                        selectedFiles.splice(index, 1);
                        updatePreviews();
                    };
                    previewBox.appendChild(img);
                    previewBox.appendChild(RemoveBtn);
                    FilePreviewContainer.appendChild(previewBox);
                };
                reader.readAsDataURL(file);
            });
        }

        function togglePopup() {
            document.getElementById("pubpopup").style.display = "block";
            document.getElementById("PublishPopupOverlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("pubpopup").style.display = "none";
            document.getElementById("PublishPopupOverlay").style.display = "none";
            selectedFiles = [];
            updatePreviews();
        }

        document.getElementById("postForm").addEventListener("submit", function (e) {
            e.preventDefault(); 
            alert("Post Published with " + selectedFiles.length + " file(s)!"); 
            closePopup();
        });
    </script>

    <script src="../js/work.js"></script>

</body>
</html>
