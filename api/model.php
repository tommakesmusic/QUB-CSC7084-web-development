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

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "approve") {
    approveComment($connection);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "approved") {
    approved($connection);
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

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == "delete") {
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
    $approved = 0;
      

   /*  if (commentExists($connection, $user_id, $position, $owned)){
        sendReply(400, "You've commented here before!");
    } */


    $sql = "INSERT into comments (user_id, position, owned, comment, approved) values (?,?,?,?, ?);";
    $stmt = $connection->stmt_init();

    if (!$stmt->prepare($sql))
    {
        sendReply(400, "Oops!Something went wrong with the connection.");  
    }
    $stmt->bind_param('iiisi', $user_id, $position, $owned, $comment, $approved);
    $stmt->execute();
    # $stmt->close();
    if($stmt->affected_rows > 0)
    {
        sendReply(200, "Success");
        header('location: ../browse.php');
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
        sendReply(400, "Not enough data given");
    }

    $sql = "SELECT owned, comment, approved FROM comments WHERE user_id=? AND position=?";
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
        //echo "Comment not found. We only have positions 1 to 500.";
    }
    
}

function approveComment($connection){
    // echo "IN COMMENT APPROVAL FUNCTION";

    // echo $position;
    if (!empty ($_GET['value'])){
        $user_id = $_GET[('value')];
        if (!filter_var($user_id, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
    }
    else
    {
        sendReply(400, "No user Id given");
    }

    $sql = "SELECT comments.id, comments.owned, comments.comment, album.album_name  FROM comments INNER JOIN album ON comments.position = album.position WHERE comments.user_id=? AND comments.approved=0";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $user_id);
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
        echo "I didn't find anything, sorry.";
    }
    
}

function approved($connection){
    echo "IN COMMENT APPROVAL FUNCTION";

    // echo $position;
    if (!empty ($_GET['value'])){
        $comment = $_GET[('value')];
        if (!filter_var($comment, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
    }
    else
    {
        sendReply(400, "No comment Id was given");
    }

    $sql = "UPDATE comments SET approved=1 WHERE id=?";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $comment);
    ;

    
    if($stmt->execute())
    {  
        header('location: ../userApi/userAdmin.php');
    }
    else {
        echo "Comment not updated.";
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
    if (!empty ($_GET['value'])){
        $id = $_GET[('value')];
        if (!filter_var($id, FILTER_VALIDATE_INT)){
            sendReply(400, "Data supplied was non-numeric.");
        }
    }
    else
    {
        sendReply(400, "No comment id supplied");
    }
    if (commentDeleted($connection, $id)){
        sendReply(400, "Comment doesn't exist");
    }

    //alertMessage(400, "Are you sure you want to remove this comment?");

    $sql = "DELETE from comments where comments.id=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Oh dear! Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // echo var_dump($result);
    if(commentDeleted($connection, $id))
    {  
        alertMessage(200, "Comment has been deleted");
        //header('location: ../userApi/approveComment.php');
    }
    else
    {
        sendReply(400, "Something went wrong.");
    }

}

function commentExists($connection, $user_id, $position, $owned)
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

    if(mysqli_num_rows($result) > 0)
    {   
        return true;
    }
    else {
        return false;
    }
}

function commentDeleted($connection, $id)
{

    $sql = "SELECT id, user_id, position FROM comments WHERE id=?;";
    $stmt = $connection->prepare($sql);
    if (!$stmt)
    {
        sendReply(400, "Something went wrong with the connection.");  
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    

    if(mysqli_num_rows($result) > 0)
    {   
        return false; // exists == NOT deleted
    }
    else {
        return true; // !exists == deleted
    }
}

?>