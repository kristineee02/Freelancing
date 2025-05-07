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

    getAllJob();
    name();
});

let allJobsData = [];
function getAllJob(){
    fetch("../api/job_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            allJobsData = data.jobs;
            filterJobs();

            document.getElementById("company-section").innerHTML = "";
            data.jobs.forEach(job =>{
                document.getElementById("company-section").innerHTML += `
                    <div class="company">
                    <div class="header">
                        <div style="display: flex; align-items: center;">
                            <img src="../uploads/${job.profile_pic}" alt="company logo">
                            <div class="company-name">${job.first_name} ${job.last_name}</div>
                        </div>
                        <div class="date">${job.date_created}</div>
                    </div>
                    <div class="position">${job.project_title}</div>
                    <div class="price">
                        <i class="fa-solid fa-tag"></i> ₱${job.budget}
                    </div>
                    <div class="description">${job.description}</div>
                    <div class="buttons">
                        <div class="btnview" data-id="${job.job_id}">View Job</div>
                        <div class="btnapply" data-id="${job.job_id}">Apply for Job</div>
                    </div>
                </div>
                `;
            });

            document.querySelectorAll(".btnapply").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const jobId = this.getAttribute("data-id");
                    const jobData = data.jobs.find(j => j.job_id == jobId);
                    if(jobData){
                        window.location.href = `Find-Job-Overview.php?jobId=${jobData.job_id}`;
                    }else{
                        console.log("");
                    }
                });
            });

            document.querySelectorAll(".btnview").forEach(button =>{
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const jobId = this.getAttribute("data-id");
                    const jobData = data.jobs.find(j => j.job_id == jobId);
                    if(jobData){
                        window.location.href = `Find-job-details.php?jobId=${jobData.job_id}`;
                    }else{
                        console.log("");
                    }
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

function filterJobs() {
    const searchTerm = document.getElementById('jobSearch').value.toLowerCase();
    const selectedCategory = document.querySelector('input[name="category"]:checked').value;
    
    const filteredJobs = allJobsData.filter(job => {

        const matchesSearch = job.project_title.toLowerCase().includes(searchTerm) || 
                             job.description.toLowerCase().includes(searchTerm);

        const matchesCategory = selectedCategory === 'All' || 
                               (job.project_category && job.project_category === selectedCategory);
        
        return matchesSearch && matchesCategory;
    });
    
    displayFilteredJobs(filteredJobs);
}

function displayFilteredJobs(jobs) {
    const companySection = document.getElementById("company-section");
    companySection.innerHTML = "";
    
    jobs.forEach(job => {
        companySection.innerHTML += `
            <div class="company">
                <div class="header">
                    <div style="display: flex; align-items: center;">
                        <img src="../uploads/${job.profile_pic}" alt="company logo">
                        <div class="company-name">${job.first_name} ${job.last_name}</div>
                    </div>
                    <div class="date">${job.date_created}</div>
                </div>
                <div class="position">${job.project_title}</div>
                <div class="price">
                    <i class="fa-solid fa-tag"></i> ₱${job.budget}
                </div>
                <div class="description">${job.description}</div>
                <div class="buttons">
                    <div class="btnview" data-id="${job.job_id}">View Job</div>
                    <div class="btnapply" data-id="${job.job_id}">Apply for Job</div>
                </div>
            </div>
        `;
    });

    document.querySelectorAll(".btnview").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            const jobId = this.getAttribute("data-id");
            const jobData = allJobsData.find(j => j.job_id == jobId);
            if(jobData) {
                window.location.href = `Find-Job-Overview.php?jobId=${jobData.job_id}`;
            }
        });
    });
}