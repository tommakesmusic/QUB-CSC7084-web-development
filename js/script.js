// My main javascript functions file

// Adding a random number function
// Random header messages
const random_header = Math.floor(Math.random() * 4);
const header_messages = ["Header Hello!", "Header, Hi There!", "Help, I'm in your header!", "Header here"];

var header_message = header_messages[random_header];
document.getElementById("header").innerHTML = header_message;

// User actions section
const signup = document.getElementById('signup');
const login = document.getElementById('login');
const userLogout = document.getElementById('logout');
const updateUser = document.getElementById('updateUser');
const deleteUser = document.getElementById('deleteUser');

signup.addEventListener('click', ()=>{location.href="../userApi/signup.php"});
login.addEventListener('click', ()=>{location.href="../userApi/login.php"});

userLogout.addEventListener('click', function () {
        // alert("In the script.js file, logout section");
        fetch('http://localhost:8888/userApi/user_model.php', {
            credentials: 'include',
            method: 'POST'
        })
            .then(res => res.text())
            .then(data => {
                alert(data);
                location.href = "../index.php";
            })
            .catch(err => alert(err));

    });


updateUser.addEventListener('click', ()=>{location.href="../userApi/update_user.php"});
deleteUser.addEventListener('click', ()=>{

    // alert("In the script.js file, delete section");
    fetch('http://localhost:8888/userApi/user_model.php', {
        credentials: 'include',
        method: 'DELETE'
    })
        .then(res => res.text())
        .then(data => {
            alert(data);
            location.href = "../index.php";
        })
        .catch(err => alert(err));

});

/* // AJAX call

  $(document).ready(function() {

    $("#type").change(function() {
        var val = $(this).val();

        $.post('query.php', {'brand' : val}, function(data){
            var jsonData = JSON.parse(data); // turn the data string into JSON
            var newHtml = ""; // Initialize the var outside of the .each function
            $.each(jsonData, function(item) {
                newHtml += "<option>" + item['model'] + "</option>";
            })
            $("#size").html(newHtml);
        });
    });
}); */