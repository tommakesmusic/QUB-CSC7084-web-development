<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user']) && $_SESSION['userRole'] == 'admin'){
    sendMessage(200, "Search results here.");
    $user = $_GET['user_id'];
    $userName = $_GET['userName'];
    $api_url = 'http://localhost:8888/api/model.php?action=approve&value='.$user;

    // Read JSON file
    //try{
        $commentData = json_decode(file_get_contents($api_url), TRUE);


    echo '<div class="top">';
    echo '<div class=top-left">';
    echo '<p id="welcome">This is where you can approve comments:</p></div>';
    echo '<div class=top-right">';
    echo '<p>All comments need the approval of an Admin before they are shown. Here are a list of comments for user <h3>'.$userName.'</h3></p>';
    echo '</div></div>';
    echo '<div class="middle">';

    if ($commentData) {
        echo '<div style="overflow-x:auto;">';
        echo '<table>';
          echo '<tr>';
          echo  '<th>Owned</th>';
          echo  '<th>Comment:</th>';
          echo  '<th>Album name:</th>';
          echo  '<th>Approve</th>';
          echo  '<th>Delete</th>';
          echo '</tr>';
    // echo var_dump($userData);
        foreach ($commentData as $row){
            echo '<tr>';
            echo '<td><div>'.$row["owned"].'</div></td>';
            echo '<td><div>'.$row["comment"].'</div></td>';
            echo '<td><div>'.$row["album_name"].'</div></td>';
            echo "<td><button class='stdButton'><a href='http://localhost:8888/api/model.php?action=approved&value=".$row['id']."'>Approve Comment</a></button></td>";
            echo "<td><button class='stdButton'><a href='http://localhost:8888/api/model.php?action=delete&value=".$row['id']."'>Delete Comment</a></button></td>";
            echo '</tr>';
        }
    echo '</table>';
    }
    else {
        echo "<h3>No unapproved comments found!</h3>";
    }
    echo '</div>';

    echo '<div class="bottom">';
    echo '<p>As an admin you have a lot of responsibility.</p>';
    echo '</div>';
}

else {
    alertMessage(400, "Can't approve comments if you're not an admin!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>