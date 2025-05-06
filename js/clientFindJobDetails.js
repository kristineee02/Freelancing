document,addEventListener("DOMContentLoaded", function(){
    getjob();
});

function getjob(){
    const url = new URL(window.location.href);
    const jobId = url.searchParams.get("jobId");

    fetch("../api/job_api.php?jobId=" + jobId)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("skillNameId").textContent = `${data.jobData.project_title}`;
            document.getElementById("jobDescription").textContent = `${data.jobData.description}`;
            document.getElementById("educationId").textContent = `${data.jobData.education}`;
            document.getElementById("experienceId").textContent = `${data.jobData.experience}`;
            document.getElementById("locationId").innerHTML = `<strong>Location:</strong> ${data.jobData.location}`;
            document.getElementById("datePostedId").innerHTML = `<strong>Date Posted:</strong> ${data.jobData.date_created}`;
            const startDate = new Date(data.jobData.start_date).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
            const endDate = new Date(data.jobData.end_date).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
            document.getElementById("timeframeId").innerHTML = `<strong>Timeframe:</strong> ${startDate} - ${endDate}`;
            document.getElementById("budgetId").innerHTML = `<strong>Budget:</strong> ${data.jobData.budget}`;

            document.getElementById("applyBtn").addEventListener("click", function(){
                window.location.href = `Find-job-Overview.php?jobId=${data.jobData.job_id}`;
            });
        }
    })
    .catch(error => console.error(error));
}