<?php
	session_start();
	session_unset();
	session_destroy();
	if(isset($_POST["user"])){
		echo $_SESSION["username"];
	}
	header("Location: ../../index.php");
	exit();
?>