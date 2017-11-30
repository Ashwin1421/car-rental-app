<?php
	session_start();
	include 'dbconnect.php';
	
	/*if(isset($_POST['search'])){
		$pick_up_location = $_POST['pick-up-location'];
		$pick_up_date = $_POST['pick-up-date'];
		$drop_off_location = $_POST['drop-off-location'];
		$drop_off_date = $_POST['drop-off-date'];
		$car_type = $_POST['car-type'];

		$sql = "SELECT _id, name, type, capacity, cost_per_hour, image 
				FROM car, car_details 
				WHERE `car`.`_id` = `car_details`.`car_id` 
				AND type='$car_type'";
		$res = mysqli_query($conn, $sql);
		$res_json = array();

		while($row = mysqli_fetch_assoc($res)){
			echo "<a href='#' class='list-group-item'>";
			echo "<img class='img-thumbnail' src='../../public/images/uploads/".$row['image']."' alt='".$row['name']."'>";
			echo "<div class='car-details'>";
			echo "<h4>$row['name']</h4>";
		}
		header('Location: ../views/carview.php');
		
	}*/
	if(isset($_POST['admincontrol'])){
		$sql = "SELECT _id, name, type, capacity, cost_per_hour, image 
				FROM car, car_details WHERE `car`.`_id` = `car_details`.`car_id`";

		$res = mysqli_query($conn, $sql);
		$res_json = array();
		while($row = mysqli_fetch_assoc($res)){
			$res_json[] = $row;
		}
		echo json_encode($res_json);
	}
?>