document.addEventListener("DOMContentLoaded", function(){
    initModal();
    getFreelancerById();
    
    document.getElementById("editAbout").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("editAboutModal").classList.display = "block";
    });
});

let aboutId = null;
function initModal() {
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'editAbout') {
            e.preventDefault();
            document.getElementById("editAboutModal").classList.add("show");
        }

        if (e.target && e.target.classList.contains('close')) {
            document.getElementById("editAboutModal").classList.remove("show");
        }
    });

    window.addEventListener('click', function(e) {
        const modal = document.getElementById("editAboutModal");
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });
}
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
        if(data.status === "success" && data.freelancerData){
            document.getElementById("userInfoDocument").innerHTML = "";
            document.getElementById("userInfoDocument").innerHTML += `
                <img src="../uploads/${data.freelancerData.profile_pic}" class="profile" alt="Profile">
                <h4>${data.freelancerData.first_name} ${data.freelancerData.last_name}</h4>
            `;

            document.getElementById("profileHeaderDocument").innerHTML = "";
            document.getElementById("profileHeaderDocument").innerHTML += `
                <img src="../uploads/${data.freelancerData.profile_pic}" alt="Profile Image" class="profile-image">            
                <div class="profile-info">
                    <h1>${data.freelancerData.first_name} ${data.freelancerData.last_name}</h1>
                    <p class="location">${data.freelancerData.address}</p>
                    <p class="follow-info">0 Followers | 20 Following</p>
                </div>
            `;

            getAboutById(data.freelancerData.about_id);

            document.getElementById("aboutUpdateForm").addEventListener("submit", function(event){
                event.preventDefault();
                updateAbout(data.freelancerData.about_id);
            });
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
    });
}


function updateAbout(id){
    const formData = {
        id: Number(id),
        contact: document.getElementById("editnumber").value,
        profession: document.getElementById("editprofession").value,
        skills: document.getElementById("editSkills").value,
        history: document.getElementById("editHistory").value,
        socials: document.getElementById("editSocials").value
    }

    fetch("../api/about_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Updated Successfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function getAboutById(id){
    fetch("../api/about_api.php?userId=" + Number(id))
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            
            document.getElementById("contactData").textContent = `Contact: ${data.aboutData.contact}`;
            document.getElementById("professionData").textContent = `Profession: ${data.aboutData.profession}`;
            document.getElementById("skillsData").textContent = `${data.aboutData.skills}`;
            document.getElementById("historyData").textContent = `${data.aboutData.history}`;
            document.getElementById("socialsData").textContent = `${data.aboutData.socials}`;

            document.getElementById("editnumber").value = data.aboutData.contact;
            document.getElementById("editprofession").value = data.aboutData.profession;
            document.getElementById("editSkills").value = data.aboutData.skills;
            document.getElementById("editHistory").value = data.aboutData.history;
            document.getElementById("editSocials").value = data.aboutData.socials;
        }
    })
    .catch(error => console.error(error));
}

function toggleMenu() {
    let subMenu = document.getElementById("subMenu");
    subMenu.classList.toggle("open");
}
