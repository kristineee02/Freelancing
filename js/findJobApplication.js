document.addEventListener("DOMContentLoaded", function(){
    
    
    const url = new URL(window.location.href);
    const jobId = url.searchParams.get("jobId");

    document.getElementById("overview").addEventListener("click", function(){
        window.location.href = `Find-Job-Overview.php?jobId=${jobId}`;
    });

    document.getElementById("applicationForm").addEventListener("submit", function(event){
        event.preventDefault();
        addApplication(jobId);
    });

    name();
});

 function addApplication(id){
    const formData = {
        jobId: Number(id),
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        contact: document.getElementById("contact").value,
        address: document.getElementById("address").value
    }

    fetch("../api/application_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Sent Successfully!");
            window.location.href = "Explore.php";
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
            return fetch("../api/freelancer_api.php?userId=" + freelancerId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageDisplay").src = `../uploads/${data.freelancerData.profile_pic}`;
            document.getElementById("nameDisplay").textContent = `${data.freelancerData.first_name} ${data.freelancerData.last_name}`;
        }
    })
    .catch(error => console.error(error));
}