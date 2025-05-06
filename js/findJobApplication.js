document.addEventListener("DOMContentLoaded", function(){
    
    
    const url = new URL(window.location.href);
    const jobId = url.searchParams.get("jobId");

    document.getElementById("overview").addEventListener("click", function(){
        window.location.href = `Find-Job-Overview.php?jobId=${jobId}`;
    });
    name();
});

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