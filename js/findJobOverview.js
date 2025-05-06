document.addEventListener('DOMContentLoaded', function () {
    
    const notifBtn = document.getElementById('notifBtn');  
    const notifPopup = document.getElementById('notifPopup');  

 
    notifBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        notifPopup.style.display = notifPopup.style.display === 'block' ? 'none' : 'block';
    });

    
    document.addEventListener('click', function (e) {
        if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
            notifPopup.style.display = 'none';
        }
    });

    getAboutById();

    name();
});

function getAboutById(){
    const url = new URL(window.location.href);
    const jobId = url.searchParams.get("jobId");
    
    fetch("../api/job_api.php?jobId=" + jobId)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("aboutUsDisplay").textContent = `${data.jobData.about_us}`;
            document.getElementById("roleDisplay").textContent = `${data.jobData.role}`;
            document.getElementById("taskDisplay").textContent = `${data.jobData.tasks}`;
            document.getElementById("benefitsDisplay").textContent = `${data.jobData.benefits}`;
            document.getElementById("requirementsDisplay").textContent = `${data.jobData.requirements}`;
            document.getElementById("projectTitleDisplay").textContent = `${data.jobData.project_title}`;

            document.getElementById("application").addEventListener("click", function(){
                window.location.href = `Find-Job-Application.php?jobId=${data.jobData.job_id}`;
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