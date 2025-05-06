document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("formId").addEventListener("submit", function(event){
        event.preventDefault();
        login();
    });
});

function login(){

    const formData = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    }
    fetch("../api/login_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            if(data.accountType === "freelancer"){
                const freelancerData = data.freelancers;

                alert("Log In Successfully!");
                storeSession(freelancerData);
                window.location.href = "../freelancer/Explore.php";
            }else if(data.accountType === "client"){
                const clientData = data.clients;

                alert("Log In Successfully!");
                storeSession(clientData);
                window.location.href = "../client/client-explore.php"
            }else{
                alert(data.message);
            }
        }
        else{
            alert(data.message);
        }
    })
    .catch(error => console.error(error));
}

function storeSession(data){
    fetch("../api/store_session.php", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
        }
    })
    .catch(error => console.error(error));
}