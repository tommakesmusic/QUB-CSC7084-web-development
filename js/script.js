// My main javascript functions file

// Adding a random number function
// Random header messages
const random_header = Math.floor(Math.random() * 4);
const header_messages = ["Header Hello!", "Header, Hi There!", "Help, I'm in your header!", "Header here"];

var header_message = header_messages[random_header];
document.getElementById("header").innerHTML = header_message;

// User actions section
const signup = document.querySelector('.signup');
const login = document.querySelector('.login');
const userLogout = document.querySelector('.logout');
const updateUser = document.querySelector('.updateUser');
const deleteUser = document.querySelector('.deleteUser');

signup.addEventListener('click', ()=>{location.href="../userApi/signup.php"});
login.addEventListener('click', ()=>{location.href="../userApi/login.php"});

userLogout.addEventListener('click', function () {
        alert("In the script.js file, logout section");
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


updateUser.addEventListener('click', ()=>{});
deleteUser.addEventListener('click', ()=>{});



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