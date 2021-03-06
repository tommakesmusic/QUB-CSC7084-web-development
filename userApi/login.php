<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
require_once '../php/helpers.php';
session_start();

if (!isset($_SESSION['user'])){
    echo <<<EOD
    <div class="top">
    <p id="welcome">Wassup!</p>
    <p>Sign in with your username and password to get access to more features!</p></div>
    <div class="middle">

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
    <div class="bottom">
    <p>Have fun!</p>
    </div>
EOD;
}
else
{
    alertMessage(200, "Already logged in as ". $_SESSION['user']);
    goHome();
}

require_once '../html/footerSubFolder.html';
?>