<?php
	session_start();
	if(isset($_POST["username"])){
		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);

		$sql = "SELECT count(*) FROM user WHERE username='$username'";
		include 'dbconnect.php';
		$res = mysqli_query($conn, $sql);
		if(!res){
			echo "Error in mysql query";
		}else{
			$row = mysqli_fetch_array($res);
			$user_count = $row[0];
			if($user_count>0 && !empty($username)){
				echo "not available";
			}else if($user_count == 0 && !empty($username)){
				echo "available";
			}
		}
	}
?>