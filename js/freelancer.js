document.addEventListener("DOMContentLoaded", function () {
    const openmodal = document.getElementById("editProfileModal");
    const edit_profile = document.getElementById("EditProfile");
    const closemodal = document.getElementsByClassName("close")[0];
    
    edit_profile.onclick = function() {
        openmodal.style.display = "block";
    }
    
    closemodal.onclick = function() {
        openmodal.style.display = "none";
    }
    });
    
    
    document.addEventListener("DOMContentLoaded", function () {
        const editAboutModal = document.getElementById("editAboutModal");
        const editAboutBtn = document.getElementById("editAbout");
        const closeAbout = document.getElementsByClassName("close_about")[0];
    
        editAboutBtn.onclick = function () {
            editAboutModal.style.display = "block";
        };
    
        closeAbout.onclick = function () {
            editAboutModal.style.display = "none";
        };
    });
    