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

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['Api'] == "create") {
    create($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    updateRecord($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    getRecord($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    delete($connection);
} 

// Functions

function create($connection)
{
    // echo "SIGNUP HAS REACHED THE BACK END!";
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
        alertMessage(201, "Success");
        $unused = true;
        goLogin();
    }
    else
    {
        sendReply(400, "Oh no. Database did not update"); 
    }

};

function updateRecord($connection)
{
    // echo "UPDATE HAS REACHED THE BACK END!";
    if(!isset($_SESSION['user'])){
        sendReply(400, "You are not logged in");
    }

    parse_str(file_get_contents("php://input"), $_PATCH);

    $firstName = $_PATCH['firstName'];
    $lastName = $_PATCH['lastName'];
    $userName = $_SESSION['user'];
    $emailAddress = $_PATCH['emailAddress'];
    $passWord = $_PATCH['passWord'];
    $passWordRpt = $_PATCH['passWordRpt'];

    if (empty($firstName) || empty($lastName) || empty($emailAddress) || empty($passWord) || empty($passWordRpt))
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

    $sql = "UPDATE  user set first_name=?, last_name=?, email=?, password=? where username=?;";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oopsie!Something went wrong with the connection.");  
    }
    $stmt->bind_param('sssss', $firstName, $lastName, $emailAddress, $passWord, $userName);
    $stmt->execute();
    # $stmt->close();
    if($stmt->affected_rows > 0)
    {
        sendReply(201, "Success. User updated");
    }
    else
    {
        sendReply(400, "Oh no. Database did not update"); 
    }
};

// all my own work - with help from duck duck go and https://phpdelusions.net/mysqli_examples/prepared_select
function getRecord($connection){
    /*album_id 
	chart_position 
    album_name 
    album_year 
    album_art_link 
    wikipedia_link 
    spotify_link 
    album_trivia */
    
// only focus on searc for album, artist, genre, sub genre

    if (!empty ($_GET['chart_position'])) {
        $chart_position = $_GET[('chart_position')];
    echo $chart_position;
    }

    /* $sql = "SELECT first_name, last_name, email, date_joined FROM user WHERE username=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Balls! Something went wrong with the connection.");  
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
        // split this on the spaces
        echo $firstName." ".$lastName." ".$emailAddress." ".$date;
    } 
    else {
        echo "Record not found";
    } */
}

function delete($connection)
{
    // echo "DELETE HAS REACHED THE BACK END!";
    if(!isset($_SESSION['user'])){
        sendReply(403, "You are not logged in");
    }

    alertMessage(400, "Are you sure you want to DELETE user ".$_SESSION['user']."?");

    $sql = "DELETE from user where username='".$_SESSION['user']."';";

    if ($connection->query($sql)){
        unset($_SESSION['user']);
        session_destroy();
        header('location: ../index.php');
    }
    else
    {
        sendReply(400, "Something went wrong.");
    }

};

?>