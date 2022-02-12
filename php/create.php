<?php

    $user_name    = $_POST['txtUserName'];
    $first_name  = $_POST['txtFirstName'];
    $last_name   = $_POST['txtLastName'];
    $email       = $_POST['txtEmail'];
 
    include('connection.php');
    $insert="insert into (DATABASE) (user_name, first_name,last_name,email,mobile) values('$user_name', $first_name','$last_name','$email')";
    	
	
	if (mysqli_query($connection,$insert)) {
		$resultData = array('status' => true, 'message' => "Your record inserted successfully");
	} else {
		$resultData = array('message' => "Unable to create record");
	}
	header('content-type: application/json');
	echo json_encode($resultData);
?>