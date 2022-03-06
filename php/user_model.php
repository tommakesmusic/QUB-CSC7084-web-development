<?php
// model.php
// After  https://www.youtube.com/watch?v=ATKDlgGrLzA and
// part 2 https://www.youtube.com/watch?v=BcsgVhcltEM

require_once "./connection.php";
require_once "./helpers.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['user_request'] == "signup") {
    signup($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['user_request'] == "login") {
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