// Adding a random number function

// Random header messages
const random_header = Math.floor(Math.random() * 4);
const header_messages = ["Header Hello!", "Header, Hi There!", "Help, I'm in your header!", "Header here"];

var header_message = header_messages[random_header];
document.getElementById("header").innerHTML = header_message;


//function myFirstFunction() {
//    document.getElementById("header").innerHTML = "My First JavaScript Change";
//  }

// User actions section
const signup = document.querySelector('.signup');
const login = document.querySelector('.login');
const logout = document.querySelector('.logout');
const update_user = document.querySelector('.update_user');
const delete_user = document.querySelector('.delete_user');

signup.addEventListener('click', ()=>{location.href="../html/signup.html"});
login.addEventListener('click', ()=>{location.href="../html/login.html"});
update_user.addEventListener('click', ()=>{location.href="../html/update_user.html"});

update_user.addEventListener('click', ()=>{});
delete_user.addEventListener('click', ()=>{});


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