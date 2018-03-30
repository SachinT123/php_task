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
	$target_file = "../uploads/".basename($file_name);
	if(file_exists($target_file))
		$errors = "file already exits!!!";

	$marks = explode("\n" , $_POST['marks']);
    $count = count($marks);
    $temp = "";
    for ($i=0; $i < $count; $i++) { 
    	$marks[$i] = ltrim(rtrim($marks[$i]));
        if(preg_match("/(^[a-z0-9]+[|](\d{1,2}|100)$)/i",$marks[$i]))
        	$temp .= $marks[$i]."\n";
    }
    $marks = $temp;

	$sql = "update userinfo set image = '" . $target_file . "', marks = '" . strtoupper(rtrim($marks)) . "', contact = '" . $_POST['contact'] . "' where email = '" . $_SESSION['user_name'] . "'";
	$query = mysqli_query($conn,$sql);

	if($query && is_null($errors))
		move_uploaded_file($file_temp, $target_file);
	
	mysqli_close($conn);
	return $query;		 
 ?>