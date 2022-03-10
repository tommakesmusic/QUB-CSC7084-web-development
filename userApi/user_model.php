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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $emailAddress = $_POST['emailAddress'];
    $passWord = $_POST['passWord'];
    $passWordRpt = $_POST['passWordRpt'];


    if (empty($firstName) || empty($lastName) || empty($userName) || empty($emailAddress) || empty($passWord) || empty($passWordRpt))
    {
        http_response_code(400);
        echo "All fields must be filled in.";
        exit();
    }
    if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
    {
        http_response_code(400);
        echo "Invalid email address.";
        exit();
    }
    if ($passWord != $passWordRpt)
    {
        http_response_code(400);
        echo "Passwords must match.";
        exit();  
    }
    
    $passWord = password_hash($passWord, PASSWORD_DEFAULT);

    $sql = "INSERT into user (username, first_name, last_name, email, password) values (?,?,?,?,?);";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        http_response_code(400);
        echo "Oops!Something went wrong with the connection.";
        exit();  
    }
    $stmt->bind_param('sssss', $userName, $firstName, $lastName, $emailAddress, $passWord);
    $stmt->execute();
    # $stmt->close();
    if($stmt->affected_rows > 0)
    {
        http_response_code(200);
        echo "Success";
        exit();
    }
    else
    {
        http_response_code(400);
        echo "Oh no. Database did not update";
        exit(); 
    }

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