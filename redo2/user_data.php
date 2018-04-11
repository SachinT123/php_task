<?php 
	session_start();
	include "dbConnect.php";
	$errors = array();
	$img_exists = 0;
	$file_name = $_FILES['image']['name'];
	$file_temp = $_FILES['image']['tmp_name'];
	$target_file = "../uploads/".basename($file_name);
	if(file_exists($target_file))
		$img_exists = 1;

	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  	// Valid file extensions
 	$extensions_arr = array("jpg","jpeg","png","gif");
 	if(!in_array($imageFileType, $extensions_arr))
 		array_push($errors, "inv_ext");

	$marks = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $_POST['marks']);
	$marks = explode("\n" , trim($marks));
    $count = count($marks);
    $temp = "";
    for ($i=0; $i < $count; $i++) { 
    	$marks[$i] = trim($marks[$i]);
        if(preg_match("/(^[a-z\s]+[|](\d{1,2}|100)$)/i",$marks[$i]))
        	$temp .= $marks[$i]."\n";
        else{
        	array_push($errors,"inv_for");
        	break;
        }
    }
    if(!preg_match("/^(\+91)[1-9]\d{9}$/", $_POST['contact']))
    	array_push($errors,"inv_cn");
    $marks = $temp;
    if(empty($errors)){
		$sql = "update userinfo set image = '" . $target_file . "', marks = '" . strtoupper(trim($marks)) . "', contact = '" . $_POST['contact'] . "' where email = '" . $_SESSION['user_name'] . "'";
		$query = mysqli_query($conn,$sql);

		if($query && !$img_exists)
			move_uploaded_file($file_temp, $target_file);
	}
	echo implode(" ", $errors);
	mysqli_close($conn);
	return $query;		 
 ?>