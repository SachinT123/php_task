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