<!DOCTYPE html>
<html>
<head>
	<title>User Info</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/login.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="info_container">

		<h1 class="title">REGISTER ACCOUNT</h1>
	
		<form id="login" method="POST" enctype="multipart/form-data">
			<fieldset class="data" id="fname">
				<legend>First Name</legend>
				<input type="text" name="first_name" pattern="[a-zA-Z]+" class="info fname" placeholder="Enter First Name">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="lname">
				<legend>Last Name</legend>
				<input type="text" name="last_name" pattern="[a-zA-Z]+" class="info lname" placeholder="Enter Last Name" onkeyup="myname(this.form);">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="name">
				<legend>Full Name</legend>
				<input type="text" name="full_name" class="info name" style="text-transform: uppercase; cursor: not-allowed;"  readonly>
			</fieldset>
	
			<fieldset class="data" id="email">
				<legend>Email ID</legend>
				<input type="text" name="email" class="info email" placeholder="This will be your Username">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="contact">
				<legend>Contact No.</legend>
				<input type="text" name="contact" class="info contact" pattern="^(\+91)[1-9]\d{9}$" placeholder="Enter phone no. with +91 as prefix">
			</fieldset>
	
			<fieldset class="data" id="submit">
				<button type="submit" name="submit" class="button">SUBMIT</button>
			</fieldset>	
		</form>
	</div>

	<script type="text/javascript" src="../js/form.js"></script>
</body>
</html>