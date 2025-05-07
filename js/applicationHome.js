document.addEventListener("DOMContentLoaded", function(){
    initializeJobFilters();
    getJob();
});

function initializeJobFilters() {
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');
    const categoryRadios = document.querySelectorAll('.category-filter input[name="category"]');

    if (!searchInput || !searchButton) {
        console.error("Search input or button not found");
        return;
    }

    // Search functionality
    searchButton.addEventListener('click', function() {
        filterJobs();
    });

    // Allow search on Enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterJobs();
        }
    });

    // Category filter functionality
    if (categoryRadios.length === 0) {
        console.warn("No category radios found");
    } else {
        categoryRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                filterJobs();
            });
        });
    }
}

function filterJobs() {
    const searchInput = document.querySelector('.search-bar input')?.value.toLowerCase() || '';
    const selectedCategoryRadio = document.querySelector('.category-filter input[name="category"]:checked');
    const selectedCategory = selectedCategoryRadio ? selectedCategoryRadio.parentElement.textContent.trim() : 'All';

    fetch("../api/store_session.php")
        .then(response => {
            if (!response.ok) throw new Error('Session fetch failed');
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                return fetch("../api/job_api.php?clientId=" + data.userId);
            }
            throw new Error('Session status not success');
        })
        .then(response => {
            if (!response.ok) throw new Error('Jobs fetch failed');
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                const jobCards = document.getElementById("jobCards");
                if (!jobCards) {
                    console.error("jobCards element not found");
                    return;
                }
                jobCards.innerHTML = "";
                
                const filteredJobs = data.jobData.filter(job => {
                    const matchesSearch = job.project_title?.toLowerCase().includes(searchInput) ||
                                        job.description?.toLowerCase().includes(searchInput) ||
                                        job.project_category?.toLowerCase().includes(searchInput);
                    const matchesCategory = selectedCategory === "All" || job.project_category === selectedCategory;
                    return matchesSearch && matchesCategory;
                });

                if (filteredJobs.length === 0) {
                    jobCards.innerHTML = '<p>No jobs found matching your criteria.</p>';
                    return;
                }

                filteredJobs.forEach(job => {
                    jobCards.innerHTML += `
                        <div class="job-card">
                            <div class="job-header">
                                <div>
                                    <div class="job-title">${job.project_title || 'Untitled'}</div>
                                    <div class="job-price">₱${job.budget || 'N/A'}</div>
                                </div>
                            </div>
                            <div class="job-date">
                                <div>${job.date_created || 'Unknown'}</div>
                            </div>
                            <div class="job-description">
                                ${job.description || 'No description available'}
                            </div>
                            <div class="job-actions">
                                <a href="application-table.php?jobId=${job.job_id || ''}" class="btn btn-apply" data-id="${job.job_id || ''}">View Applications</a>
                            </div>
                        </div>
                    `;
                });
            } else {
                console.error("Job data fetch unsuccessful");
            }
        })
        .catch(error => {
            console.error("Error in filterJobs:", error);
            document.getElementById("jobCards").innerHTML = '<p>Error loading jobs. Please try again later.</p>';
        });
}

function getJob() {
    fetch("../api/store_session.php")
        .then(response => {
            if (!response.ok) throw new Error('Session fetch failed');
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                return fetch("../api/job_api.php?clientId=" + data.userId);
            }
            throw new Error('Session status not success');
        })
        .then(response => {
            if (!response.ok) throw new Error('Jobs fetch failed');
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
                const jobCards = document.getElementById("jobCards");
                if (!jobCards) {
                    console.error("jobCards element not found");
                    return;
                }
                jobCards.innerHTML = "";
                
                if (data.jobData.length === 0) {
                    jobCards.innerHTML = '<p>No jobs found.</p>';
                    return;
                }

                data.jobData.forEach(job => {
                    jobCards.innerHTML += `
                        <div class="job-card">
                            <div class="job-header">
                                <div>
                                    <div class="job-title">${job.project_title || 'Untitled'}</div>
                                    <div class="job-price">₱${job.budget || 'N/A'}</div>
                                </div>
                            </div>
                            <div class="job-date">
                                <div>${job.date_created || 'Unknown'}</div>
                            </div>
                            <div class="job-description">
                                ${job.description || 'No description available'}
                            </div>
                            <div class="job-actions">
                                <a href="application-table.php?jobId=${job.job_id || ''}" class="btn btn-apply" data-id="${job.job_id || ''}">View Applications</a>
                            </div>
                        </div>
                    `;
                });
            } else {
                console.error("Job data fetch unsuccessful");
            }
        })
        .catch(error => {
            console.error("Error in getJob:", error);
            document.getElementById("jobCards").innerHTML = '<p>Error loading jobs. Please try again later.</p>';
        });
}