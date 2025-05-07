document.addEventListener("DOMContentLoaded", function(){
    getAllFreelancer();
    name();
});

function getAllFreelancer(){
    fetch("../api/freelancer_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            data.freelancers.forEach(freelancer => {
                document.getElementById("freelancerList").innerHTML += `
                    <div class="cards">
                        <img src="../uploads/${freelancer.profile_pic}" alt="freelancer profile picture">
                        <strong>${freelancer.first_name} ${freelancer.last_name}</strong>
                        <p>${freelancer.profession}</p>
                        <p class="find" data-id="${freelancer.freelancer_id}" style="cursor:pointer;color:blue;">See More</p>       
                    </div>
                `;
            });

            document.querySelectorAll(".find").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const freelancerId = this.getAttribute("data-id");
                    window.location.href = `freelancerprofile.php?userId=${freelancerId}`;
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function searchFreelancers(searchTerm) {
    fetch("../api/freelancer_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success") {

            document.getElementById("freelancerList").innerHTML = "";

            const filteredFreelancers = data.freelancers.filter(freelancer => {
                const fullName = `${freelancer.first_name} ${freelancer.last_name}`.toLowerCase();
                const skills = freelancer.profession ? freelancer.profession.toLowerCase() : "";
                const search = searchTerm.toLowerCase();
                
                return fullName.includes(search) || skills.includes(search);
            });

            filteredFreelancers.forEach(freelancer => {
                document.getElementById("freelancerList").innerHTML += `
                    <div class="cards">
                        <img src="../uploads/${freelancer.profile_pic}" alt="freelancer profile picture">
                        <strong>${freelancer.first_name} ${freelancer.last_name}</strong>
                        <p>${freelancer.profession}</p>
                        <p class="find" data-id="${freelancer.freelancer_id}" style="cursor:pointer;color:blue;">See More</p>       
                    </div>
                `;
            });

            document.querySelectorAll(".find").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const freelancerId = this.getAttribute("data-id");
                    window.location.href = `freelancerprofile.php?userId=${freelancerId}`;
                });
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