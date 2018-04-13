<!DOCTYPE html>
<html>
<head>
	<title>User Info</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/app.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="task">
		<h2>USER PROFILE INFORMATION</h2>
		<form id="form1" class="form" method="POST" enctype="multipart/form-data">
				<div class="preview"><img id="preview_image" src="#" style="display: none;"></div>

				First Name<input type="text" name="first_name" class="fields" pattern="[a-zA-Z]+">
			
				Last Name<input type="text" name="last_name" class="fields" pattern="[a-zA-Z]+" onblur="myname(this.form)">
			
				Full Name<input type="text" name="full_name" class="fields" style="text-transform: uppercase;" readonly>
				
				Upload Image<input type="file" id="imageUpload" accept=".jpg,.jpeg,.png" name="image" class="fields" onchange="preview(this)">

				Marks
				<div id="subjects">
				<p><input type="text" class="fields subjectField" name="subject_1" placeholder="Subject_name | Marks" required> <button type="button" class="button" id="remSub">Remove</button></p>
				</div>
				<button type="button" id="buttonAddSub" class="button">Add Subject</button>

				Email Id<input type="text" name="email" id="email" class="fields">
				
				Phone No.<input type="text" name="contact" class="fields contact" pattern="^(\+91)[1-9]\d{9}$" title="Include +91 as prefix followed by exactly 10 digits">

				<button type="submit" name="submit" class="submit button">Save</button>

		</form>
		<form method="POST" class="form" action="downloadDoc.php" id="form2" style="display: none;">
			<input type="text" name="contact" style="display: none;">
			<button type="submit" class="submit button">Download</button>
		</form>
	</div>
	<script>

		function myname(f){	f.full_name.value = f.first_name.value + " " + f.last_name.value;	}
		
		$(function(){$("#form1 .fields").prop('required',true);});

		function preview(i){
				if ( i.files && i.files[0] ) {
					var reader = new FileReader();
					reader.onload = function(e){
						$("#preview_image").attr('src',e.target.result);
						$("#preview_image").attr('style','width:300px;height:300px;display:block;object-fit:contain;border:2px solid cyan;margin:2em auto;');
					}
					reader.readAsDataURL(i.files[0]);
					}
			}

		$(function(){
			$('#form1').on('submit',function(e){
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type : 'POST',
					url : 'db_insert.php',
					data : data,
					cache : false,
					contentType : false,
					processData : false,
					success : function(data){
						console.log("database access successful");
						var key = $("#form1 .contact").val();
						$("#form2").attr('style','display:block;');
						$("#form2 input").val(key);
						},
					error : function(data){
						console.log("error");
					}
				});

				
			});

			// $("#email").blur(function(e){
			// 	if($(this).val()!=""){
			// 		var access = '4cdf1ed54638a84a039dd6e42f11dc7a';
			// 		var emailId = $("#email").val();
			// 		$.ajax({
			// 			type : "POST",
			// 			url : "http://apilayer.net/api/check?access_key="+access+"&email="+emailId,
			// 			dataType : 'jsonp',
			// 			success : function(json){
			// 						console.log(json.format_valid);
			// 						console.log(json.smtp_check);
			// 						var arr = ["gmail","hotmail","rediff","yahoo"];
			// 						var domain = arr.indexOf(json.domain.slice(0,json.domain.indexOf(".")));

			// 						if(json.format_valid && json.smtp_check){if(domain != -1){
			// 								console.log("public id");
			// 								$("#email").val("");
			// 							}
			// 						}
			// 						else
			// 								$("#email").val("");
			// 						},
			// 			error : function(data){console.log("could not connect to API");}
			// 		});
			// 	}
			// 	else
			// 		console.log("empty field");
			// });
		});

		$(function(){
			var subDiv = $('#subjects');
			var i = $('#subjects p').length + 1 ;
			$("#buttonAddSub").on("click",function(e){
				e.preventDefault();
				$('<p><input type="text" class="fields subjectField" name="subject_' + i + '" placeholder="Subject_name | Marks" required> <button type="button" class="button" id="remSub">Remove</button></p>').appendTo(subDiv);
				i++;
				return false;
			});

			$(subDiv).on("click","#remSub",function(e){
				e.preventDefault();
				if(i>2){
					$(this).parent().remove();
					i--;
				}
				return false;
			});
		});
		
	</script>

</body>
</html>