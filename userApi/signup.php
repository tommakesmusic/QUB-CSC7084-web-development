<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
require_once '../php/helpers.php';
session_start();

if (!isset($_SESSION['user'])){
    //sendMessage(200, "In session");
     echo <<<EOD
    <div class="top">
    <p id="welcome"> Hi there!</p><p>We're glad you've decided to join us on the Favourite 500! Please enter your details below:</p></div>
    <div class="top-right -fs-300" >
    <ul>
    <li> First name - Your first name. This can only contain letters and numbers and must be between 4 and 20 characters long.</li>
    <li> Last name - Your last name. This can only contain letters and numbers and must be between 4 and 20 characters long.</li>
    <li> Username - Your username. This can only contain letters and numbers and must be between 4 and 20 characters long: Note this cannot be changed</li>
    <li> Email - Your email address. This must a valid email format.</li>
    <li> Password - Choose a password between 8 and 20 characters long.</li>
    <li> Password (repeat) - Re enter your password.</li> </ul>
    </div>
    <div class="middle">

    <div class="form-box">
    <form onsubmit="return false;" autocomplete="on">
    
    <div class="input-box.label"><label for ="">First name</label></div>
    <div class="input-box.input"><input type="text" name="firstName" id="firstName" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="">Last name</label></div>
    <div class="input-box.input"><input type="text" name="lastName" id="lastName" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="userName">Username</label></div>
    <div class="input-box.input"><input type="text" name="userName" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="4" maxlength="12" required></div>
    <div class="input-box.label"><label for ="email">Email</label></div>
    <div class="input-box.input"><input type="email" name="emailAddress" id="email autocomplete="on" required></div>
    <div class="input-box.label"><label for ="password">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWord" id="passWord" autocomplete="off" minlength="8" maxlength="20" required></div>
    <div class="input-box.label"><label for ="passWordRpt">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWordRpt" id="passWordRpt" autocomplete="on" minlength="8" maxlength="20" required></div>
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