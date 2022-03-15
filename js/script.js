// My main javascript functions file

// Adding a random number function
// Random header messages
const random_welcome = Math.floor(Math.random() * 4);
const welcome_messages = ["Hello and welcome!", "Hi There!", "Welcome!", "Good to see you!"];

var welcome_message = welcome_messages[random_welcome];
document.getElementById("welcome").innerHTML = welcome_message;

// Show and hide navigatino based on icon click
function showHide() {
    var x = document.getElementById("nav");
    if (x.className === "nav") {
      x.className += " responsive";
    } else {
      x.className = "nav";
    }
  }

// show and hide elements based on session variable
async function sessionRequest(){
    // await fetch('http://localhost:8888/userApi/.session.php', {
        var role;
        try {
            const response = await fetch(`http://localhost:8888/userApi/.session.php`, {
                method: 'GET',
            })
            .then(response => response.text())
            .then(data => {
                //alert(data);
                // console.log("data is " + data);
                role = data;
            })
            .catch(err => alert(err));
        } catch (error) {
            console.error(error);
        }
        // console.log("role is still " + role);
        return role;
}

async function getSession(){
    var userRole = await sessionRequest();
    //console.log("UserRole is " + userRole)
    //console.log("promise is " + String(promise));
    if (userRole != ""){
        //alert(userRole)
        if (userRole == "notSet"){
            try{var u = document.getElementById("updateUser");
                u.style.display = "none";} catch {}
            try{var v = document.getElementById("adminUser");
            v.style.display = "none";} catch{}
            try{var w = document.getElementById("deleteUser");
            w.style.display = "none";} catch {}
            try{var x = document.getElementById("logout");
            x.style.display = "none"; } catch {}
            try{var y = document.getElementById("signup");
            y.style.display = "inline-block";} catch{}
            try{var z = document.getElementById("login");
            z.style.display = "inline-block";} catch{}
        }
        else if (userRole == "user"){
            var u = document.getElementById("updateUser");
            u.style.display = "inline-block";
            var v = document.getElementById("adminUser");
            v.style.display = "none";
            var w = document.getElementById("deleteUser");
            w.style.display = "inline-block";
            var x = document.getElementById("logout");
            x.style.display = "inline-block";
            var y = document.getElementById("signup");
            y.style.display = "none";
            var z = document.getElementById("login");
            z.style.display = "none";
        }
        else if (userRole == "admin"){
            var u = document.getElementById("updateUser");
            u.style.display = "inline-block";
            var v = document.getElementById("adminUser");
            v.style.display = "inline-block";
            var w = document.getElementById("deleteUser");
            w.style.display = "binline-block";
            var x = document.getElementById("logout");
            x.style.display = "inline-block";
            var y = document.getElementById("signup");
            y.style.display = "none";
            var z = document.getElementById("login");
            z.style.display = "none";
        }
    }
}

// User actions section
const signup = document.getElementById('signup');
const login = document.getElementById('login');
const userLogout = document.getElementById('logout');
const updateUser = document.getElementById('updateUser');
const deleteUser = document.getElementById('deleteUser');
const adminUser = document.getElementById('adminUser');

try {signup.addEventListener('click', ()=>{location.href="../userApi/signup.php"});} catch{}
try {login.addEventListener('click', ()=>{location.href="../userApi/login.php"});} catch{}
try {adminUser.addEventListener('click', ()=>{location.href="../userApi/userAdmin.php"});} catch {}

try {userLogout.addEventListener('click', function () {
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
} catch {}

try {updateUser.addEventListener('click', ()=>{location.href="../userApi/update_user.php"});} catch {}
try {deleteUser.addEventListener('click', ()=>{

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
} catch {}
// AJAX call
