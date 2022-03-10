<?php
// user_model.php
// After  https://www.youtube.com/watch?v=ATKDlgGrLzA and
// part 2 https://www.youtube.com/watch?v=BcsgVhcltEM

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

require_once "../php/connection.php";
require_once "../php/helpers.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "signup") {
    signup($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "login") {
    login($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['userApiReq'])) {
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
        sendReply(400, "All fields must be filled in.");
    }
    if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
    {
        sendReply(400, "Invalid email address.");
    }
    if ($passWord != $passWordRpt)
    {
        sendReply(400, "Passwords must match.");  
    }
    
    $passWord = password_hash($passWord, PASSWORD_DEFAULT);

    $sql = "INSERT into user (username, first_name, last_name, email, password) values (?,?,?,?,?);";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oops!Something went wrong with the connection.");  
    }
    $stmt->bind_param('sssss', $userName, $firstName, $lastName, $emailAddress, $passWord);
    $stmt->execute();
    # $stmt->close();
    if($stmt->affected_rows > 0)
    {
        sendReply(200, "Success");
    }
    else
    {
        sendReply(400, "Oh no. Database did not update"); 
    }

};

function login($connection)
{
    echo "LOGIN HAS REACHED THE BACK END!";
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $passWordRpt = $_POST['passWordRpt'];
    if (empty($userName) || empty($passWord))
    {
        sendReply(400, "All fields must be filled in.");
    }
    if ($passWord != $passWordRpt)
    {
        sendReply(400, "Passwords must match.");  
    }
    if (isset($_SESSION['user']))
    {
        sendReply(400, "Already logged in as ". $_SESSION['user']);
    }
    $sql = "select password from user where username=?;";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oops!Something went wrong with the connection.");  
    }
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    # $stmt->close();
    $result=$stmt->get_result();
    if(mysqli_num_rows($result) > 0)
    {
        $data = $result->fetch_assoc();
        $validPassword = password_verify($passWord, $data['password']);
        if(!$validPassword)
        {
            sendReply(400, "Incorrect password");
        }
        $_SESSION['user'] = $userName;
        sendReply(200, "Welcome back ". $_SESSION['user']);
    }
    else
    {
        sendReply(400, "Username not found.");
    }

};

function logout($connection)
{
    if(!isset($_SESSION['user'])){
        sendReply(400, "You are not logged in");
    }
    unset($_SESSION['user']);
    session_destroy();
    sendReply(200, "Logged out!");
};

function updateUser($connection)
{

};

function removeUser($connection)
{

};

?>