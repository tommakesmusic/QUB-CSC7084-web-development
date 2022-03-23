<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

if (isset($_SESSION['user'])){
    sendMessage(200, "Username can not be changed.");
    $user = $_SESSION['user'];
    $api_url = 'http://localhost:8888/userApi/user_model.php?userDeleteAdmin=false&userName='.$user;

    // Read JSON file
    $userData = explode(" ", file_get_contents($api_url));
    //var_dump($userData);
    // echo $userData;
    echo <<<EOD
    <div class="top">
    <p id="welcome">Ready to update?</p>
    </div>
    <div class="middle">

    <div class="form-box">
    <form onsubmit="return false;" autocomplete="on">
    
    <div class="input-box.label"><label for ="">First name</label></div>
    <div class="input-box.input"><input type="text" name="firstName" id="firstName" value = "$userData[0]" autocomplete="on" pattern="[a-zA-Z0-9]+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="">Last name</label></div>
    <div class="input-box.input"><input type="text" name="lastName" id="lastName" value="$userData[1]" autocomplete="on" pattern="[a-zA-Z0-9']+" minlength="3" maxlength="20" required></div>
    <div class="input-box.label"><label for ="email">Email</label></div>
    <div class="input-box.input"><input type="email" name="emailAddress" id="email" value="$userData[3]" autocomplete="on" required></div>
    <div class="input-box.label"><label for ="password">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWord" id="passWord" autocomplete="off" pattern="[a-zA-Z0-9-_*!@£$]+" minlength="8" maxlength="20" required></div>
    <div class="input-box.label"><label for ="passWordRpt">Password</label></div>
    <div class="input-box.input"><input type="password" name="passWordRpt" id="passWordRpt" autocomplete="on" pattern="[a-zA-Z0-9-_*!@£$]+" minlength="8" maxlength="20" required></div>
    <div><input type="hidden" name="userName" value="$user"></div>
    <div><input type="hidden" name="userApiReq" value="updateUser"></div>
    
    <div><input id="submit" type="submit" value="Update"></div>
    </form>
        <script src="../js/update_user.js" defer></script>
    </div>
    <div class="bottom">
    <p>This is the bottom part of the page</p>
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