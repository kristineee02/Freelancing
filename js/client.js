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


function loadExploreWorks() {
    // Fetch works with the explore parameter
    fetch("api/work_api.php?explore=true")
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        const exploreSection = document.getElementById("exploreSection");
        if (!exploreSection) return;
        
        exploreSection.innerHTML = ''; // Clear existing content
            
        if (data.status === "success" && data.works && data.works.length > 0) {
            data.works.forEach(work => {
                // Get first image if multiple
                const imagePath = work.picture.split(',')[0];
                
                // Create card for each work
                const workCard = document.createElement("div");
                workCard.className = "explore-card";
                
                workCard.innerHTML = `
                    <div class="explore-image" 
                        style="background-image: url('${imagePath}');
                              background-size: cover;
                              background-position: center;">
                    </div>
                    <div class="explore-content">
                        <h3>${work.title || 'Untitled'}</h3>
                        <p class="explore-author">By: ${work.firstname} ${work.lastname}</p>
                        <p class="explore-desc">${work.description || ''}</p>
                        <span class="explore-category">${work.category || ''}</span>
                    </div>
                `;
                
                exploreSection.appendChild(workCard);
            });
        } else {
            exploreSection.innerHTML = '<p>No works available yet.</p>';
        }
    })
    .catch(error => {
        console.error("Error fetching explore works:", error);
        const exploreSection = document.getElementById("exploreSection");
        if (exploreSection) {
            exploreSection.innerHTML = `<div class="error-message">Failed to load works: ${error.message}</div>`;
        }
    });
}
