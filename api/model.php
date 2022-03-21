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
    createComment($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "PATCH") {
    updateComment($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && ($_GET['action'] == "position")) {
    getPosition($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && ($_GET['action'] == "year")) {
    getYear($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "album") {
    getAlbum($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "artist") {
    getArtist($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "genre") {
    getGenre($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "subgenre") {
    getSubgenre($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    delete($connection);
} 

// Functions

function createComment($connection)
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

function updateComment($connection)
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


function getPosition($connection){
    /*album_id 
	chart_position  */

    if (!empty ($_GET['position'])) {
        $position = $_GET[('position')];
        if (!filter_var($position, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was anon-numeric.");
        }
        echo $position;
        if (!empty ($_GET['number'])){
            $number = $_GET['number'];
            echo $number;
        }
        else
        {
            $number = 1;
        }
    }
    else
    {
        sendReply(400, "No chart position given");
    }

    $sql = "SELECT year, album_name, artist_name, genre, subgenre FROM album WHERE position=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $position);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $position;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    } 
    else {
        echo "Chart position not found. We only have positions 1 to 500.";
    }
}

function getYear($connection){

    if (!empty ($_GET['year'])) {
        $year = $_GET[('year')];
        if (!filter_var($year, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
        echo $year;
    }
    else
    {
        sendReply(400, "No year given");
    }

    $sql = "SELECT position, album_name, artist_name, genre, subgenre FROM album WHERE year=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $year;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    }
    else {
        echo "Year notfound. Call Dr. Who!";
    }
}

function getAlbum($connection){

    if (!empty ($_GET['album'])) {
        $album = $_GET[('album')];
        echo $album;
    }
    else
    {
        sendReply(400, "No album name given");
    }

    $sql = "SELECT position, year, artist_name, genre, subgenre FROM album WHERE album_name=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $album);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $album;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    }
    else {
        echo "Album not found";
    }
}

function getArtist($connection){
    echo "In the Artist block";
    if (!empty ($_GET['artist'])) {
        $artist = $_GET[('artist')];
        echo $artist;
    }
    else
    {
        sendReply(400, "No artist name given");
    }

    $sql = "SELECT position, year, album_name FROM album WHERE artist_name=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    // echo $sql;
    $stmt->bind_param("s", $artist);
    $stmt->execute();
    //echo "statement executed";
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $artist;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    }
    else {
        echo "Artist not found";
    }
    // Close statement
    mysqli_stmt_close($stmt);
 
    // Close connection
    mysqli_close($connection);
}

function getGenre($connection){

    if (!empty ($_GET['genre'])) {
        $genre = $_GET[('genre')];
        $gen_query = "%".$genre."%";
    }
    else
    {
        sendReply(400, "No genre given");
    }

    $sql = "SELECT position, year, album_name, artist_name, subgenre FROM album WHERE genre Like ?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $gen_query);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $genre;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    }
    else {
        echo "Genre not found, hipster!";
    }
}

function getSubgenre($connection){

    if (!empty ($_GET['subgenre'])) {
        $subgenre = $_GET[('subgenre')];
        $subgen_query = "%".$subgenre."%";
    }
    else
    {
        sendReply(400, "No subgenre given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre FROM album WHERE subgenre=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $subgen_query);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) > 0)
    {   
        echo $subgenre;
        foreach ($result as $row ){
            echo (json_encode($row));
        }
    }
    else {
        echo "Subgenre not found, even more hipster!";
    }
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