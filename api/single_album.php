<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Search results here.");
    //$userName = $_SESSION(['user']);
    $api_url = 'http://localhost:8888/api/model.php?action='.$_GET['action'].'&value='.$_GET['value'];

    // Read JSON file
    $userData = json_decode(file_get_contents($api_url), TRUE);

    // echo $userData;
    
    echo '<div class="top"></div>';
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
    echo '<p>This is the bottom part of the page</p>';
    echo '</div>';
}
}
else {
    alertMessage(400, "Can't update If you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>