document.addEventListener("DOMContentLoaded", function(){
    const url = new URL(window.location.href);
    const jobId = url.searchParams.get("jobId");
    let allApplications = [];

    getApplications(jobId);

    document.querySelector(".search-bar button").addEventListener("click", function(){
        const searchTerm = document.querySelector(".search-bar input").value.trim().toLowerCase();
        renderApplications(filterApplications(allApplications, searchTerm));
    });

    document.querySelector(".search-bar input").addEventListener("keypress", function(event){
        if(event.key === "Enter"){
            const searchTerm = this.value.trim().toLowerCase();
            renderApplications(filterApplications(allApplications, searchTerm));
        }
    });

    function getApplications(id){
        fetch(`../api/application_api.php?jobId=${id}`)
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                allApplications = data.applicationData;
                renderApplications(allApplications);
            }
        })
        .catch(error => console.error(error));
    }

    function filterApplications(applications, searchTerm){
        if(!searchTerm) return applications;
        
        return applications.filter(app => 
            app.name.toLowerCase().includes(searchTerm) ||
            app.email.toLowerCase().includes(searchTerm) ||
            app.contact.toLowerCase().includes(searchTerm) ||
            app.address.toLowerCase().includes(searchTerm)
        );
    }

    function renderApplications(applications){
        document.getElementById("contents").innerHTML = "";
        
        applications.forEach(app => {
            document.getElementById("contents").innerHTML += `
                <tr>
                    <td>${app.name}</td>
                    <td>${app.email}</td>
                    <td>${app.contact}</td>
                    <td>${app.address}</td>
                    <td class="actions">
                        <a href="#" class="btn btn-delete" data-id="${app.application_id}">Delete</a>
                    </td>
                </tr>
            `;
        });

        // Re-attach delete button event listeners
        document.querySelectorAll(".btn.btn-delete").forEach(button => {
            button.addEventListener("click", function(event){
                event.preventDefault();
                const appId = this.getAttribute("data-id");
                deleteApplication(appId);
            });
        });
    }

    function deleteApplication(id){
        const formData = {
            applicationId: Number(id)
        }
        fetch("../api/application_api.php", {
            method: "DELETE",
            body: JSON.stringify(formData),
            headers: {"Content-Type": "application/json"}
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                alert("Deleted Successfully!");
                window.location.reload();
            }
        })
        .catch(error => console.error(error));
    }
});