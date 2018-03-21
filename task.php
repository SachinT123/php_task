<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/out.css">
</head>
<body>
	<div id="task1">
	<?php		$fullname = strtoupper($_POST["full_name"]);
				echo "<h2>Welcome $fullname</h2>";			?>
	</div>

	<!--for image upload-->
	<div id="task2">
	<?php		
		include 'image_upload.php';		
		echo "<img src='$target_file'><br>$fullname";
	?>
	</div>

	<!--for marksheet display-->
	<div id="task3">
	<?php		include 'table_marksheet.php';	?>
	</div>
		 
	<!--for contact number-->
	<div id="task4">
	<?php	
		echo "Contact : ";
		if(!is_null($_POST['contact']))
			echo $_POST["contact"];
		else echo "No data entered";
		echo "<br>";
	?>
	</div>

	<!--for email validation-->
	<div id="task5">
	<?php
		include "email_validation.php";
		// Access and use your preferred validation result objects
		echo "Email: ".$validationResult['email']."	( ";

		$arr = array("gmail","hotmail","rediff","yahoo");

		//check if format is valid
		if($validationResult['format_valid'])
			//check if smtp requests can served
			if($validationResult['smtp_check'])
				//check for public email id
				if(in_array(strtok($validationResult['domain'], "."), $arr))
					echo "Invalid Syntax : Cannot use Public email id )";
				else
					echo "Valid Syntax )";
			else
					echo "Valid Syntax - SMTP_CHECK : fail )";
		else
		echo "Invalid Syntax )";
	?>
	</div>
</body>
</html>