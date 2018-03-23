<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/out.css">
</head>
<body>

	<?php		$fullname = strtoupper($_POST["full_name"]);
				echo "<h2>Welcome $fullname</h2>";			?>

	<!--for image upload-->
	<?php		
		$errors = array();
		$file_name = $_FILES['image']['name'];
		$file_temp = $_FILES['image']['tmp_name'];
		$target_file = "uploads/".basename($file_name);
		if(file_exists($target_file))
			$errors[] = "file already exits!!!";
		if(empty($errors))
			move_uploaded_file($file_temp, $target_file);	
		echo "<img src='$target_file'><br>$fullname";
	?>

	<!--for marksheet display-->
	<?php		
		if(!is_null($_POST['marks']) == true){
			$marks = explode("\n", $_POST["marks"]);
			foreach ($marks as &$value)	{
				$value = explode("|", $value);
			}
			$subjects = count($marks);
			echo "<table><tr><th colspan='$subjects'>MARKSHEET</th></tr><tr>";
			for ($i=0; $i < $subjects; $i++) { 
				echo "<th>".strtoupper($marks[$i][0])."</th>";
			}
			echo "</tr><tr>";
			for ($i=0; $i < $subjects; $i++) { 
				echo "<td>".$marks[$i][1]."</td>";
			}
		}
		else
			echo "<table><tr><th>MARKSHEET</th></tr><tr><td>No data entered</td>";
		echo "</tr></table><br>";
	?>
		 
	<!--for contact number-->
	<?php	
		echo "Contact : ";
		if(!is_null($_POST['contact']))
			echo $_POST["contact"];
		else echo "No data entered";
		echo "<br>";
	?>

	<!--for email validation-->
	<?php
		$access_key = '4cdf1ed54638a84a039dd6e42f11dc7a';
		$email_address = $_POST["email"];
		$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email_address.'');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		$validationResult = json_decode($json, true);
		echo "Email: ".$validationResult['email']."	( ";
		$arr = array("gmail","hotmail","rediff","yahoo");
		if($validationResult['format_valid'])
			if($validationResult['smtp_check'])
				if(in_array(strtok($validationResult['domain'], "."), $arr))
					echo "Invalid Syntax : Cannot use Public email id )";
				else
					echo "Valid Syntax )";
			else
					echo "Valid Syntax - SMTP_CHECK : fail )";
		else
		echo "Invalid Syntax )";
	?>
</body>
</html>