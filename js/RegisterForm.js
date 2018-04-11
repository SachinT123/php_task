// Concatenate firstname and lastname
function myname(f){	f.full_name.value = f.first_name.value + " " + f.last_name.value;	}

// Enable required property and disable autocomplete property
$(function(){$(".info").prop('required',true).prop('autocomplete','off');});

// Error message display/hide
$(".info").blur(function() {
	if($(this).val().trim() == '' ){
        $(this).siblings("span").css('display','block');
        $(this).siblings("span").html('Cannot leave this empty!!!');
	}
	if($(".contact").val().trim() == '+91'){
		$(this).siblings("span").css('display','block');
        $(".contact").siblings("span").html('Please insert valid phone number!!!');
	}
}).focus(function() {
        $(this).siblings("span").css('display','none').html('');
	});


// Validate email syntax using regular expression.
function checkEmail(str) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(str))
    	$(".email").siblings("span").html('Invalid Email Format').css('display','block');
}

// Validate contact number using regular expression.
function checkContact(str){
    var re = /^(\+91)[1-9]\d{9}$/;
    if(!re.test(str))
    	$(".contact").siblings("span").html('Invalid Contact No.').css('display','block');
}


// on form submit
	$("#register").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			$.ajax({
				type : 'POST',
				url : 'account_data.php',
				data : formdata,
				cache : false,
				contentType : false,
				processData : false,
				success : function(data){
							if(data.trim() == "") {
									window.location.href = "form2.php";
							}
							else{
								if(data.indexOf('FN') != -1){
									$(".fname").val("");
									$(".fname").siblings("span").css('display','block').html("Only alphabets allowed");
								}
								if(data.indexOf('LN') != -1){
									$(".lname").val("");
									$(".lname").siblings("span").css('display','block').html("Only alphabets allowed");
								}
								if(data.indexOf('CN') != -1){
									$(".contact").val("");
									$(".contact").siblings("span").css('display','block').html("Only 10 digits with +91 as prefix");
								}
								if(data.indexOf('AR') != -1){
									$(".email").val("");
									$(".email").siblings("span").css('display','block').html("Username already registered...");
								}
								if(data.indexOf('IF') != -1){
									$(".email").val("");
									$(".email").siblings("span").css('display','block').html("Invalid format");
								}
								if(data.indexOf('PI') != -1){
									$(".email").val("");
									$(".email").siblings("span").css('display','block').html("Public ID");
								}
								if(data.indexOf('IE') != -1){
									$(".email").val("");
									$(".email").siblings("span").css('display','block').html("Invalid Email ID");
								}						
							}
						}
			});
	});

