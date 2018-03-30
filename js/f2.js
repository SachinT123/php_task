//to assign 'required' to each input field
$(function(){$(".info").prop('required',true).prop('autocomplete','off');});

//display error message on invalid or no input
$('.info').blur(function() {
	if($(this).val().trim() == '' ){
        $(this).siblings('span').css('display','block');
        $(this).siblings('span').html('Cannot leave this empty!!!');
	}
}).focus(function() {
        $(this).siblings('span').css('display','none');
	});

//display preview of image on upload
function preview(i){
		if ( i.files && i.files[0] ) {
			var reader = new FileReader();
			reader.onload = function(e){
				$("#preview_image").attr('src',e.target.result);
				$("#preview_image").attr('style','width:300px;height:300px;display:block;border-radius:5px;object-fit:contain;margin:auto;');
			}
			reader.readAsDataURL(i.files[0]);
		}
	}

//save data in database through ajax and then redirect to downloadFile.php which downloads data in .doc format 
$(function(){
	$("#form2").on('submit',function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type : 'POST',
			url : 'user_data.php',
			data : data,
			cache : false,
			contentType : false,
			processData : false,
			success : function(data){
				//console.log("User details saved in Database");
				window.location.href = "downloadFile.php";
			}
		});
	});
});
