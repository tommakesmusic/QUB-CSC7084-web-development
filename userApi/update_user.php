<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Username can not be changed.");
    echo <<<EOD
    <div class ="content-genre-box">
    <form onsubmit="validateForm()" autocomplete="on">
        <div><label for ="">First name</label><input type="text" name="firstName" id="firstName" value = "" autocomplete="on" required></div>
        <div><label for ="">Last name</label><input type="text" name="lastName" id="lastName" autocomplete="on" required></div>
        <div><label for ="">Email</label><input type="email" name="emailAddress" id="emailAddress" autocomplete="on" required></div>
        <div><label for ="">Password</label><input type="password" name="passWord" id="passWord" autocomplete="on" required></div>
        <div><label for ="">Password</label><input type="password" name="passWordRpt" id="passWordRpt" autocomplete="on" required></div>
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