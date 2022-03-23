<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    //sendMessage(200, "Search results here.");
    
    $user = $_SESSION['id'];
    $owned = 0;
    $comment = "";
    //$userName = $_SESSION(['user']);
    try {
        $api_url = 'http://localhost:8888/api/model.php?action='.$_GET['action'].'&value='.$_GET['value'];
    } catch(Exception $e){
        sendReply(400, "Something went wrong: ".$e);
    }

    // Read JSON file
    $albumData = json_decode(file_get_contents($api_url), TRUE);


   
    
    echo '<div class="top">';
    echo '<div class="top-left">';
    echo '<p id="welcome">Who you looking for</p></div>';
    echo '<div class=top-right">';
    echo "<h4>Do you own this or want to make a comment?</h4>";

    echo '</div></div>';
    echo '<div class="middle">';
    if ($albumData) {
        echo '<div style="overflow-x:auto;">';
        echo '<table>';
          echo '<tr>';
          echo  '<th>Chart position:</th>';
          echo  '<th>Album year:</th>';
          echo  '<th>Album name:</th>';
          echo  '<th>Artist</th>';
          echo  '<th>Genre</th>';
          echo  '<th>Subgenre</th>';
          echo '</tr>';
    // echo var_dump($userData);
    foreach ($albumData as $row){
        echo '<tr>';
        echo '<td><div>'.$row["position"].'</div></td>';
        echo '<td><div>'.$row["year"].'</div></td>';
        echo '<td><div>'.$row["album_name"].'</div></td>';
        echo '<td><div>'.$row["artist_name"].'</div></td>';
        echo '<td><div>'.$row["genre"].'</div></td>';
        echo '<td><div>'.$row["subgenre"].'</div></td>';
        echo '<td><div><button class="stdButton"><a href="addComment.php?position='.$row["position"].'">Add or see your comment</a></button></div></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '<div class="bottom">';
    echo '<p>All data is supplied for entertainment purposes only</p>';
    echo '</div>';
    }
    else {
        echo '<h2>'.$_GET['value'].' not found in '.$_GET['action'].'! Sorry!</h2>'; 
    }
}
else {
    alertMessage(400, "Can't search if you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>