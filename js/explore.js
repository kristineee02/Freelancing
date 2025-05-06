document.addEventListener("DOMContentLoaded", function() {
    setupUIHandlers();
    getFreelancerById();
    getAllWorks();
    setupCarouselListeners();
});

function setupUIHandlers() {
    const notifBtn = document.getElementById("notifBtn");
    const notifPopup = document.getElementById("notifPopup");
    if (notifBtn && notifPopup) {
        notifBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            notifPopup.style.display = notifPopup.style.display === "block" ? "none" : "block";
        });
        document.addEventListener("click", (e) => {
            if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
                notifPopup.style.display = "none";
            }
        });
    }

    window.toggleMenu = () => {
        const subMenu = document.getElementById("subMenu");
        if (subMenu) {
            subMenu.classList.toggle("open");
        }
    };

    window.logout = () => {
        alert("You have been logged out successfully.");
    };
}

function getFreelancerById() {
    const userInfoElement = document.getElementById("userInfoDocument");
    if (!userInfoElement) {
        console.error("User info element not found");
        return;
    }

    fetch("../api/store_session.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"},
        credentials: "include"
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success" && data.userId){
            return fetch(`../api/freelancer_api.php?userId=${data.userId}`, {
                method: "GET",
                headers: {"Content-Type": "application/json"},
                credentials: "include"
            });
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success" && data.freelancerData){
            userInfoElement.innerHTML = `
                <img class="profile" src="../uploads/${data.freelancerData.profile_pic}">
                <h4>${data.freelancerData.first_name} ${data.freelancerData.last_name}</h4>
            `;

            userInfoElement.addEventListener("click", function(){
                window.location.href = "freelancer-work.php";
            });
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
    });
}

let allWorks = []; // Store all works 
let currentSlide = 0;
const categories = ["ANIMATION", "GRAPHIC DESIGN", "PRODUCT DESIGN", "WEBSITE DESIGN", "ILLUSTRATION", "MOBILE DESIGN", "WRITING"];

function getAllWorks() {
    fetch("../api/work_api.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            allWorks = data.works; // Store works
            displayWorks(allWorks); // Initial display
        }
    })
    .catch(error => console.error(error));
}

function displayWorks(works) {
    let mainSection = document.getElementById("worksContainer");
    mainSection.innerHTML = '';
    let currentContainer = document.createElement('div');
    currentContainer.className = 'container';
    mainSection.appendChild(currentContainer);
    
    works.forEach((work, index) => {
        if (index % 4 === 0 && index !== 0) {
            currentContainer = document.createElement('section');
            currentContainer.className = 'container';
            mainSection.appendChild(currentContainer);
        }
        
        const card = document.createElement('div');
        card.className = 'card';
        card.dataset.id = work.work_id;
        card.dataset.category = work.category;
        card.innerHTML = `
            <div class="card-image" data-id="${work.work_id}" data-freelancer-id="${work.freelancer_id}" style="background-image: url('../Uploads/${work.picture}');">
            </div>
            <div class="footer">
                <h5 id="text">${work.first_name} ${work.last_name}</h5>
                <span>♥ 0</span>
            </div>
        `;
        
        currentContainer.appendChild(card);
    });

    document.querySelectorAll(".card-image").forEach(button =>{
        button.addEventListener("click", function(){
            const workId = this.getAttribute("data-id");
            const freelancerId = this.getAttribute("data-freelancer-id");
            window.location.href = `freelancer-webdesign.php?workId=${workId}&freelancerId=${freelancerId}`;
        });
    });
}

function searchWorks() {
    const searchTerm = document.querySelector('input[name="search"]').value.toLowerCase();
    const filteredWorks = allWorks.filter(work => 
        (work.title && work.title.toLowerCase().includes(searchTerm)) ||
        (work.description && work.description.toLowerCase().includes(searchTerm)) ||
        (work.category && work.category.toLowerCase().includes(searchTerm))
    );
    displayWorks(filteredWorks);
}

function moveSlide(direction) {
    currentSlide = (currentSlide + direction + categories.length) % categories.length;
    const category = categories[currentSlide];
    const filteredWorks = allWorks.filter(work => work.category.toUpperCase() === category);
    displayWorks(filteredWorks);
}

function filterFreelancer() {
    const filterValue = document.getElementById("FilterCategory").value;
    let filteredWorks = [...allWorks];
    
    if (filterValue === "new") {
        filteredWorks.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    } else if (filterValue === "all") {
        filteredWorks = [...allWorks];
    }
    
    displayWorks(filteredWorks);
}

function filterByCategory(category) {
    const filteredWorks = allWorks.filter(work => work.category.toUpperCase() === category.toUpperCase());
    currentSlide = categories.indexOf(category.toUpperCase());
    displayWorks(filteredWorks);
}

function setupCarouselListeners() {
    document.querySelectorAll('.carousel-slide .slide').forEach((slide, index) => {
        slide.addEventListener('click', () => {
            filterByCategory(categories[index]);
        });
    });
}