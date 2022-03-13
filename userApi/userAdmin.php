<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
require_once '../php/helpers.php';
session_start();

$userRole = $_SESSION['userRole'];
alertMessage(400, $userRole);
if (!isset($_SESSION['user']) || $userRole !="admin")
{

    alertMessage(400, $_SESSION['user']." is not an administrator");
    goHome();

}
else
{




}







require_once '../html/footerSubFolder.html';
?>