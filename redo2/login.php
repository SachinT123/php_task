<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/login.css">
</head>
<body>
	<div class="info_container">

		<h1 class="title">LOGIN</h1>
	
		<form id="login" method="POST" enctype="multipart/form-data">
			<fieldset class="data" id="email">
				<legend>Username/Email ID</legend>
				<input type="text" name="email" class="info email" placeholder="Enter your Email ID" maxlength="255" onkeyup="if(this.length>255) this.value=this.value.substr(0, 255)" onblur="checkemail(this.value)">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="contact">
				<legend>Contact No.</legend>
				<input type="text" name="contact" class="info contact" value="+91" pattern="^(\+91)[1-9]\d{9}$" placeholder="Enter phone no." title="10 digit number with '+91' as country code">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="submit">
				<button type="submit" name="submit" class="button">SUBMIT</button>
				<br><a href="index.php">Create a new Account</a>
			</fieldset>	
		</form>
	</div>

	<script type="text/javascript" src="../js/RegisterForm.js"></script>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

</html>

<?php 
	session_start();
	
	include "dbConnect.php";
	if(isset($_POST['submit']) && $_SESSION['login_instance'] == 0)	
	{
		$sql = "select * from userinfo where email = '" . $_POST['email'] . "' && contact = '" . $_POST['contact'] . "'";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		if(!empty($row)){
			$_SESSION['user_name'] = $_POST['email'];
			header("location:form2.php");
		}
		else{
			echo "<script>alert('Invalid username or password');</script>";
		}
	}
 ?>
