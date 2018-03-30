//concatenate firstname and lastname
function myname(f){	f.full_name.value = f.first_name.value + " " + f.last_name.value;	}

//enable required property and disable autocomplete property
$(function(){$(".info").prop('required',true).prop('autocomplete','off');});

//error message display/hide
$('.info').blur(function() {
	if($(this).val().trim() == '' ){
        $(this).siblings('span').css('display','block');
        $(this).siblings('span').html('Cannot leave this empty!!!');
	}
}).focus(function() {
        $(this).siblings('span').css('display','none');
	});

//on form submit
$(function(){
	$("#login").on('submit',function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type : 'POST',
			url : 'account_data.php',
			data : data,
			cache : false,
			contentType : false,
			processData : false,
			success : function(data){
				console.log("database access successful");
				window.location.href = "form2.php";
				},				
			error : function(data){console.log("error");}
		});
	});


	//for email syntax check
	$('.email').on('blur',function(){
		if($(".email").val()!=""){
			var access = 'b9988dad533feecac81d064b9c0355f6';
			var emailId = $(".email").val();
			$.ajax({
				type : "POST",
				url : "http://apilayer.net/api/check?access_key="+access+"&email="+emailId,
				dataType : 'jsonp',
				success : function(json){
							console.log(json.format_valid);
							console.log(json.smtp_check);
							var arr = ["gmail","hotmail","rediff","yahoo"];
							var domain = json.domain;
							domain = arr.indexOf(domain.slice(0,domain.indexOf(".")));

							if(json.format_valid && json.smtp_check){
								if(domain != -1){
									console.log("public id");
									$(".email").siblings('span').html("Cannot use public domain");
									$(".email").val("");
								}
								else
								{
									console.log("Valid email address");
								}
							}
							else
									$(".email").val("");
							},
				error : function(data){console.log("could not connect to API");}
			});
		}
		else
			console.log("empty field");
	});
});
	

