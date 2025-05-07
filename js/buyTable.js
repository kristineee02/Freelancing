document.addEventListener("DOMContentLoaded", function(){
    getBuy();
});

function getBuy(){
    fetch("../api/store_session.php")
    .then(response => response.json())
    .then(data => {
        const freelancerId = data.userId;
        return fetch("../api/buy_api.php?freelancerId=" + freelancerId)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            document.getElementById("content").innerHTML = "";

            data.buys.forEach(buy => {
                document.getElementById("content").innerHTML += `
                
                    <tr>
                        <td>${buy.client_first_name} ${buy.client_last_name}</td>
                        <td>${buy.work_title}</td>
                        <td class="project-details">${buy.project_details}</td>
                        <td>${buy.target_date}</td>
                        <td>₱${buy.project_budget}</td>
                        <td class="actions-cell">
                            <button class="delete-btn" data-id="${buy.buy_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
            });

            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function(event){
                    event.preventDefault();
                    const buyId = this.getAttribute("data-id");
                    deleteBuy(buyId);
                });
            });
        }
    })
    .catch(error => console.error(error));
}

function deleteBuy(id){
    const formData = {
        buyId: Number(id)
    }

    fetch("../api/buy_api.php", {
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