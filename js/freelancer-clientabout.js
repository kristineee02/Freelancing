document.addEventListener("DOMContentLoaded", function(){
    getClientById();
    getFreelancerById();
});

function getFreelancerById() {
    fetch("../api/store_session.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"},
        credentials: "include"
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success" && data.userId){
            return fetch(`../api/freelancer_api.php?userId=${data.userId}`, {
                method: "GET",
                headers: {"Content-Type": "application/json"},
                credentials: "include"
            });
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageSubMenu").src = `../uploads/${data.freelancerData.profile_pic}`;
            document.getElementById("nameSubMenu").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
    });
}

function getClientById() {
    const url = new URL(window.location.href);
    const clientId = url.searchParams.get("id");
    
    fetch(`../api/client_api.php?userId=${clientId}`, {
        method: "GET",
        headers: {"Content-Type": "application/json"},
        credentials: "include"
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            document.getElementById("profileImageDisplay").src = `../uploads/${data.clientData.profile_pic}`;
            document.getElementById("addressDisplay").textContent = `${data.clientData.address}`;
            
            getAboutById(data.clientData.about_id);
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
    });
}

function getAboutById(id){
    fetch("../api/about_api.php?userId=" + Number(id))
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            
            document.getElementById("contactAbout").textContent = `Contact: ${data.aboutData.contact}`;
            document.getElementById("professionAbout").textContent = `Profession: ${data.aboutData.profession}`;
            document.getElementById("skillsAbout").textContent = `${data.aboutData.skills}`;
            document.getElementById("historyAbout").textContent = `${data.aboutData.history}`;
            document.getElementById("socialsAbout").textContent = `${data.aboutData.socials}`;
        }
    })
    .catch(error => console.error(error));
}

document.addEventListener("DOMContentLoaded", function() {
    const notifBtn = document.getElementById("notifBtn");
    const notifPopup = document.getElementById("notifPopup");
    
    notifBtn.addEventListener("click", function() {
        notifPopup.classList.toggle("show");
    });
    
    document.addEventListener("click", function(event) {
        if (!notifBtn.contains(event.target) && !notifPopup.contains(event.target)) {
            notifPopup.classList.remove("show");
        }
    });
});

