<?php
// user_model.php
// After  https://www.youtube.com/watch?v=ATKDlgGrLzA and
// part 2 https://www.youtube.com/watch?v=BcsgVhcltEM

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-ControlAllow-Method: POST, GET, PATCH, DELETE");

require_once "../php/connection.php";
require_once "../php/helpers.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['userApiReq'])) {
    logout($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "signup") {
    signup($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['userApiReq'] == "login") {
    login($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['userDeleteAdmin'])) {
    removeUserAdmin($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    updateUser($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_GET['userDeleteAdmin'])) {
    getUser($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    removeUser($connection);
} 

// Functions

function signup($connection)
{
    // echo "SIGNUP HAS REACHED THE BACK END!";
    $firstName = noSpecChars($_POST['firstName']);
    $lastName = noSpecChars($_POST['lastName']);
    $userName = noSpecChars($_POST['userName']);
    $emailAddress = $_POST['emailAddress'];
    $passWord = $_POST['passWord'];
    $passWordRpt = $_POST['passWordRpt'];

    if (empty($firstName) || empty($lastName) || empty($userName) || empty($emailAddress) || empty($passWord) || empty($passWordRpt))
    {
        sendReply(400, "All fields must be filled in correctly. Enter all values and remove any special characters");
    }
    if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
    {
        sendReply(400, "Invalid email address.");
    }
    if (!length($firstName, 3, 20)){
        sendReply(400, "First name is an incorrect length");
    }
    if (!length($lastName, 3, 20)){
        sendReply(400, "Last name is an incorrect length");
    }
    if (!length($userName, 4, 12)){
        sendReply(400, "Username is an incorrect length");
    }
    if (!length($passWord, 8, 20) || !length($passWordRpt, 8, 20)){
        sendReply(400, "Password or Password repeat is an incorrect length");
    }
    if (userExists($connection, $userName)){
        sendReply(400, "user with that name already exists");
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
        $unused = true;
        goLogin();
    }
    else
    {
        sendReply(400, "Oh no. Database did not update"); 
    }

};

function login($connection)
{
    // echo "LOGIN HAS REACHED THE BACK END!";
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
        goHome();

    }
    $sql = "select password, user_role from user where username=?;";
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
        $userRole = $data['user_role'];
        if(!$validPassword)
        {
            sendReply(401, "Incorrect password");
        }
        $_SESSION['user'] = $userName;
        $_SESSION['userRole'] = $userRole;
        session_commit();
        sendReply(200, "Welcome back ". $_SESSION['user']);
        $unused = true;
        goHome();
    }
    else
    {
        sendReply(400, "Username not found.");
    }

};

function logout($connection)
{
    // echo "LOGIN HAS REACHED THE BACK END!";
    if(!isset($_SESSION['user'])){
        sendReply(400, "You are not logged in");
    }
    unset($_SESSION['user']);
    session_destroy();
    sendReply(200, "Logged out!");
};

function updateUser($connection)
{
    // echo "UPDATE HAS REACHED THE BACK END!";
    if(!isset($_SESSION['user'])){
        sendReply(400, "You are not logged in");
    }

    parse_str(file_get_contents("php://input"), $_PATCH);

    $firstName = noSpecChars($_PATCH['firstName']);
    $lastName = noSpecChars($_PATCH['lastName']);
    $userName = noSpecChars($_SESSION['user']);
    $emailAddress = $_PATCH['emailAddress'];
    $passWord = $_PATCH['passWord'];
    $passWordRpt = $_PATCH['passWordRpt'];
    if (empty($_PATCH['user_role'])){
        $user_role = 'user';
    }
    else {
        $user_role = $_PATCH['user_role'];
    }

    if (empty($firstName) || empty($lastName) || empty($emailAddress) || empty($passWord) || empty($passWordRpt))
    {
        sendReply(400, "All fields must be filled in.");
    }
    if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
    {
        sendReply(400, "Invalid email address.");
    }
    if (!length($firstName, 3, 20)){
        sendReply(400, "First name is an incorrect length");
    }
    if (!length($lastName, 3, 20)){
        sendReply(400, "Last name is an incorrect length");
    }
    if (!length($userName, 4, 12)){
        sendReply(400, "Username is an incorrect length");
    }
    if (!length($passWord, 8, 20) || !length($passWordRpt, 8, 20)){
        sendReply(400, "Password or Password repeat is an incorrect length");
    }
    if ($passWord != $passWordRpt)
    {
        sendReply(400, "Passwords must match.");  
    }
    
    $passWord = password_hash($passWord, PASSWORD_DEFAULT);

    $sql = "UPDATE  user set first_name=?, last_name=?, email=?, user_role=? password=? where username=?;";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oopsie!Something went wrong with the connection.");  
    }
    $stmt->bind_param('ssssss', $firstName, $lastName, $emailAddress, $user_role, $passWord, $userName);
    $stmt->execute();
    # $stmt->close();
    if($stmt->affected_rows > 0)
    {
        sendReply(200, "Success. User updated");
        $unused=true;
        goHome();
    }
    else
    {
        sendReply(400, "Oh no. Database did not update"); 
    }
};

function getUser($connection){

    $userName = $_GET[('user')];
    $sql = "SELECT first_name, last_name, email, date_joined, user_role FROM user WHERE username=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        $date = date("d/m/y, H:i:s", strtotime($row["date_joined"]));
        $firstName =  $row["first_name"];
        $lastName = $row["last_name"];
        $emailAddress = $row["email"];
        $userRole = $row["user_role"];
        // split this on the spaces
        echo $firstName." ".$lastName." ".$userName." ".$emailAddress." ".$userRole." ".$date;
    }
    else {
        echo "User not found";
    }
}

function removeUser($connection)
{
    echo "DELETE HAS REACHED THE BACK END!";
    
    
    if(!isset($_SESSION['user'])){
        sendReply(403, "You are not logged in");
    }
    
    $userToDelete = $_SESSION['user'];
    
    echo $userToDelete;

    alertMessage(400, "Are you sure you want to DELETE user ".$userToDelete."?");

    /* $sql = "DELETE from user where username='".$_SESSION['user']."';";

    if ($connection->query($sql)){
        unset($_SESSION['user']);
        session_destroy();
        //header('location: ../index.php');
    }
    else
    {
        sendReply(400, "Something went wrong.");
    } */

};

function removeUserAdmin($connection)
{
    echo "ADMIN DELETE HAS REACHED THE BACK END!";
    
    
    if(!isset($_SESSION['user'])){
        sendReply(403, "You are not logged in");
    }
    if (empty($_GET['userDeleteAdmin'])){
        sendReply(400, "No Value for User to delete.");
    }

    $userToDelete = $_GET['userDeleteAdmin'];

    echo $userToDelete;

    alertMessage(400, "Are you sure you want to DELETE user ".$userToDelete."?");

    /* $sql = "DELETE from user where username='".$_SESSION['user']."';";

    if ($connection->query($sql)){
        unset($_SESSION['user']);
        session_destroy();
        //header('location: ../index.php');
    }
    else
    {
        sendReply(400, "Something went wrong.");
    } */

};

function userExists($connection, $user){

    $sql = "SELECT username FROM user WHERE username=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        return true;
    }
    else {
        return false;
    }
}



?>