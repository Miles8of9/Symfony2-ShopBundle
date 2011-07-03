(function($) {
$.fn.inputReplace = function(p) {
	
	return this.each(function(){
		var input = $(this);

		input.focus(function(){
			if(input.val() == p)
				input.val('');
		});
		input.blur(function(){
			if(!input.val().length)
				input.val(p);
		});
	});
};

})(jQuery);