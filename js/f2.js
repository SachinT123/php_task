//to assign 'required' to each input field
$(function(){$(".info").prop('required',true).prop('autocomplete','off');});

//display error message on invalid or no input
$('.info').blur(function() {
	if($(this).val().trim() == '' ){
        $(this).siblings('span').css('display','block');
        $(this).siblings('span').html('Cannot leave this empty!!!');
	}
}).focus(function() {
        $(this).siblings('span').css('display','none').html("");
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

//check format for marks field
function checkMarksFormat(str){
	str = str.trim();
	while (str.indexOf('\n\n') > -1)
	  {
	  	str=str.replace('\n\n', '\n');
	  }
	var tmp = str.split("\n");

	var re = /(^[a-z\s]+[|](\d{1,2}|100)$)/i;
	for (var i = 0; i < tmp.length; i++)
		if(!re.test(tmp[i])){
			$(".marks").siblings("span").css('display','block').html("<ul><li>Please follow the given format: [Subject]|[Marks]</li><li>Subject name can only contain characters</li><li>Marks: range 0-100</li></ul>");
			break;
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
				console.log(data);
				if(data.trim() == ""){
					alert("On submission, browser will be redirected to 'Login' page and form data will be downloaded");
					window.open("downloadFile.php");
					window.location.href = "login.php";
				}
				else
				{
					if(data.indexOf("inv_ext") != -1){
						$("#imageUpload").val("");
						$('#preview_image').css('display','none');
						$("#imageUpload").siblings("span").css('display','block').html("File format invalid");
					}
					if(data.indexOf('inv_for') != -1){
						$(".marks").siblings("span").css('display','block').html("<ul><li>Please follow the given format: [Subject]|[Marks]</li><li>Subject name can only contain characters</li><li>Marks: range 0-100</li></ul>");
					}
					if(data.indexOf('inv_cn') != -1){
						$(".contact").val("");
						$(".contact").siblings("span").css('display','block').html("Contact invalid");
					}
				}
			}
		});
	});
});
