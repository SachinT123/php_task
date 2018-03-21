<?php 

	if(isset($_GET)){
		$db_user = "root";
		$db_pass = "S@chin123";
		$db_name = "webdata";
		$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
		if($conn->connect_errno)
			die("Failed connection : " . $conn->connect_error);
		include "image_upload.php";
		$sql = "insert into task values ('" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $target_file . "','" . $_POST['marks'] . "','" . $_POST['contact'] . "','" . $_POST['email'] . "')";
	 	$result = mysqli_query($conn,$sql);
		
	 	mysqli_close($conn);
	 	return $result;
	 }
 ?>
