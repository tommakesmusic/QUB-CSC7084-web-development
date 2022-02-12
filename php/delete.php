<?php
	include('connection.php');

	$delete="delete from register where id='".$_REQUEST['delete_id']."'";

    if (mysqli_query($connection,$delete)) {
		$resultData = array('status' => true, 'message' => "Record Deleted successfully");
	} else {
		$resultData = array('message' => "Unable to delete record");
	}
	header('content-type: application/json');
	echo json_encode($resultData);
?>