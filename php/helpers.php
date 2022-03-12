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
}

function alertMessage($code, $message)
{
    http_response_code($code);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("'.$message.'")';
    echo '</script>';
}
?>