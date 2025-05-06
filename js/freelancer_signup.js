document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("formId").addEventListener("submit", function(event){
        event.preventDefault();
        addFreelancer();
    });
});

function addFreelancer(){
    
    const formData = {
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        address: document.getElementById("address").value
    }

    fetch("../api/freelancer_signup_api.php", {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {"Content-Type": "application/json"}
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Added Successfully");
            location.href = "../login/UserLogIn.php";
        }
    })
    .catch(error => console.error(error));
}