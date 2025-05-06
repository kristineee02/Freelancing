document.addEventListener("DOMContentLoaded", function(){
    getFreelancerById();
    name();
});

function getFreelancerById(){
    const url = new URL(window.location.href);
    const freelancerId = url.searchParams.get("userId");

    fetch(`../api/freelancer_api.php?userId=${freelancerId}`)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("nameDisplayId").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
            document.getElementById("professionId").textContent = `${data.freelancerData.profession}`;
            document.getElementById("addressId").textContent = `${data.freelancerData.address}`;
            document.getElementById("imageDisplayId").src = `../uploads/${data.freelancerData.profile_pic}`;

            getWork(data.freelancerData.freelancer_id);
            document.getElementById("aboutSection").addEventListener("click", function(event){
                event.preventDefault();
                window.location.href = `freelancer-about.php?userId=${data.freelancerData.freelancer_id}`;
            });
        }
    })
    .catch(error => console.error(error));
}

function name(){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const freelancerId = data.userId;
            return fetch("../api/client_api.php?userId=" + freelancerId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageDisplay").src = `../uploads/${data.clientData.profile_pic}`;
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            
        }
    })
    .catch(error => console.error(error));
}

function getWork(freelancerId){
    fetch(`../api/work_api.php?freelancerId=${freelancerId}`)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            data.workData.forEach(work => {
                document.getElementById("workSection").innerHTML += `
                    <div class="work-box" 
                        style="background-image: url('../uploads/${work.picture}');
                                background-size: cover;
                                background-position: center;" data-id="${work.work_id}" data-freelancer-id="${freelancerId}">
                    </div>
                `;
            });

            document.querySelectorAll(".work-box").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    window.location.href = `buy-client.php?freelancerId=${freelancerId}&workId=${this.getAttribute("data-id")}`;
                });
            });

            
        }
    })
    .catch(error => console.error(error));
}