<?php
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', 'root');
	define('DBNAME', 'car_rental_app');
	define('DBPORT', 3306);

	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME, DBPORT);
	if(mysqli_connect_errno()){
		echo 'Connection Failed->'.mysqli_connect_error();
		exit;
	}else{
		echo 'Connection established';
	}
?>