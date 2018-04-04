 <?php 
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);
	$sql = "select * from userinfo where email = '" . $_SESSION['user_name'] . "'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
 ?> 

<!DOCTYPE html>
<html>
<head>
	<title>User Details</title>
	<link rel="stylesheet" type="text/css" href="./stylesheets/login.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="info_container">
		<div class="preview"><img id="preview_image" src="#" style="display: none;"></div>
		<h1 class="title">USER INFORMATION</h1>
		<form id="form2" method="POST" enctype="multipart/form-data">
			<fieldset class="data" id="name">
				<legend>Name</legend>
				<input type="text" name="name" class="info" value="<?php echo $row['first_name']." ".$row['last_name'];?>" style="cursor: not-allowed;" readonly>
			</fieldset>
			<fieldset class="data" id="email">
				<legend>Email ID</legend>
				<input type="text" name="last_name" class="info" value="<?php echo $row['email']; ?>" style="cursor: not-allowed;" readonly>
			</fieldset>
			<fieldset class="data" id="image">
				<legend>Upload Image</legend>
				<input type="file" id="imageUpload" accept=".jpg,.jpeg,.png" name="image" class="info" onchange="preview(this)">
				<span class="error_msg"></span>
			</fieldset>
			<fieldset class="data" id="marks">
				<legend>Marks</legend>
				<div id="subjects">
					<p><input type="text" class="info subjectField" name="subject_1" pattern="/(^[a-z0-9]+[|](\d{1,2}|100)$)/i" placeholder="Subject_name | Marks" required>
					<i class="remSub">X</i></p>
				</div>
				<button type="button" id="buttonAddSub" class="button">Add Subject</button>
				<span class="error_msg"></span>
			</fieldset>
			<fieldset class="data" id="contact">
				<legend>Modify phone number (if needed)</legend>
				<input type="text" name="contact" class="info contact" pattern="^(\+91)[1-9]\d{9}$" value="<?php echo $row['contact']; ?>">	
			</fieldset>
			<fieldset class="data" id="submit">
				<button type="submit" name="submit" class="button">SUBMIT</button>
			</fieldset>
		</form>
	</div>
	<script type="text/javascript" src="./js/DetailForm.js">
		
	</script>

</body>
</html>