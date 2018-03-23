<!DOCTYPE html>
<html>
<head>
	<title>PHP task</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/app.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
</head>
<body>
	<div class="task">
	<h2>USER PROFILE INFORMATION</h2>
	<form method="POST" action="task.php" class="form" enctype="multipart/form-data">
			First Name<input type="text" name="first_name" class="fields" pattern="[a-zA-Z]+">
		
			Last Name<input type="text" name="last_name" class="fields" pattern="[a-zA-Z]+" onblur="myname(this.form)">
		
			Full Name<input type="text" name="full_name" class="fields" style="text-transform: uppercase;" readonly>
			
			Upload Image<input type="file" accept=".jpg,.jpeg,.png" name="image" class="fields" >

			Marks<textarea name="marks" rows="5" class="fields" placeholder="Each value (Subject|Marks) should be entered in new line"></textarea>

			Phone No.<input type="text" name="contact" class="fields" pattern="[+9].[1]+[0-9].{9}" title="Include +91 as prefix followed by exactly 10 digits">

			Email Id<input type="text" name="email" class="fields">
		
			<button type="submit" name="submit" class="submit">Submit</button>
	</form>
	</div>
	<script>
		$(window).bind("pageshow",function(){
			var f = $('form');
			f[0].reset();
		});
		$(function(){$("#form1 .fields").prop('required',true);});
		function myname(f){
			f.full_name.value = f.first_name.value + " " + f.last_name.value;
		}
	</script>
</body>
</html>