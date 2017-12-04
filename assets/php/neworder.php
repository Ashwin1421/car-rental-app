<?php
	session_start();
	if(isset($_POST["book-now"])){
		$order_id = uniqid();
		$pick_up_date = $_POST["pick-up-date"];
		$drop_off_date = $_POST["drop-off-date"];
		$total_rent_amt = floatval($_POST["rent-amount"]);
		$car_id = $_POST["car-id"];
		$user_id = $_POST["user-id"];

		echo $order_id."<br>";
		echo $order_date."<br>";
		echo $pick_up_date."<br>";
		echo $drop_off_date."<br>";
		echo $total_rent_amt."<br>";
		echo $car_id."<br>";
		echo $user_id."<br>";
		include 'dbconnect.php';

		$sql1 = "UPDATE car 
				 SET status=true 
				 WHERE _id='$car_id' 
				 AND deleted=false";
		$res1 = mysqli_query($conn, $sql1);

		$sql2 = "INSERT INTO 
				rent_order(order_id, pickup_date, dropoff_date, rent_amount, car_id, user_id) 
				VALUES 
				('$order_id', STR_TO_DATE('$pick_up_date', '%m/%d/%Y'), STR_TO_DATE('$drop_off_date', '%m/%d/%Y'), $total_rent_amt, '$car_id','$user_id')";

		$res2 = mysqli_query($conn, $sql2);
		if($res1 && $res2){

			header("Location: ../views/cartview.php?id=$user_id");
		}else{
			echo "error"."<br>";
			echo mysqli_error($conn);
		}
	}
?>