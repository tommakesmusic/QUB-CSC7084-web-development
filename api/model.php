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

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "create") {
    createComment($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "comment") {
    getComment($connection);
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
    //echo "CREATE COMMENT HAS REACHED THE BACK END!";
    
    if ($_POST['owned'] =='yes'){
        $owned = 1;
    }
    else {
        $owned = 0;
    }
    if ($_POST['comment']!=""){
        $comment = $_POST['comment'];
    }
    else {
        $comment = "";
    }
    $position = $_POST['position'];
    $user_id = $_SESSION['id'];
      

   /*  if (commentExists($connection, $user_id, $position, $owned)){
        sendReply(400, "You've commented here before!");
    } */


    $sql = "INSERT into comments (user_id, position, owned, comment) values (?,?,?,?);";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oops!Something went wrong with the connection.");  
    }
    $stmt->bind_param('iiis', $user_id, $position, $owned, $comment);
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

function getComment($connection){
    //echo "IN COMMENT FUNCTION";
    if (!empty ($_GET['album']) && !empty($_GET['user'])) {
        $position = $_GET[('album')];
        if (!filter_var($position, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
        // echo $position;
        if (!empty ($_GET['user'])){
            $user_id = $_GET[('user')];
            if (!filter_var($user_id, FILTER_VALIDATE_INT)){
                sendReply(400, "Data supplied was non-numeric.");
            }
        }
    }
    else
    {
        sendReply(400, "Not enought data given");
    }

    $sql = "SELECT owned, comment FROM comments WHERE user_id=? AND position=?";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("ii", $user_id, $position);
    $stmt->execute();
    
    $result = $stmt->get_result(); // get the mysqli result
    //$row = $result->fetch_assoc();
    
    if(mysqli_num_rows($result) > 0)
    {  
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array); 
    }
    else {
        //echo "Chart position not found. We only have positions 1 to 500.";
    }
    
}

function getPosition($connection){

    if (!empty ($_GET['value'])) {
        $position = $_GET[('value')];
        if (!filter_var($position, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
        // echo $position;
        if (!empty ($_GET['number'])){
            $number = $_GET['number'];
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

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE position=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $position);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    //$row = $result->fetch_assoc();
    
    if(mysqli_num_rows($result) > 0)
    {  
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array); 
    } 
    else {
        echo "Chart position not found. We only have positions 1 to 500.";
    }
    
}

function getYear($connection){

    if (!empty ($_GET['value'])) {
        $year = $_GET[('value')];
        if (!filter_var($year, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
        // echo $year;
    }
    else
    {
        sendReply(400, "No year given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE year=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    if(mysqli_num_rows($result) > 0)
    {   
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
    }
    else {
        echo "Year notfound. Call Dr. Who!";
    }
}

function getAlbum($connection){

    if (!empty ($_GET['value'])) {
        $album = strtolower($_GET[('value')]);
        $albm_lwcase = "%".$album."%";
    }
    else
    {
        sendReply(400, "No album name given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE LOWER(album_name) LIKE ?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $albm_lwcase);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    if(mysqli_num_rows($result) > 0)
    {   
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
    }
    else {
        echo "Album not found";
    }
}

function getArtist($connection){
    // echo "In the Artist block";
    if (!empty ($_GET['value'])) {
        $artist = strtolower($_GET[('value')]);
        $art_lwcase = "%".$artist."%";
    }
    else
    {
        sendReply(400, "No artist name given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE LOWER(artist_name) Like ?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    // echo $sql;
    $stmt->bind_param("s", $art_lwcase);
    $stmt->execute();
    //echo "statement executed";
    $result = $stmt->get_result(); // get the mysqli result

    if(mysqli_num_rows($result) > 0)
    {   
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
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

    if (!empty ($_GET['value'])) {
        $genre = $_GET[('value')];
        $gen_query = "%".strtolower($genre)."%";
    }
    else
    {
        sendReply(400, "No genre given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE LOWER (genre) Like ?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $gen_query);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    if(mysqli_num_rows($result) > 0)
    {   
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
    }
    else {
        echo "Genre not found, hipster!";
    }
}

function getSubgenre($connection){

    if (!empty ($_GET['value'])) {
        $subgenre = $_GET[('value')];
        $subgen_query = "%".strtolower($subgenre)."%";
    }
    else
    {
        sendReply(400, "No subgenre given");
    }

    $sql = "SELECT position, year, album_name, artist_name, genre, subgenre FROM album WHERE LOWER (subgenre) Like ?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oops! Something went wrong with the connection.");  
    }
    $stmt->bind_param("s", $subgen_query);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    if(mysqli_num_rows($result) > 0)
    {   
        $result_array = array();
        while($row = $result->fetch_assoc()){
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
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

function commentExists($connection, $user_id, $position, $owned, )
{

    $sql = "SELECT id FROM comments WHERE user_id=? AND position=? AND $owned=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Something went wrong with the connection.");  
    }
    $stmt->bind_param("iii", $user_id, $position, $owned);
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