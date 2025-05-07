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
            return fetch("../api/work_api.php?freelancerId=" + freelancerId + "&workId=" + workId, {
                method: "GET",
                headers: {"Content-Type": "application/json"}
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("freelancerName").textContent = data.workData.first_name + " " + data.workData.last_name;
            document.getElementById("connect").textContent = `Connect with ${data.workData.first_name} ${data.workData.last_name}`;
            document.getElementById("titleId").textContent = data.workData.title;
            document.getElementById("previewBox").innerHTML += `<img src="../uploads/${data.workData.picture}" alt="pic" style="height:100%;width:100%;background-size:cover;">`;
            getReviews(data.workData.work_id);
            document.getElementById("reviews").addEventListener("submit", function(event){
                event.preventDefault();
                addReview(data.workData.work_id);
            });

            document.getElementById("projectForms").addEventListener("submit", function(event){
                event.preventDefault();
                addBuy(data.workData.work_id, freelancerId);
            });
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
            document.getElementById("nameDisplay").textContent = `${data.clientData.first_name} ${data.clientData.last_name}`;
            
        }
    })
    .catch(error => console.error(error));
}

function getReviews(id){
    fetch("../api/review_api.php?workId=" + id)
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("reviews").innerHTML += "<h3>REVIEWS</h3>";

            data.reviews.forEach(review => {
                document.getElementById("reviews").innerHTML += `
                    <div class="review-box">
                        <p>${review.first_name} ${review.last_name}</p>
                        <fieldset>
                            <p>${review.comment}</p>
                        </fieldset>
                    </div>
                `;
            });

            document.getElementById("reviews").innerHTML += `
                <div class="review-box">
                    <p>Your comment</p>
                    <input type="text" name="comment" id="comment" style="width:100%; padding:1em 0;">
                </div>
            `;


            
        }
    })
    .catch(error => console.error(error));
}

function addReview(workId){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const formData = {
                clientId: data.userId,
                workId: workId,
                comment: document.getElementById("comment").value
            }

            return fetch("../api/review_api.php", {
                method: "POST",
                body: JSON.stringify(formData),
                headers: {"Content-Type": "application/json"}
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}

function addBuy(workId, freelancerId){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            const formData = {
                clientId: data.userId,
                workId: workId,
                freelancerId: freelancerId,
                projectDetails: document.getElementById("Pdetails").value,
                targetDate: document.getElementById("targetDate").value,
                projectBudget: document.getElementById("projectBudget").value
            }

            return fetch("../api/buy_api.php", {
                method: "POST",
                body: JSON.stringify(formData),
                headers: {"Content-Type": "application/json"}
            })
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Added Sucessfully!");
            window.location.reload();
        }
    })
    .catch(error => console.error(error));
}