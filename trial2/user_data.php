<?php 
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);

	$file_name = $_FILES['image']['name'];
	$file_temp = $_FILES['image']['tmp_name'];
	$target_file = "uploads/".basename($file_name);
	if(file_exists($target_file))
		$errors = "file already exits!!!";

	$sub = count($_POST)-2;
	$marks = "";
	for($i=0; $i < $sub; $i++)
		{
			$subVal = "subject_".($i+1);
			$marks .= $_POST[$subVal]."\n";
		}

	$sql = "update userinfo set image = '" . $target_file . "', marks = '" . strtoupper($marks) . "', contact = '" . $_POST['contact'] . "' where email = '" . $_SESSION['user_name'] . "'";
	$query = mysqli_query($conn,$sql);

	if($query && is_null($errors))
		move_uploaded_file($file_temp, $target_file);
	
	mysqli_close($conn);
	return $query;		 
 ?>