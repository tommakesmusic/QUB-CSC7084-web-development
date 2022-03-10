<?php
 // Database connection
 $hostname="localhost";
 $username="root";
 $password="root";
 $database="Favourite_500";
 
 // Two versions - both are here:
 // $connection = mysqli_connect($hostname, $username, $password, $database); 

$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_errno) {
    http_response_code(400);
    header('content-type: text/plain');
    echo $connection->connect_error;
    exit();
} else {
    // echo "Connection successful";
}

?>