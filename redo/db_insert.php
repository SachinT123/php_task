<?php 
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
	
	$sub = count($_POST)-5;
	$marks = "";
	for($i=0; $i < $sub; $i++)
		{
			$subVal = "subject_".($i+1);
			$marks .= $_POST[$subVal]."\n";
		}

	$sql = "insert into task values ('" . strtoupper($_POST['first_name']) . "','" . strtoupper($_POST['last_name']). "','" . $target_file . "','" . strtoupper($marks) . "','" . $_POST['contact'] . "','" . $_POST['email'] . "')";
 	
 	$result = mysqli_query($conn,$sql);
	if($result && is_null($errors))
		move_uploaded_file($file_temp, $target_file);

 	mysqli_close($conn);
 	return $result;
 ?>
