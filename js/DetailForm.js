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

//image preview
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


$(function(){
	var subDiv = $('#subjects');
	var i = $('#subjects p').length + 1 ;
	//add input field on button click
	$("#buttonAddSub").on("click",function(e){
		e.preventDefault();
		$('<p><input type="text" class="info subjectField" name="subject_' + i + '" pattern="/(^[a-z0-9]+[|](\d{1,2}|100)$)/i" placeholder="Subject_name | Marks" required autocomplete="off">\n<i class="remSub">X</i></p>').appendTo(subDiv);
		i++;
		return false;
	});

	//remove input field on button click
	$(subDiv).on("click",".remSub",function(e){
		e.preventDefault();
		if(i>2){
			$(this).parent().remove();
			i--;
		}
		return false;
	});

	//on form submit, save data and redirect to 'downloadFile.php' to download 
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
				console.log("User details saved in Database");
				window.location.href = "downloadFile.php";
			}
		});
	});
});
