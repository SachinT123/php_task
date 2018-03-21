<?php
		$errors = array();
		$file_name = $_FILES['image']['name'];
		$file_temp = $_FILES['image']['tmp_name'];
		$target_file = "uploads/".basename($file_name);
		if(file_exists($target_file))
			$errors[] = "file already exits!!!";
		if(empty($errors))
			move_uploaded_file($file_temp, $target_file);
?>