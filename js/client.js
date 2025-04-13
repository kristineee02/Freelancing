const openmodal = document.getElementById("editProfileModal");
const edit_profile = document.getElementById("EditProfile");
const closemodal = document.getElementsByClassName("close")[0];

edit_profile.onclick = function() {
    openmodal.style.display = "block";
}

closemodal.onclick = function() {
    openmodal.style.display = "none";
}