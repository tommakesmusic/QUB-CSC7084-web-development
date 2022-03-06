<?php
// helpers.php

function sendReply($code, $message)
{
    http_response_code($code);
    echo $message;
    exit();
}


?>