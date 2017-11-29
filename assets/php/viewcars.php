<?php
	session_start();
	include 'dbconnect.php';
	$sql = "SELECT * FROM cars";
	$res = mysqli_query($conn, $sql);
	$res_json = array();
	while($row = mysqli_fetch_assoc($res)){
		$res_json[] = $row;
	}
	echo json_encode($res_json);
?>