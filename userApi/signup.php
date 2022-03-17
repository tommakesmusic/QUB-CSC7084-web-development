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

    <div class="form-box">
    <form onsubmit="return false;" autocomplete="on">
    
    <div class="input-box.label"><label for ="">First name</label></div>
    <div class="input-box.input"><input type="text" name="firstName" id="firstName" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="">Last name</label></div>
    <div class="input-box.input"><input type="text" name="lastName" id="lastName" autocomplete="on" pattern="[a-zA-Z0-9']+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="userName">Username</label></div>
    <div class="input-box.input"><input type="text" name="userName" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="4" maxlength="12" required></div>
    <div class="input-box.label"><label for ="email">Email</label></div>
    <div class="input-box.input"><input type="email" name="emailAddress" id="email autocomplete="on" required></div>
    <div class="input-box.label"><label for ="password">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWord" id="passWord" autocomplete="off" pattern="[a-zA-Z0-9-_*!@£$]+" minlength="8" maxlength="10" required></div>
    <div class="input-box.label"><label for ="passWordRpt">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWordRpt" id="passWordRpt" autocomplete="on" pattern="[a-zA-Z0-9-_*!@£$]+" minlength="8" maxlength="10" required></div>
    <div><input type="hidden" name="userApiReq" value="signup"></div>
    <div><input id="submit" type="submit" value="Signup"></div>
    </form>
        <script src="../js/signup.js" defer></script>
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