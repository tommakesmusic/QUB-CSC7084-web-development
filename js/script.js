// Adding a random number function

// document.getElementById("demo").innerHTML = "My First JavaScript";
var header_message = "HEADER MESSAGE";
document.getElementById("header").innerHTML = header_message;
function myFirstFunction() {
    document.getElementById("header").innerHTML = "My First JavaScript Change";
  }

// User actions section
const signup = document.querySelector('.signup');
const login = document.querySelector('.login');
const logout = document.querySelector('.logout');
const update_user = document.querySelector('.update_user');
const delete_user = document.querySelector('.delete_user');

signup.addEventListener('click', ()=>{location.href="../html/signup.html"});
login.addEventListener('click', ()=>{location.href="../html/login.html"});
update_user.addEventListener('click', ()=>{location.href="../html/update_user.html"});

// Generate a random number
const random = (max = 4) => {
    return Math.floor(Math.random() * max);
};

// AJAX call

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
});
