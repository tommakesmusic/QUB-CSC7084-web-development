<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Search results here.");
    $position = $_GET['position'];
    $user = $_SESSION['id'];
    $api_url = 'http://localhost:8888/api/model.php?action=position&value='.$position;

    // Read JSON file
    $albumData = json_decode(file_get_contents($api_url), TRUE);


    echo '<div class="top">';
    echo '<div class=top-left">';
    echo '<p id="welcome">This is one of the top 500 albums</p></div>';
    echo '<div class=top-right">';
    echo '</div></div>';


    echo '<div class="middle">';
    echo <<<EOD
    <div class="form-box">
    <form onsubmit="return false;" autocomplete="off">
    <div class="input-box.label"><label for ="">Do you own it?</label></div>
    <div>No<input type="radio" name="owned" value="no" checked="checked"/> yes<input type="radio" name="owned" value="yes" /></div>
    <div class="input-box.label"><label for ="">Comment</label></div>
    <div class="input-box.input"><input type="text" name="comment" size="40"></div>
    <div><input type="hidden" name="action" value="create"></div>
    EOD;
    echo '<div><input type="hidden" name="position" value="'.$position.'"></div>';
    echo <<<EOD
    <div><input type="submit" value="Submit"></div>
    <script src="../js/comment.js" defer></script>
    </form>
    </div>
    EOD;

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
    alertMessage(400, "Can't comment If you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>