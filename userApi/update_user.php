<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Username can not be changed.");
    //$userName = $_SESSION(['user']);
    $api_url = 'http://localhost:8888/userApi/user_model.php?user='.$_SESSION['user'];

    // Read JSON file
    $userData = explode(" ", file_get_contents($api_url));

    // echo $userData;
    echo <<<EOD
    <div class ="content-genre-box">
    <form onsubmit="return false;" autocomplete="on">
        <p>Member since:$userData[3]</p>
        <div><label for ="">First name</label><input type="text" name="firstName" value = "$userData[0]" autocomplete="on" required></div>
        <div><label for ="">Last name</label><input type="text" name="lastName" value = "$userData[1]" autocomplete="on" required></div>
        <div><label for ="">Email</label><input type="email" name="emailAddress" value = "$userData[2]" autocomplete="on" required></div>
        <div><label for ="">Password</label><input type="password" name="passWord" autocomplete="on" required></div>
        <div><label for ="">Password</label><input type="password" name="passWordRpt" autocomplete="on" required></div>
        <div><input type="hidden" name="userApiReq" value="user_update"></div>
        <div><input type="submit" value="Update"></div>
    </form>
    <script src="../js/update_user.js" defer></script>
    </div>
EOD;
}
else {
    alertMessage(400, "Can't update If you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
}
require_once '../html/footerSubFolder.html';
?>