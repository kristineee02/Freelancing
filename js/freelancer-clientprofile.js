document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'EditProfile') {
            e.preventDefault();
            document.getElementById("editProfileModal").classList.add("show");
        }

        if (e.target && e.target.classList.contains('close')) {
            document.getElementById("editProfileModal").classList.remove("show");
        }
    });

    document.getElementById("profileUpdateForm").addEventListener("submit", function(event){
        event.preventDefault();
        updateClient();
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
            document.getElementById("editfirstName").value = data.clientData.first_name;
            document.getElementById("editlastName").value = data.clientData.last_name;
            document.getElementById("editUserAddress").value = data.clientData.address;
            document.getElementById("edit-prof").setAttribute('src', '../uploads/' + data.clientData.profile_pic);
            document.getElementById("imageSubMenu").src = `../uploads/${data.clientData.profile_pic}`;
            getJobById(data.clientData.client_id);
        }
    })
    .catch(error => console.error(error));
}

async function updateClient(){

    try {
        const formData = new FormData();
        formData.append('firstName', document.getElementById("editfirstName").value);
        formData.append('lastName', document.getElementById("editlastName").value);
        formData.append('address', document.getElementById("editUserAddress").value);

        const fileInput = document.getElementById("edit-prof");
        if (fileInput.files[0]) {
            formData.append('profilePic', fileInput.files[0]);
        }

        const response = await fetch("../api/client_api.php", {
            method: "POST",
            body: formData
        });
        
        const data = await response.json();
        
        if (data.status === "success") {
            alert("Profile updated successfully!");
            window.location.reload();
        } else {
            throw new Error(data.message || "Update failed");
        }
    } catch (error) {
        console.error("Error updating profile:", error);
        alert("Error updating profile: " + error.message);
    }
}

function getJobById(clientId){
    fetch("../api/job_api.php?clientId=" + clientId)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){

            console.log(clientId);
            data.jobData.forEach(job => {
                document.getElementById("jobSection").innerHTML += `
                    <div class="job-card">
                        <div class="job-header">
                            <h3>${job.project_title}</h3>
                            <span class="job-budget">₱${job.budget}</span>
                        </div>
                        <div class="job-category">
                            <span class="category-badge">${job.project_category}</span>
                        </div>
                        <div class="job-details">
                            <p>${job.description}</p>
                            <div class="job-location">
                                <span><i class="fas fa-map-marker-alt"></i>${job.location}</span>
                                <span><i class="fas fa-calendar"></i>${job.date_created}</span>
                            </div>
                        </div>
                        <div class="job-actions">
                            <button class="view-job-btn" data-id="${job.job_id}" data-client-id="${job.client_id}">View Details</button>
                        </div>
                    </div>
                `;
            });

            document.querySelectorAll(".view-job-btn").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const jobId = this.getAttribute("data-id");
                    const clientId = this.getAttribute("data-client-id");

                    window.location.href = `Find-job-details.php?clientId=${clientId}&jobId=${jobId}`;
                });
            });
        }
    })
    .catch(error => console.error(error));
}