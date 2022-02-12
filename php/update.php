<?php
    $first_name  = $_POST['txtFname'];
    $last_name   = $_POST['txtLname'];
    $address     = $_POST['txtAddress'];
    $email       = $_POST['txtEmail'];
    $mobile      = $_POST['txtMobile'];

    include('connection.php');
    $update="update register set first_name='$first_name',last_name='$last_name',address='$address',email='$email',mobile='$mobile' where id='".$_REQUEST['edit_id']."'";
    if (mysqli_query($connection,$update)) {
		$resultData = array('status' => true, 'message' => "Record Updated successfully");
	} else {
		$resultData = array('message' => "Unable to update record");
	}
	header('content-type: application/json');
	echo json_encode($resultData);

?>