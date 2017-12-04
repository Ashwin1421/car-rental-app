<?php
	session_start();
	if(isset($_POST["login"])){

		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);

		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);

		$password_hash = hash('sha512', $password);

		$sql = "SELECT * FROM user WHERE username='$username' AND password='$password_hash'";
		include 'dbconnect.php';
		$res = mysqli_query($conn, $sql);

		if(!$res || (mysqli_num_rows($res) == 0) ){
			echo "Error";
			header("Location: ../views/login.html");
		}else{
			$row = mysqli_fetch_assoc($res);
			if($row["username"] == $username && $row["password"] == $password_hash){
			
				$_SESSION["username"] =$username;
				$_SESSION["fname"] = $row["f_name"];
				$_SESSION["admin"] = $row["admin"];
				$_SESSION["uid"] = $row["_id"];

				header("Location: ../../index.php");
			}
		}
	}
?>