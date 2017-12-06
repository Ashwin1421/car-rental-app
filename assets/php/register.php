<?php
	session_start();
	include_once 'dbconnect.php';
	if(isset($_POST['register-btn'])){
		
		//protection
		//against sql injections
		$fname = trim($_POST['fname']);
		$fname = strip_tags($fname);
		$fname = htmlspecialchars($fname);

		$lname = trim($_POST['lname']);
		$lname = strip_tags($lname);
		$lname = htmlspecialchars($lname);

		$username = trim($_POST['username']);
		$username = strip_tags($username);
		$username = htmlspecialchars($username);

		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);

		$address = trim($_POST['address']);
		$address = strip_tags($address);
		$address = htmlspecialchars($address);

		$password_hash = hash('sha512', $password);
		$_id = uniqid($username);

		$sql = "INSERT INTO user(_id,f_name,l_name,username,password,address) 
				VALUES('$_id', '$fname', '$lname', '$username', '$password_hash', '$address')";

		include_once 'dbconnect.php';
		$res = mysqli_query($conn, $sql);
		if(!$res){
			echo "Error in mysqli query";
		}else{
			
			$_SESSION["username"] =$username;
			$_SESSION["fname"] = $fname;
			$_SESSION["uid"] = $_id;

			header("Location: ../../index.php");
		}

	}
	
?>