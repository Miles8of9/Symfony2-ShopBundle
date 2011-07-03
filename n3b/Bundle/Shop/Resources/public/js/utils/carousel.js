$.fn.carousel = function(p){
	var p = $.extend({
		btnPrev: $('img[src$="left_btn.gif"]', this),
		btnNext: $('img[src$="right_btn.gif"]', this),
		visible: 3,
		mScroll: false
	}, p);

	return this.each(function(){

		var running = false;
		var li = $('ul:first-child > li', this);
		var ul = $('ul', this);
		var liWidth = li.outerWidth(true);
		var itemsCount = li.size();
		var ulWidth = liWidth * itemsCount;
		var curPos = 0;
		ul.css('width', ulWidth);

		function run(position){
			if(!running){
				if(position < 0 || position > itemsCount - p.visible)
					return false;
				else
					curPos = position;

				runing = true;
				ul.animate({ left: -(curPos * liWidth) }, 200, function(){
					running = false;
				});

				p.btnPrev.show();
				p.btnNext.show();
				$((curPos - 1 < 0 && p.btnPrev) || (curPos + 1 > itemsCount - p.visible && p.btnNext) || [] ).hide();
			}
			return false;
		};

		$(p.btnPrev).click(function() {
			run(curPos - 1);
		});
		$(p.btnNext).click(function() {
			run(curPos + 1);
		});
		if(p.mScroll)
			ul.parent().mousewheel(function(e, d) {
				e.preventDefault();
				d < 0 ? run(curPos + 1) : run(curPos - 1);
			});
	});
};