<?php
	session_start();
	$db_user = "root";
	$db_pass = "S@chin123";
	$db_name = "webdata";
	$conn = new mysqli("localhost",$db_user,$db_pass,$db_name);
	if($conn->connect_errno)
		die("Failed connection : " . $conn->connect_error);

	$query = mysqli_query($conn,"select * from userinfo where email = '" . $_SESSION['user_name'] . "'");
 	
 	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
	
 	$marks = explode("\n", ltrim(rtrim($row['marks'])));
 	foreach ($marks as &$val) {
 		$val = explode("|", rtrim(ltrim($val)));
 	}
 	

	require_once __DIR__.'/vendor/autoload.php';

 	$phpWord = new \PhpOffice\PhpWord\PhpWord();
 	$phpWord->getSettings()->setHideGrammaticalErrors(true);
	$phpWord->getSettings()->setHideSpellingErrors(true);
 	$section = $phpWord->addSection(array('headerHeight'=>1000, 'marginTop' => 1800, 'borderSize'=>20));
 	$header = $section->addHeader();
 	
 	$alignCenter = array('alignment' => 'center');
 	$text2 = array('size'=>16, 'color'=>'006699', 'bold'=>true);
 	$text1 = array('size'=>16, 'color'=>'000000');
 	$header->addTextRun($alignCenter)->addText('USER PROFILE',array('name'=>'Tahoma','size'=>27,'bold'=>true, 'color'=>'006699'));
 	$section->addLine(array('weight' => 3,'width'=>400,'alignment'=>'center'));

 	$section->addImage($row['image'], array('width' => 300, 'alignment' => 'center')
 	 			);
 	
 	$section->addTextBreak(3);
 	
 	$textRun = $section->addTextRun($alignCenter);
 	$textRun->addText("Name : ", $text1);
 	$textRun->addText($row['first_name'] . " " . $row['last_name'], $text2);
 	$textRun->addText("\nContact : ", $text1);
 	$textRun->addText($row['contact'], $text2);
 	$textRun->addText("\nEmail ID : ", $text1);
 	$textRun->addText($row['email'], $text2);

 	$section->addTextBreak(3);

 	$table = $section->addTable(array('alignment'=>'center', 'width'=>100,'borderSize'=>5, 'cellMargin'=>100));
 	$table->addRow();
 	$table->addCell(null,array('gridSpan' => 2))->addTextRun($alignCenter)->addText("MARKSHEET", $text1);
 	
 	for ($r = 0; $r < count($marks); $r++) {
	    $table->addRow();
	    for ($c = 0; $c < 2; $c++) {
	        $table->addCell(4000)->addTextRun($alignCenter)->addText($marks[$r][$c],$text2);
	    }
	}

 	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');
 	$file = $row['contact'].'.docx';
 	$objWriter->save( __DIR__.'/uploadFiles/'.$file);

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