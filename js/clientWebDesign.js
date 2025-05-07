
document.addEventListener("DOMContentLoaded", function(){
    getAllWork();
    name();
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
            document.getElementById("nameDisplay2").textContent = `${data.workData.first_name} ${data.workData.last_name}`;
            document.getElementById("workTitle").textContent = `${data.workData.title}`;
            document.getElementById("workCategory").textContent = `${data.workData.category}`;
            document.getElementById("date").textContent = `${data.workData.date}`;
            document.getElementById("workPicture").innerHTML = `
                <img src="../uploads/${data.workData.picture}" style="height: 100%;width:100%; background-size:cover;">
            `;

            document.getElementById("workDescription").textContent = `${data.workData.description}`;
        }else{
            console.log(workId);
        }
    })
    .catch(error => console.error(error));
}

function name(){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const freelancerId = data.userId;
            return fetch("../api/client_api.php?userId=" + freelancerId)
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("imageDisplay").src = `../uploads/${data.clientData.profile_pic}`;
            document.getElementById("imageDisplay2").src = `../uploads/${data.clientData.profile_pic}`;
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            
        }
    })
    .catch(error => console.error(error));
}