const signup = document.querySelector('input[type="submit"]')
var respnseStatus
signup.addEventListener('click', () =>{
    const formData = new FormData(document.querySelector('userForm'))
    fetch('http://localhost:8888/php/user_model.php', {
        method: 'POST',
        body: formData,
    })
    .then(respnse => {
        respnseStatus = respnse.status
        return respnse.text()
    })
    .then(data => {
        alert(data)
    })
})