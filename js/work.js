document.addEventListener("DOMContentLoaded", function() {
        initModal();
        getFreelancer();

        document.getElementById("profileUpdateForm").addEventListener("submit", function(event){
            event.preventDefault();
            updateFreelancer();
        });
});

function initModal() {

    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'EditProfile') {
            e.preventDefault();
            document.getElementById("editProfileModal").classList.add("show");
        }

        if (e.target && e.target.classList.contains('close')) {
            document.getElementById("editProfileModal").classList.remove("show");
        }
    });

    window.addEventListener('click', function(e) {
        const modal = document.getElementById("editProfileModal");
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });
}

function getFreelancer(){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const freelancerId = data.userId;
            return fetch("../api/freelancer_api.php?userId=" + freelancerId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageDisplay").src = `../uploads/${data.freelancerData.profile_pic}`;
            document.getElementById("imageDisplay2").src = `../uploads/${data.freelancerData.profile_pic}`;
            document.getElementById("nameDisplay").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
            document.getElementById("nameDisplay2").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
            document.getElementById("addressDisplay").textContent = `${data.freelancerData.address}`;

            document.getElementById("editfirstName").value = data.freelancerData.first_name;
            document.getElementById("editlastName").value = data.freelancerData.last_name;
            document.getElementById("editUserAddress").value = data.freelancerData.address;
            document.getElementById("edit-prof").setAttribute('data-current', data.freelancerData.profile_pic);

            getWorkById(data.freelancerData.freelancer_id);
            document.getElementById("pubpopup").addEventListener("submit", function(){
                addWork(data.freelancerData.freelancer_id);
            });
        }
    })
    .catch(error => console.error(error));
}

function updateFreelancer() {
    const formData = new FormData();
    formData.append('firstName', document.getElementById("editfirstName").value);
    formData.append('lastName', document.getElementById("editlastName").value);
    formData.append('address', document.getElementById("editUserAddress").value);

    const profilePicInput = document.getElementById("edit-prof");
    if (profilePicInput.files[0]) {
        formData.append('profilePic', profilePicInput.files[0]);
    }

    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            return fetch("../api/freelancer_api.php", {
                method: "POST",
                body: formData
            });
        } else {
            throw new Error("User not authenticated");
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Profile updated successfully!");
            window.location.reload();
        } else {
            throw new Error(data.message || "Update failed");
        }
    })
    .catch(error => {
        console.error(error);
        alert("Error updating profile: " + error.message);
    });
}

function getWorkById(freelancerId){
    fetch("../api/work_api.php?freelancerId=" + freelancerId)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            data.workData.forEach(work => {
                document.getElementById("workDisplay").innerHTML += `
                    <div class="content-boxa" data-id="${work.work_id}" data-freelancer-id="${work.freelancer_id}">
                        <img src="../uploads/${work.picture}" style="height:100%;width:100%;background-size:cover;">
                    </div>
                `;
            });

            document.querySelectorAll(".content-boxa").forEach(button =>{
                button.addEventListener("click", function(){
                    const workId = this.getAttribute("data-id");
                    const freelancerId = this.getAttribute("data-freelancer-id");
                    window.location.href = `freelancer-webdesign.php?workId=${workId}&freelancerId=${freelancerId}`;
                });
            });
        }
    })
    .catch(error => console.error(error));
}

async function addWork(freelancerId) {
    const formData = new FormData();
    formData.append('freelancerId', freelancerId);
    formData.append('title', document.getElementById('Title').value);
    formData.append('category', document.getElementById('Category').value);
    formData.append('description', document.getElementById('Description').value);

    const fileInput = document.getElementById('fileInput');
    if (fileInput.files[0]) {
        formData.append('picture', fileInput.files[0]);
    }

    fetch("../api/work_api.php", {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Work added successfully!');
            window.location.reload();
        } else {
            console.log("a");
        }
    })
    .catch(error => console.error(error));
}