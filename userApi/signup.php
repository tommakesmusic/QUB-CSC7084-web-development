<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
require_once '../php/helpers.php';
session_start();

if (!isset($_SESSION['user'])){
    //sendMessage(200, "In session");
     echo <<<EOD
    <div class="top"> This is the top section. Info goes here</div>
    <div class="middle">
    <div class="input.float-right>
    <form onsubmit="return false;" autocomplete="on">
    <div><label for ="firstName">First name</label><input type="text" name="firstName" id="firstName" autocomplete="on" required>
    <div><label for ="lastName">Last name</label><input type="text" name="lastName" id="lastName" autocomplete="on" required>
    <div><label for ="userName">Username</label><input type="text" name="userName" autocomplete="on" required>
    <div><label for ="email">Email</label><input type="email" name="emailAddress" id="email autocomplete="on" required>
    <div><label for ="password">Password</label><input type="password" name="passWord" id="passWord" autocomplete="off" required>
    <div><label for ="passWordRpt">Password</label><input type="password" name="passWordRpt" id="passWordRpt" autocomplete="on" required>
    <div class="input-box.input"><input type="hidden" name="userApiReq" value="signup"></div>
    <div><input type="submit" value="Signup"></div>
    </form>
        <script src="../js/signup.js" defer></script>
    </div>
    </div>
    <div class="bottom">
    <p>This is the bottom part of the page</p>
    </div>
    EOD;
}
else
{
    sendMessage(400, "You are already logged in.");
}
require_once '../html/footerSubFolder.html';
?>