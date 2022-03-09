const signupButton = document.querySelector('input[type="submit"]')
var respnseStatus
signupButton.addEventListener('click', () =>{
    const formData = new FormData(document.querySelector('form'))
    fetch('http://localhost:8888/userApi/user_model.php', {
        method: 'POST',
        body: formData,
    })
    .then(respnse => {
        respnseStatus = respnse.status
        return respnse.text()
    })
    .then(data => {
        alert(data)
        if(respnseStatus == 200)
            location.href="index.php"
    })
    .catch(err => {alert(err) })
})