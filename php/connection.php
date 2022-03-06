<?php
 // Database connection
 $hostname="localhost";
 $username="root";
 $password="root";
 $database="Web_Test";
 
 // Two versions - both are here:
 // $connection = mysqli_connect($hostname, $username, $password, $database); 

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_errno) {
    http_response_code(400);
    header('content-type: text/plain');
    echo $conn->connect_error;
    exit();
} else {
    // echo "Connection successful";
}

?>