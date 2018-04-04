<?php 
		$access_key = '4cdf1ed54638a84a039dd6e42f11dc7a';
		$email_address = $_POST["email"];
		$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email_address.'');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);
		$validationResult = json_decode($json, true);
		$arr = array("gmail","hotmail","rediff","yahoo");
		if($validationResult['format_valid'] && $validationResult['smtp_check'])
				if(in_array(strtok($validationResult['domain'], "."), $arr))
					echo "Invalid: Cannot use Public ID";
				else
					echo "Valid ID";
		else
		echo "Invalid Email";
 ?>