<?php
	session_start();
	if(isset($_POST["delete-order-from-orders"])){
		$order_id = $_POST["order-id"];
		$car_id = $_POST["car-id"];
		include 'dbconnect.php';
		$sql1 = "DELETE FROM rent_order WHERE order_id='$order_id'";
		$res1 = mysqli_query($conn, $sql1);
		$sql2 = "UPDATE car SET status=false WHERE _id = '$car_id'";
		$res2 = mysqli_query($conn, $sql2);
		if($res1 && $res2){
			
			header("Location: ../views/orders.php");
		}else{
			
			header("Location: ../views/orders.php");
		}
	}

	if(isset($_POST["delete-order-from-cart"])){
		$order_id = $_POST["order-id"];
		$car_id = $_POST["car-id"];
		$user_id = $_SESSION["uid"];
		include 'dbconnect.php';
		$sql1 = "DELETE FROM rent_order WHERE order_id='$order_id'";
		$res1 = mysqli_query($conn, $sql1);
		$sql2 = "UPDATE car SET status=false WHERE _id = '$car_id'";
		$res2 = mysqli_query($conn, $sql2);
		if($res1 && $res2){
			
			header("Location: ../views/cartview.php?id=$user_id");
		}else{
			
			header("Location: ../views/cartview.php?id=$user_id");
		}
	}
?>