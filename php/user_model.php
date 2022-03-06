// model.php
// After  https://www.youtube.com/watch?v=ATKDlgGrLzA and
// part 2 https://www.youtube.com/watch?v=BcsgVhcltEM

<?php
include_once "./connection.php";
include_once "./helpers.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['user_request'] == "signup"){
    signup($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['user_request'] == "login"){
    login($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    logout($connection);
}


if ($_SERVER['REQUEST_METHOD'] == "PATCH"){
    update_user($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
    remove_user($connection);
} 

// Functions

function signup($connection){
    
};
function login($connection){};
function logout($connection){};
function update_user($connection){};
function remove_user($connection){};

?>