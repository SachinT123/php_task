<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="./stylesheets/login.css">
</head>
<body>
	<div class="info_container">
		<h1 class="title">REGISTER ACCOUNT</h1>
	
		<form id="register" method="POST" enctype="multipart/form-data">
			<fieldset class="data" id="fname">
				<legend>First Name</legend>
				<input type="text" name="first_name" class="info fname" pattern="[a-zA-Z]+" placeholder="Enter First Name">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="lname">
				<legend>Last Name</legend>
				<input type="text" name="last_name" class="info lname" pattern="[a-zA-Z]+" placeholder="Enter Last Name" onkeyup="myname(this.form);"">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="name">
				<legend>Full Name</legend>
				<input type="text" name="full_name" class="info name" title="Full Name" style="text-transform: uppercase; cursor: not-allowed;" readonly>
			</fieldset>
	
			<fieldset class="data" id="email">
				<legend>Email ID</legend>
				<input type="text" name="email" class="info email" placeholder="This will be your Username" maxlength="255" onkeyup="if(this.length>255) this.value=this.value.substr(0, 255)" onblur="checkEmail(this.value)">
				<span class="error_msg"></span>
			</fieldset>
	
			<fieldset class="data" id="contact">
				<legend>Contact No.</legend>
				<input type="text" name="contact" class="info contact" value="+91" placeholder="Enter phone no. with +91 as prefix" maxlength="13" onblur="checkContact(this.value)">
			</fieldset>
	
			<fieldset class="data" id="submit">
				<button type="submit" name="submit" class="button">SUBMIT</button>
				<br>
				<a href="login.php">Already a User? LOGIN</a>
			</fieldset>	
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/RegisterForm.js"></script>
</body>
</html>

