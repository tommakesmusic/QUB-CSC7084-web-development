var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
const signupButton = document.querySelector('input[type="submit"]')
var myStatus
// alert("In the login.js file")
signupButton.addEventListener('click', () =>{
    const formData = new FormData(document.querySelector('form'))
    fetch('http://localhost:8888/api/model.php', {
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
            location.href="../browse.php"
    })
    .catch(err => {alert(err) })
})
