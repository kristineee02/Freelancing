document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editProfileModal");
    const editProfileBtn = document.getElementById("EditProfile");
    if (modal && editProfileBtn) {
        const closeBtn = modal.querySelector(".close");
        editProfileBtn.onclick = () => modal.style.display = "block";
        closeBtn.onclick = () => modal.style.display = "none";
    }

    //freelancer-work
    loadWorks();

    // Form submission
    const pubForm = document.getElementById("pubpopup");
    if (pubForm) {
        pubForm.addEventListener("submit", function(event) {
            event.preventDefault();

            const title = document.getElementById("Title").value.trim();
            const description = document.getElementById("Description").value.trim();
            const category = document.getElementById("Category").value.trim();
            const freelancerId = document.querySelector("input[name='freelancer_id']").value;

            if (!title || !description || !category) {
                alert("Please fill all required fields.");
                return;
            }

            if (selectedFiles.length === 0) {
                alert("Please upload at least one image.");
                return;
            }

            const formData = new FormData();
            selectedFiles.forEach(file => {
                formData.append("picture[]", file);
            });
            
            formData.append("title", title);
            formData.append("description", description);
            formData.append("category", category);
            formData.append("freelancer_id", freelancerId);

            fetch("../api/work_api.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === "success") {
                    alert("Work posted successfully!");
                    closePopup();
                    loadWorks(); // Reload works after successful submission
                } else {
                    alert("Error: " + (data.message || "Unknown error"));
                }
            })
            .catch(error => {
                console.error("Error publishing work:", error);
                alert("Failed to publish work: " + error.message);
            });
        });
    }
});

function loadWorks() {
    fetch("../api/work_api.php")
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        const workSection = document.getElementById("workSection");
        if (!workSection) return;
        
        workSection.innerHTML = ''; // Clear existing content
            
        if (data.status === "success" && data.works && data.works.length > 0) {
            data.works.forEach(work => {
                // Fix the image path - remove the '../' prefix
                const imagePath = work.picture.split(',')[0]; // Get first image if multiple
                
                workSection.innerHTML += `
                    <div class="work-box" 
                        style="background-image: url('${imagePath}');
                              background-size: cover;
                              background-position: center;">
                        <div class="work-overlay">
                            <h3>${work.title || 'Untitled'}</h3>
                            <p>${work.description || ''}</p>
                            <span class="category-tag">${work.category || ''}</span>
                        </div>
                    </div>
                `;
            });
        } else {
            workSection.innerHTML = '<p>No works available yet. Click the + to add your first work!</p>';
        }
    })
    .catch(error => {
        console.error("Error fetching works:", error);
        const workSection = document.getElementById("workSection");
        if (workSection) {
            workSection.innerHTML = `<div class="error-message">Failed to load works: ${error.message}</div>`;
        }
    });
}