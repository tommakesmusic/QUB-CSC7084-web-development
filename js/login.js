var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
const signupButton = document.querySelector('input[type="submit"]')
var myStatus
alert("In the login.js file")
signupButton.addEventListener('click', () =>{
    const formData = new FormData(document.querySelector('form'))
    fetch('http://localhost:8888/userApi/user_model.php', {
        method: 'POST',
        body: formData,
        credentials: 'include'
    })
    .then(respnse => {
        myStatus = respnse.status
        return respnse.text()
    })
    .then(data => {
        alert(data)
        if(myStatus == 200)
            location.href="../index.php"
    })
    .catch(err => {alert(err) })
})
/* 

function validate(){
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;
window.location = "success.html"; // Redirecting to other page.
return false;
}
else{
attempt --;// Decrementing by one.
alert("You have left "+attempt+" attempt;");
// Disabling fields after 3 attempts.
if( attempt == 0){
document.getElementById("username").disabled = true;
document.getElementById("password").disabled = true;
document.getElementById("submit").disabled = true;
return false;
}
}
} */