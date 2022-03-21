const updateButton = document.querySelector('input[type="submit"]')
var myStatus
//alert("In the update.js file")

updateButton.addEventListener('click', () =>{
   
    const formData = new URLSearchParams(new FormData(document.querySelector('form')))
    fetch('http://localhost:8888/userApi/user_model.php', {
        method: 'PATCH',
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