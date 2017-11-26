<?php
	session_start();
	if(isset($_POST["username"])){
		$username = $_POST["username"];
		$sql = "SELECT count(*) FROM users WHERE username='$username'";
		include 'dbconnect.php';
		$res = mysqli_query($conn, $sql);
		if(!res){
			echo "Error in mysql query";
		}else{
			$row = mysqli_fetch_array($res);
			$user_count = $row[0];
			if($user_count>0){
				echo "not available";
			}else{
				echo "available";
			}
		}
	}
?>