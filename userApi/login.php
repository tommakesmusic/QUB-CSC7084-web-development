<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
?>

<div class ="content-genre-box">
<form onsubmit="return false;" autocomplete="on">
    <div><label for ="">Username</label><input type="text" name="userName" autocomplete="on"></div>
    <div><label for ="">Password</label><input type="password" name="passWord" autocomplete="on"></div>
    <div><label for ="">Password</label><input type="password" name="passWordRpt" autocomplete="on"></div>
    <div><input type="hidden" name="userApiReq" value="login"></div>
    <div><input type="submit" value="Login"></div>
</form>
<script src="../js/login.js" defer></script>
</div>

<?php
require_once '../html/footerSubFolder.html';
?>