document.addEventListener("DOMContentLoaded", loadWorks);

function loadWorks() {
    // Get the freelancer ID from the profile container
    // We'll add this attribute in the PHP code
    const profileContainer = document.getElementById('profileId');
    const freelancerId = profileContainer.getAttribute('data-freelancer-id');
    
    if (!freelancerId) {
        console.error("Freelancer ID not found");
        document.getElementById("workSection").innerHTML = '<p>Error: Could not identify freelancer profile.</p>';
        return;
    }

    // Include the freelancer ID as a query parameter
    fetch(`../api/work_api.php?freelancer_id=${freelancerId}`)
        .then(response => response.json())
        .then(data => {
            let workSection = document.getElementById("workSection");
            workSection.innerHTML = ''; 

            if (data.status === "success") {
                if (data.works.length === 0) {
                    workSection.innerHTML = '<p>No works available for this freelancer.</p>';
                } else {
                    data.works.forEach(work => {
                        workSection.innerHTML += `
                            <div class="work-box" 
                                style="background-image: url('../api/${work.picture}');
                                       background-size: cover;
                                       background-position: center;"
                                onclick="viewWorkDetails(${work.work_id})">
                            </div>
                        `;
                    })
                }
            } else {
                workSection.innerHTML = '<p>Failed to load works.</p>';
            }
        })
        .catch(error => {
            console.error("Error fetching work:", error);
            document.getElementById("workSection").innerHTML = '<p>Error loading works.</p>';
        });
}

// Function to redirect to work details page
function viewWorkDetails(workId) {
    window.location.href = `freelancer-webdesign.php?id=${workId}`;
}