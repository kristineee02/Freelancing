document.addEventListener("DOMContentLoaded", function(){
    getFreelancerById();
    
});



function getFreelancerById() {
    const url = new URL(window.location.href);
    const freelancerId = url.searchParams.get("userId");
    fetch(`../api/freelancer_api.php?userId=${freelancerId}`, {
        method: "GET",
        headers: {"Content-Type": "application/json"},
        credentials: "include"})
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("nameDisplay2").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
            document.getElementById("imageDisplay2").src = `../uploads/${data.freelancerData.profile_pic}`;
            document.getElementById("professionId").textContent = `${data.freelancerData.profession}`;
            document.getElementById("addressId").textContent = `${data.freelancerData.address}`;

            document.getElementById("workIdNav").addEventListener("click", function(){
                window.location.href = `freelancerprofile.php?userId=${data.freelancerData.freelancer_id}`;
            });
            getAboutById(data.freelancerData.about_id);
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
            
            document.getElementById("contactData").textContent = `Contact: ${data.aboutData.contact}`;
            document.getElementById("professionData").textContent = `Profession: ${data.aboutData.profession}`;
            document.getElementById("skillsData").textContent = `${data.aboutData.skills}`;
            document.getElementById("historyData").textContent = `${data.aboutData.history}`;
            document.getElementById("socialsData").textContent = `${data.aboutData.socials}`;
        }
    })
    .catch(error => console.error(error));
}