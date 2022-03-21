<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
//require_once '../html/headerSubFolder.html';
//require_once '../php/helpers.php';
//session_start(); -->
// <div class="middle">
// if (!isset($_SESSION['user'])){
     echo <<<EOD


    <div class="form-box">
    <form onsubmit="return false;" autocomplete="on">
    <div class="input-box.label"><label for ="">Username</label></div>
    <div class="input-box.input"><input type="text" name="userName" autocomplete="on" required></div>
    <div class="input-box.label"><label for ="">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWord" autocomplete="on" required></div>
    <div class="input-box.label"><label for ="">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWordRpt" autocomplete="on" required></div>
    <div><input type="hidden" name="userApiReq" value="login"></div>
    <div><input type="submit" value="Login"></div>
    </form>
    <script src="../js/login.js" defer></script>
    </div>
EOD
// }
// else
// {
//     alertMessage(200, "Already logged in as ". $_SESSION['user']);
//     goHome();
// }

//require_once '../html/footerSubFolder.html';
?>