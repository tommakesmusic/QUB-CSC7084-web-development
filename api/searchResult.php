<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Search results here.");
    $position = $_GET['value'];
    $user = $_SESSION['id'];
    $owned = 0;
    $comment = "";
    //$userName = $_SESSION(['user']);
    $api_url = 'http://localhost:8888/api/model.php?action='.$_GET['action'].'&value='.$_GET['value'];

    // Read JSON file
    $userData = json_decode(file_get_contents($api_url), TRUE);

    // echo $userData;
    $comment_url = 'http://localhost:8888/api/model.php?action=comment&album='.$position.'&user='.$user;
    $commentData = json_decode(file_get_contents($comment_url), TRUE);
    if ($commentData){
        foreach ($commentData as $row){
            $owned =  $row['owned'];
            $comment =  $row['comment'];
        }
    }
    
    echo '<div class="top">';
    echo '<div class="top-left">';
    echo '<p id="welcome">Who you looking for</p></div>';
    echo '<div class=top-right">';
    if ($owned == 1){
        echo "<h3>I OWN IT</h3>";
    }
    if ($comment!=""){
        echo '<h4>'.$comment.'</h4>';
    }
    if ($owned == 0 || $comment = ""){
        echo "<h4>Do you own this or want to make a comment?</h4>";
        echo "<button class='stdButton'><a href='addComment.php?position=$position'>Add my comment</a></button>"; 
    }
    echo '</div></div>';
    echo '<div class="middle">';
    if ($userData) {
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
    foreach ($userData as $row){
        echo '<tr>';
        echo '<td><div>'.$row["position"].'</div></td>';
        echo '<td><div>'.$row["year"].'</div></td>';
        echo '<td><div>'.$row["album_name"].'</div></td>';
        echo '<td><div>'.$row["artist_name"].'</div></td>';
        echo '<td><div>'.$row["genre"].'</div></td>';
        echo '<td><div>'.$row["subgenre"].'</div></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '<div class="bottom">';
    echo '<p>All data is supplied for entertainment purposes only</p>';
    echo '</div>';
}
}
else {
    alertMessage(400, "Can't search if you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>