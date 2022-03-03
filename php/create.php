<?php
	// Create a record in the db
    $username    =  'ZereYzf1000'; // $_POST['txtUserName'];
    $first_name  =  'Tommy'; // $_POST['txtFirstName'];
    $last_name   =  'Watson'; // $_POST['txtLastName'];
    $user_role   =  'admin';// $_POST['user_role'];
 
    include('connection.php');
    $insert="insert into Web_Test.User (user_name, first_name, last_name, user_role) values('$user_name', $first_name','$last_name','$user_role')";
    	
	
	if (mysqli_query($connection,$insert)) {
		$resultData = array('status' => true, 'message' => "Your record inserted successfully");
	} else {
		$resultData = array('message' => "Unable to create record");
	}
	// header('content-type: application/json');
	echo json_encode($resultData);
?>