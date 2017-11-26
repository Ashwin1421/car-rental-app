<?php
	session_start();
	if(isset($_POST["add-car"])){
		$carname = $_POST["car-name"];
		$car_id = $_POST["car-id"];
		$cartype = $_POST["car-type"];
		$carcapacity = intval($_POST["car-capacity"]);
		$carcost = floatval($_POST["car-cost"]);
		$cardeposit = floatval($_POST["car-deposit"]);
		$carcolor = $_POST["car-color"];

		//image uploads
		$image_uploads_dir = "../../public/images/uploads/";
		$target_image_file = $image_uploads_dir . basename($_FILES["car-image"]["name"]);
		$uploadOK = 1;
		$image_file_type = pathinfo($target_image_file, PATHINFO_EXTENSION);
		$image_check = getimagesize($_FILES["car-image"]["tmp_name"]);
		if($image_check !== false){
			echo "File is an image =".$check["mime"].".";
			$uploadOK = 1;
		}else{
			echo "File is not an image";
			$uploadOK = 0;
		}
		// Check if file already exists
		if (file_exists($target_image_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOK = 0;
		}
		// Check file size
		if ($_FILES["car-image"]["size"] > 500000) {
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
		} else {
		    if (move_uploaded_file($_FILES["car-image"]["tmp_name"], $target_image_file)) {
		        echo "The file ". basename( $_FILES["car-image"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
?>