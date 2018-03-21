

<!DOCTYPE html>
<html>
<head>
	<title>PHP task</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/app.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
</head>
<body>
	<h2>PHP Task</h2>
	<div class="task_form">
		<form id="form1" method="POST" enctype="multipart/form-data">

				First Name<input type="text" name="first_name" class="fields" pattern="[a-zA-Z]+">
			
				Last Name<input type="text" name="last_name" class="fields" pattern="[a-zA-Z]+" onblur="myname(this.form)">
			
				Full Name<input type="text" name="full_name" class="fields" style="text-transform: uppercase;" readonly>
				
				Upload Image<input type="file" accept=".jpg,.jpeg,.png" name="image" class="fields" required>

				Marks<textarea name="marks" class="fields" placeholder="Each value (Subject|Marks) should be entered in new line"></textarea>

				Phone No.<input type="text" name="contact" class="fields" pattern="[+9].[1]+[0-9].{9}" title="Include +91 as prefix followed by exactly 10 digits">

				Email Id<input type="text" name="email" id="email" class="fields">
				
				<button type="submit" name="save" class="submit">Save</button>
		</form>
	</div>
	<script type="text/javascript">

		function myname(f){	f.full_name.value = f.first_name.value + " " + f.last_name.value;	}
		
		$(function(){$("#form1 .fields").prop('required',true);});

		$(function(){
			$('#form1').on('submit',function(e){
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type : 'POST',
					url : 'db_conn.php',
					data : data,
					contentType : false,
					cache : false,
					processData : false,
					success : function(data){console.log("database access successful");},
					error : function(data){console.log("failure");}
				});
			});

			$("#email").blur(function(){
				if($(this).val()!=""){
					var access = '4cdf1ed54638a84a039dd6e42f11dc7a';
					var emailId = $("#email").val();
					$.ajax({
						type : "POST",
						url : "http://apilayer.net/api/check?access_key="+access+"&email="+emailId,
						dataType : 'jsonp',
						success : function(json){
									console.log(json.format_valid);
									console.log(json.smtp_check);
									var arr = ["gmail","hotmail","rediff","yahoo"];
									var domain = arr.indexOf(json.domain.slice(0,json.domain.indexOf(".")));

									if(json.format_valid && json.smtp_check){if(domain != -1){
											console.log("public id");
											$("#email").val("");
										}
									}
									else
											$("#email").val("");
									},
						error : function(data){console.log("could not connect to API");}
					});
				}
				else
					console.log("empty field");
			});
		});
		
	</script>

</body>
</html>