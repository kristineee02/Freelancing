document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("closeBtn").addEventListener("click", function(){
        window.location.href = "Find-Freelancer.php";
    });

    document.getElementById("jobSubmissionForm").addEventListener("submit", function(event){
        event.preventDefault();
        addJob();
    });
});

function addJob(){

    fetch("../api/store_session.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const formData = {
                clientId: Number(data.userId),
                projectTitle: document.getElementById("project_title").value,
                projectCategory: document.getElementById("project_category").value,
                description: document.getElementById("description").value,
                startDate: document.getElementById("start_date").value,
                endDate: document.getElementById("end_date").value,
                budget: document.getElementById("budget").value,
                location: document.getElementById("location").value,
                education: document.getElementById("education").value,
                experience: document.getElementById("experience").value,
                aboutUs: document.getElementById("about_us").value,
                role: document.getElementById("role").value,
                tasks: document.getElementById("tasks").value,
                benefits: document.getElementById("benefits").value,
                requirements: document.getElementById("requirements").value
            }
            return fetch("../api/job_api.php", {
                method: "POST",
                body: JSON.stringify(formData),
                headers: {"Content-Type": "application/json"}
            })

        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Added Successfully!");
            window.location.href = "Find-Freelancer.php";
        }
    })
    .catch(error => console.error(error));
}