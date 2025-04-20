
document.addEventListener('DOMContentLoaded', () => {
    fetch('../api/job_api.php')
        .then(response => response.json())
        .then(jobs => {
            const container = document.getElementById('company-job');
            container.innerHTML = ''; // clear placeholder

            if (jobs.length === 0) {
                container.innerHTML = '<p>No jobs available at the moment.</p>';
                return;
            }

            jobs.forEach(job => {
                const jobCard = document.createElement('div');
                jobCard.classList.add('job-card');
                jobCard.innerHTML = `
                    <h3>${job.project_name}</h3>
                    <p><strong>Category:</strong> ${job.category}</p>
                    <p><strong>Description:</strong> ${job.description}</p>
                    <button onclick="goToViewJob(${job.id})">View Details</button>
                `;
                container.appendChild(jobCard);
            });
        })
        .catch(err => {
            console.error("Failed to load jobs", err);
        });
});

// Function to redirect to job details page
function viewJobDetails(jobId) {
    window.location.href = `../freelancer/Find-job-details.php?id=${jobId}`;
}

// Function to redirect to job application page
function goToApplyJob(jobId) {
    window.location.href = `../freelancer/Find-Job-Application.php?id=${jobId}`;
}