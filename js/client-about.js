document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("editAbout").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("editAboutModal").classList.add("show");

    });

    document.getElementById("close_about").addEventListener("click", function(event){
        event.preventDefault();
        document.getElementById("editAboutModal").classList.remove("show");

    });

    getClientById();
});

function getClientById(){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            return fetch(`../api/client_api.php?userId=${data.userId}`, {
                method: "GET",
                headers: {"Content-Type": "application/json"}
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("nameSubMenu").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            document.getElementById("addressDisplay").textContent = `${data.clientData.address}`;
            document.getElementById("profileImageDisplay").src = '../uploads/' + data.clientData.profile_pic;
            document.getElementById("imageSubMenu").src = '../uploads/' + data.clientData.profile_pic;
            getAbout(data.clientData.about_id);
        }
    })
    .catch(error => console.error(error));
}

function getAbout(id){
    fetch(`../api/about_api.php?userId=${id}`)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("contactAbout").textContent = `CONTACT: ${data.aboutData.contact != "" ? data.aboutData.contact : "Not Specified"}`;
            document.getElementById("professionAbout").textContent = `PROFESSION: ${data.aboutData.profession != "" ? data.aboutData.profession : "Not Specified"}`;
            document.getElementById("skillsAbout").textContent = `${data.aboutData.skills != "" ? data.aboutData.skills : "Not Specified"}`;
            document.getElementById("historyAbout").textContent = `${data.aboutData.history != "" ? data.aboutData.history : "Not Specified"}`;
            document.getElementById("socialsAbout").textContent = `${data.aboutData.socials != "" ? data.aboutData.socials : "Not Specified"}`;

            document.getElementById("editNumber").value = data.aboutData.contact;
            document.getElementById("editProfession").value = data.aboutData.profession;
            document.getElementById("editSkills").value = data.aboutData.skills;
            document.getElementById("editHistory").value = data.aboutData.history;
            document.getElementById("editSocials").value = data.aboutData.socials;

            document.getElementById("editAboutModal").addEventListener("submit", function(event){
                event.preventDefault();
                updateAbout(data.aboutData.about_id);
            });
        }
    })
    .catch(error => console.error(error));
}

function updateAbout(aboutId){
    const formData = {
        id: Number(aboutId),
        contact: document.getElementById("editNumber").value,
        profession: document.getElementById("editProfession").value,
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