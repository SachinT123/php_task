<?php 
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);
	$sql = "insert into userinfo ( first_name, last_name, email, contact) values('" . strtoupper($_POST['first_name']) . "','" . strtoupper($_POST['last_name']) . "','" . $_POST['email'] . "','" . $_POST['contact'] . "')";
	$query = mysqli_query($conn,$sql);
	$_SESSION['user_name'] = $_POST['email'];
	if(!$query)
		echo "Query cannot be executed!!!";
	mysqli_close($conn);
	return $query;
?>