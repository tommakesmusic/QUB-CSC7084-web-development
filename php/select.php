<?php
	include('connection.php');
	$id = $_REQUEST['id'];
	$select="select * from register where id=$id";
	$record=mysqli_query($conneection,$select);
	$row=mysqli_fetch_row($record);
	if (!empty($row)) {
		$resultData = $row;
	} else {
		$resultData = array('message' => "No Data Found");
	}
	header('content-type: application/json');
	echo json_encode($resultData);
?>