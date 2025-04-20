document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editProfileModal");
    const editProfileBtn = document.getElementById("EditProfile");
    const closeBtn = modal.querySelector(".close");

    editProfileBtn.onclick = function () {
        modal.style.display = "block";
    };

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };

    loadPostedJobs();

});
    
document.addEventListener("DOMContentLoaded", function () {
    const editAboutModal = document.getElementById("editAboutModal");
    const editAboutBtn = document.getElementById("editAbout");
    const closeAbout = document.getElementsByClassName("close_about")[0];

    editAboutBtn.onclick = function () {
        editAboutModal.style.display = "block";
    };

    closeAbout.onclick = function () {
        editAboutModal.style.display = "none";
    };
});

function loadPostedJobs() {
    const jobSection = document.getElementById('jobSection');
    if (!jobSection) return;
    
    fetch('../api/job_api.php')
        .then(response => response.json())
        .then(jobs => {
            if (jobs.length === 0) {
                jobSection.innerHTML = '<div class="no-jobs"><p>You haven\'t posted any jobs yet.</p>' +
                                      '<a href="client-freelancer-work.php" class="post-job-btn">Post a Job</a></div>';
                return;
            }
            
            jobSection.innerHTML = '<h2>My Posted Jobs</h2>';
            
            jobs.forEach(job => {
                const jobCard = document.createElement('div');
                jobCard.classList.add('job-card');
                
                // Format dates
                const startDate = new Date(job.start_date).toLocaleDateString();
                const endDate = new Date(job.end_date).toLocaleDateString();
                
                jobCard.innerHTML = `
                    <div class="job-header">
                        <h3>${job.Project_Name}</h3>
                        <span class="job-budget">$${job.Budget}</span>
                    </div>
                    <div class="job-category">
                        <span class="category-badge">${job.Project_Category}</span>
                    </div>
                    <div class="job-details">
                        <p>${job.Description.substring(0, 150)}${job.Description.length > 150 ? '...' : ''}</p>
                        <div class="job-location">
                            <span><i class="fas fa-map-marker-alt"></i> ${job.Location}</span>
                            <span><i class="fas fa-calendar"></i> ${startDate} - ${endDate}</span>
                        </div>
                    </div>
                    <div class="job-actions">
                        <button class="view-job-btn" onclick="viewJobDetails(${job.job_id})">View Details</button>
                    </div>
                `;
                
                jobSection.appendChild(jobCard);
            });
        })
        .catch(err => {
            console.error("Failed to load jobs", err);
            jobSection.innerHTML = '<p>Failed to load your jobs. Please try again later.</p>';
        });
}

function viewJobDetails(jobId) {
    // You can implement a job details view or a modal
    console.log("Viewing job details for job ID:", jobId);
    alert("Job details functionality coming soon!");
}