document.addEventListener("DOMContentLoaded", loadWorks);

    function loadWorks(){
        fetch("../api/work_api.php")
        .then(response => response.json())
        .then(data => {
            let workSection = document.getElementById("workSection");
            workSection.innerHTML = ''; // Clear existing content

            if(data.status === "success") {
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

            })
            .catch(error=>console.error("Error fetching work."));
        };

         // Function to redirect to work details page
    function viewWorkDetails(workId) {
        window.location.href = `freelancer-webdesign.php?id=${workId}`;
    }