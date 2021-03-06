<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once '../html/headerSubFolder.html';
require_once '../php/helpers.php';
session_start();

$userRole = $_SESSION['userRole'];
// alertMessage(400, $userRole);
if (!isset($_SESSION['user']))
{

    alertMessage(401, "You must be logged in.");
    goHome();
    exit();
}
else if ($userRole !="admin")
{
    alertMessage(401, $_SESSION['user']." is not an administrator");
    goHome();
}
?>

<div class="top">
    <p id="welcome">Howdy, Admin!</p>
    <div class="content-top-right">
        <?php
            require_once '../php/userButtons.php';
        ?>
    </div>
</div>
<div class = "middle">
    <?php
include_once 'all_recordsAdmin.php';
?>
</div>

<div class="bottom">
    This is the bottom of the page

</div>

<?php   
    require_once '../html/footerSubFolder.html';
?>