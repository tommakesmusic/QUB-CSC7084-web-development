<?php
// helpers.php

function sendReply($code, $message)
{
    http_response_code($code);
    echo $message;
    exit();
}

function sendMessage($code, $message)
{
    http_response_code($code);
    echo $message;
    return;
}

function alertMessage($code, $message)
{
    http_response_code($code);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("'.$message.'")';
    echo '</script>';
    return;
}

function alertAndGo($code, $message)
{
    http_response_code($code);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("'.$message.'")';
    echo '</script>';
}

function goHome(){
    echo '<script type ="text/JavaScript">'; 
    echo "window.location = '../index.php'";
    echo '</script>';
}

function goLogin() {
    echo '<script type ="text/JavaScript">'; 
    echo "window.location = '../userApi/login.php'";
    echo '</script>';
}

?>