<?php
	session_start();
	if(isset($_POST['update-car'])){
		$carname = $_POST["car-name"];
		$carname = strip_tags($carname);
		$carname = htmlspecialchars($carname);

		$car_id = $_SESSION['car_id'];
		
		$cartype = $_POST["car-type"];
		$cartype = strip_tags($cartype);
		$cartype = htmlspecialchars($cartype);

		$carcapacity = intval($_POST["car-capacity"]);
		$carcapacity = strip_tags($carcapacity);
		$carcapacity = htmlspecialchars($carcapacity);

		$carcost = floatval($_POST["car-cost"]);
		$carcost = strip_tags($carcost);
		$carcost = htmlspecialchars($carcost);
		
		$new_car_image = basename($_FILES["car-image"]["name"]);
		//image uploads
		if($new_car_image){
			$image_uploads_dir = "../../public/images/uploads/";
			$target_image_file = $image_uploads_dir . basename($_FILES["car-image"]["name"]);
			$uploadOK = 1;
			$image_file_type = pathinfo($target_image_file, PATHINFO_EXTENSION);
			$image_check = getimagesize($_FILES["car-image"]["tmp_name"]);
			if($image_check !== false){
				echo "File is an image =".$check["mime"].".";
				$uploadOK = 1;
			}else{
				echo "$new_car_image<br>";
				echo "File is not an image";
				$uploadOK = 0;
			}
			// Check if file already exists
			if (file_exists($target_image_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOK = 0;
			}
			// Check file size
			if ($_FILES["car-image"]["size"] > 500000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOK = 0;
			}
			// Allow certain file formats
			if(
				$image_file_type != "jpg" && 
				$image_file_type != "png" && 
				$image_file_type != "jpeg" && 
				$image_file_type != "gif" ) {

			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOK = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOK == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} 
			else 
			{
			    if (move_uploaded_file($_FILES["car-image"]["tmp_name"], $target_image_file)) {
			    	$uploadOK =1;
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}

		include 'dbconnect.php';

		if($new_car_image){
			$sql1 = "UPDATE car
					 SET name = '$carname',
						 type = '$cartype',
						 image = '$new_car_image'
					 WHERE _id = '$car_id'";

			$sql2 = "UPDATE car_details
					 SET capacity = $carcapacity,
						 cost_per_hour = $carcost
					 WHERE car_id = '$car_id'";

			$res1 = mysqli_query($conn, $sql1);
			$res2 = mysqli_query($conn, $sql2);
			if(!$res1){
				echo "Error in query1";
			}
			if(!$res2){
				echo "Error in query2";
			}
			if($res1 && $res2){
				header('Location: ../views/carview.php');
			}
		}else{
			$sql1 = "UPDATE car
					 SET name = '$carname',
						 type = '$cartype'
					 WHERE _id = '$car_id'";

			$sql2 = "UPDATE car_details
					 SET capacity = $carcapacity,
						 cost_per_hour = $carcost
					 WHERE car_id = '$car_id'";

			$res1 = mysqli_query($conn, $sql1);
			$res2 = mysqli_query($conn, $sql2);
			if(!$res1){
				echo "Error in query1";
			}
			if(!$res2){
				echo "Error in query2";
			}
			if($res1 && $res2){
				header('Location: ../views/carview.php');
			}
		}

	}
?>