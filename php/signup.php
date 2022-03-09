<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>

<div class ="content-genre-box">
<form>
    <div><label for ="">First name</label><input type="text" name="firstName"></div>
    <div><label for ="">Last name</label><input type="text" name="lastName"></div>
    <div><label for ="">Username</label><input type="text" name="userName"></div>
    <div><label for ="">Email</label><input type="email" name="emailAddress"></div>
    <div><label for ="">Password</label><input type="password" name="passWord"></div>
    <div><label for ="">Password</label><input type="password" name="passWordRpt"></div>
    <div><input type="hidden" name="userApiReq" value="signup"></div>
    <div><input type="submit" value="Signup"></div>
</form>
</div>

<?php
require_once 'html/footer.html';
?>