<?php
session_start();

if (isset($_SESSION['user'])){
    echo $_SESSION['userRole'];
}
else {
    echo "notSet";    
}
?>