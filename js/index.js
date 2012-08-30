$(document).ready(function(){
	$(".errorMessage").hide();
//	$('#note').blur(function () {
//		if(validate.note($('#note').val()))
//			$("#note_em").hide();
//		else $("#note_em").show();
//	});
	$('#words').blur(function () {
		if(validate.words($('#words').val())) {
			$("#words_em").hide();
			$("#words").removeClass('error').addClass('success');
			$("label[for=words]").removeClass('error');
		}
		else {
			$("#words_em").show();
			$("#words").removeClass('success').addClass('error');
			$("label[for=words]").removeClass('success').addClass('error');			
		}
	});
	$('#form-add-record').submit(function () {
		return /*validate.note($('#note').val()) && */validate.words($('#words').val());
	});
});

if(!window.validate) {
	window.validate = {};
//	validate.note = function(note) {
//		var noteInt = parseInt(note);
//		return noteInt >= 0 && noteInt <= 10;
//	}
	
	validate.words = function(words) {
		return words.match(/^([\w']+\s?)+$/);
	}
}