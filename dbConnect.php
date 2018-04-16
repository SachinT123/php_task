<?php
	$db_user = "root";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);//db connection
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);
?>
