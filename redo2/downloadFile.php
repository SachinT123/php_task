<?php
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);//database connection
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);

	//execute sql query & store result object
	$query = mysqli_query($conn,"select * from userinfo where email = '" . $_SESSION['user_name'] . "'");
 	
 	//fetch query result as an associative array 
 	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
	
	//convert 'marks' field data into array
 	$marks = explode("\n" , $row['marks']);
 	foreach ($marks as &$value) {
        $value = explode("|",$value);
        $value[0] = ltrim(rtrim($value[0]));
        $value[1] = ltrim(rtrim($value[1]));
	}

	//use the fetched data to write into file
	//data is stored as object of PhpWord class and style attributes are applied through methods defined in the classes
	require_once __DIR__.'/../vendor/autoload.php';

 	$phpWord = new \PhpOffice\PhpWord\PhpWord();
 	$phpWord->getSettings()->setHideGrammaticalErrors(true);
	$phpWord->getSettings()->setHideSpellingErrors(true);

 	$section = $phpWord->addSection(array('headerHeight'=>1000, 'marginTop' => 1800, 'borderSize'=>20));//add section
 	
 	$header = $section->addHeader();//add header
 	
 	//assign style attribute values to variables
 	$alignCenter = array('alignment' => 'center');
 	$text2 = array('size'=>16, 'color'=>'006699', 'bold'=>true);
 	$text1 = array('size'=>16, 'color'=>'000000');
 	
 	//add title text
 	$header->addTextRun($alignCenter)->addText('USER PROFILE',array('name'=>'Tahoma','size'=>27,'bold'=>true, 'color'=>'006699'));
 	//add horizontal line
 	$section->addLine(array('weight' => 3,'width'=>400,'alignment'=>'center'));

 	$section->addImage($row['image'], array('width' => 300, 'height' => 200, 'alignment' => 'center')//add image
 	 			);
 	$section->addTextBreak(3);//line break
 	
 	//add data
 	$textRun = $section->addTextRun($alignCenter);
 	$textRun->addText("Name : ", $text1);
 	$textRun->addText($row['first_name'] . " " . $row['last_name'], $text2);
 	$textRun->addText("\nContact : ", $text1);
 	$textRun->addText($row['contact'], $text2);
 	$textRun->addText("\nEmail ID : ", $text1);
 	$textRun->addText($row['email'], $text2);

 	$section->addTextBreak(3);//line break

 	//adding table
 	$table = $section->addTable(array('alignment'=>'center', 'width'=>100,'borderSize'=>5, 'cellMargin'=>100));
 	
 	$table->addRow();//add row

 	$table->addCell(null,array('gridSpan' => 2))->addTextRun($alignCenter)->addText("MARKSHEET", $text1);//add table cell
 	
 	//inserting marks into table
 	for ($r = 0; $r < count($marks); $r++) {
	    $table->addRow();
	    for ($c = 0; $c < 2; $c++) {
	        $table->addCell(4000)->addTextRun($alignCenter)->addText($marks[$r][$c],$text2);
	    }
	}

	//createWriter() : use PhpWord object & file format as arguments  
 	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');
 	$file = $row['contact'].'.docx';
 	$objWriter->save( __DIR__.'/../uploadFiles/'.$file);//save data as file in desired directory on the server(readonly)

 	//download file for client 
 	header("Content-Description: File Transfer");
	header('Content-Disposition: attachment; filename="' . $file . '"');
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Expires: 0');
	$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');
	$xmlWriter->save("php://output");

 	mysqli_close($conn);

?>