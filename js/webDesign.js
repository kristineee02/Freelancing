document.addEventListener("DOMContentLoaded", function(){

    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open");
    }
    const notifBtn = document.getElementById('notifBtn');  
    const notifPopup = document.getElementById('notifPopup');  

    notifBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        notifPopup.style.display = notifPopup.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (e) {
        if (!notifPopup.contains(e.target) && e.target !== notifBtn) {
            notifPopup.style.display = 'none';
        }
    });

    getAllWork();
});

function getAllWork(){
    const url = new URL(window.location.href);
    const workId = url.searchParams.get("workId");

    const freelancerId = url.searchParams.get("freelancerId");
    fetch("../api/store_session.php", {
        method: "GET",
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            return fetch("../api/work_api.php?workId=" + workId + "&freelancerId=" + freelancerId, {
                method: "GET",
                headers: {"Content-Type": "application/json"}
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            console.log(workId);
            document.getElementById("nameDisplay").textContent = `${data.workData.first_name} ${data.workData.last_name}`;
            document.getElementById("workTitle").textContent = `${data.workData.title}`;
            document.getElementById("workCategory").textContent = `${data.workData.category}`;
            document.getElementById("date").textContent = `${data.workData.date}`;
            document.getElementById("imageDisplay").innerHTML = `
                <img src="../uploads/${data.workData.picture}" style="height: 100%;width:100%; background-size:cover;">
            `;

            document.getElementById("workDescription").textContent = `${data.workData.description}`;
        }else{
            console.log(workId);
        }
    })
    .catch(error => console.error(error));
}

