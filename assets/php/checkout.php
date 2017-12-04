<?php
	session_start();
	if(isset($_POST["checkout"])){
		
		$order_id = $_POST["order-id"];
		include 'dbconnect.php';

		$sql = "UPDATE rent_order 
				SET status=true 
				WHERE order_id='$order_id'";
		$res = mysqli_query($conn, $sql);
		if($res){
			header("Location: ../views/orders.php");
		}else{
			header("Location: ../../index.php");
		}
	}
?>