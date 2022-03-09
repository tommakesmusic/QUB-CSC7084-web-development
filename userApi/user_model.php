<?php
// user_model.php
// After  https://www.youtube.com/watch?v=ATKDlgGrLzA and
// part 2 https://www.youtube.com/watch?v=BcsgVhcltEM

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

require_once "../php/connection.php";
require_once "../php/helpers.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "signup") {
    signup($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "login") {
    login($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    logout($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    updateUser($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    removeUser($connection);
} 

// Functions

function signup($connection)
{
    echo "SIGNUP HAS REACHED THE BACK END!";
};

function login($connection)
{

};

function logout($connection)
{

};

function updateUser($connection)
{

};

function removeUser($connection)
{

};

?>