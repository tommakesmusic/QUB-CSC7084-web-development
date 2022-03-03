<?php
	// SELECT a single record
	include('connection.php');
	//$id = $_REQUEST['id'];
	$id = 1;
	$select="select * from user";
	$record=mysqli_query($connection,$select);
	$row=mysqli_fetch_row($record);
	if (!empty($row)) {
		$resultData = $row;
	} else {
		$resultData = array('message' => "No Data Found");
	}
	//header('content-type: application/json');
	//echo json_encode($resultData);
	//echo '<article class="content-genre-box flow bg-secondary-400 text-neutral-100">';
	//echo '<div class="flex">';
	echo implode(" ", $resultData);
	//echo json_encode($resultData);
	//echo '</div></article>';
?>