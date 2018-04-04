<?php 
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	//initiate mysql connection
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);
	
	$valid = array();
	$fn = $_POST['first_name'];
	$ln = $_POST['last_name'];
	$eid = $_POST['email'];
	$phno = $_POST['contact'];
	if(!preg_match("/[a-z]+$/i", $fn))
		array_push($valid, "FN");
	if(!preg_match("/[a-z]+$/i", $ln))
		array_push($valid,"LN");
	if(!preg_match("/^(\+91)[1-9]\d{9}$/", $phno))
		array_push($valid, "CN");
	if(!filter_var($eid,FILTER_VALIDATE_EMAIL))
		array_push($valid,"IF");
	else 
	{
		function mailcheck(){
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
						return '2';
					else
						return '1';
			else
				return '3';
		}
		switch (mailcheck()) {
			case '1':	break;
			case '2':	array_push($valid,"PI");
					break;
			case '3': array_push($valid,"IE");
					break;
		}
	}

	if(empty($valid)){
		$sql = "select * from userinfo where email = '" . $eid . "'";
		$query = mysqli_query($conn,$sql);
		if(mysqli_num_rows($query) == 0){
			$sql = "insert into userinfo ( first_name, last_name, email, contact) values('" . strtoupper($fn) . "','" . strtoupper($ln) . "','" . $eid . "','" . $phno . "')";
			$query = mysqli_query($conn,$sql);
			//assign session variable to be used later
			$_SESSION['user_name'] = $_POST['email'];
		}
		else{
			array_push($valid, "AR");
		}
	}
	if(empty($valid))
		echo "";
	else
		echo implode(" ", $valid);
	if(!$query)
		echo "Query cannot be executed!!!";
	mysqli_close($conn);//close connection
	return $query;
?>
