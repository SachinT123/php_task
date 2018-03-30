<!DOCTYPE html>
<html>
<head>
	<title>PHP task</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/app.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
</head>
<body>
	<div class="task">
	<h2>USER PROFILE INFORMATION</h2>
	<form method="POST" action="task.php" id="form1" class="form" enctype="multipart/form-data">
			First Name<input type="text" name="first_name" class="fields" pattern="[a-zA-Z]+">
		
			Last Name<input type="text" name="last_name" class="fields" pattern="[a-zA-Z]+" onblur="myname(this.form)">
		
			Full Name<input type="text" name="full_name" class="fields" style="text-transform: uppercase;" readonly>
			
			Upload Image<input type="file" accept=".jpg,.jpeg,.png" name="image" class="fields" >

			Marks<textarea name="marks" class="fields marks"></textarea>

			Phone No.<input type="text" name="contact" class="fields" pattern="^(\+91)[1-9]\d{9}$" title="Include +91 as prefix followed by exactly 10 digits">

			Email Id<input type="text" name="email" class="fields">
		
			<button type="submit" name="submit" class="button submit">Submit</button>
	</form>
	</div>
	<script>
		
		$(function(){$("#form1 .fields").prop('required',true);});
		function myname(f){
			f.full_name.value = f.first_name.value + " " + f.last_name.value;
		}
		$(function(){
			// var subDiv = $('#subjects');
			// var i = $('#subjects p').length + 1;
			// $("#buttonAddSub").on("click",function(e){
			// 	e.preventDefault();
			// 	$('<p><input type="text" class="fields subjectField" name="subject_' + i + '" placeholder="Subject_name | Marks" required> <button type="button" class="button" id="remSub">Remove</button></p>').appendTo(subDiv);
			// 	i++;
			// 	return false;
			// });

			// $(subDiv).on("click","#remSub",function(e){
			// 	e.preventDefault();
			// 	if(i>1){
			// 		$(this).parent().remove();
			// 		i--;
			// 	}
			// 	return false;
			// });

		});

	</script>
</body>
</html>