$(function(){
	var legalForm = $('label[for*="legalForm"], *[name*="legalForm"]');
	var addsForm = $('label[for*="addsForm"], *[name*="addsForm"]');
	
	$('input[name="registerForm[deliver]"]').click(function(){
		if($(this).val() == 1){
			addsForm.show();
		} else {
			addsForm.hide();
		}
	});
	
	$('input[name="registerForm[legal]"]').click(function(){
		if($(this).val() == 1){
			legalForm.show();
		} else {
			legalForm.hide();
		}
	});
	
	$('a[href="/privacy"]').click(function(e){
		e.preventDefault();
		if($('#privacy').is(':visible'))
			$('#privacy').hide();
		else {
			$('#privacy').show();
			fleXenv.fleXcrollMain('privacy');
			$('#privacy .vscrollerbase').css({ height: $('#privacy .vscrollerbase').height() - 40, margin: '20px 0'});
			$('#privacy .vscrollerbasebeg, #privacy .vscrollerbaseend').css('margin-top', -20);
		}
	});
});