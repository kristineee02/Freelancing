document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editProfileModal");
    const editProfileBtn = document.getElementById("EditProfile");
    const closeBtn = modal.querySelector(".close");

    editProfileBtn.onclick = function () {
        modal.style.display = "block";
    };

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };
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
    
