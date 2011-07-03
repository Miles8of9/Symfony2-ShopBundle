$(function(){
	$('#smallImageBlockModal > li').mouseenter(function(){
		showImg($(this).index());
	});
	$('#bigImageBlockModal').click(function(){
		var idx = $('#smallImageBlockModal > li').has('div:not(:visible)').index();
		var showIdx = idx + 1 < $('#smallImageBlockModal > li').size() ? idx + 1 : 0;

		showImg(showIdx);			
	});

	function showImg(idx){
		var count = $('#smallImageBlockModal > li').size();
		if(count > 1)
		{
			$('#smallImageBlockModal > li > div:not(:visible)').show();
			var li = $('#smallImageBlockModal > li:eq(' + idx + ')');
			var imgId = $('>img', li).attr('class').replace('img', '');
	
			$('>div', li).hide();
			$('#bigImageBlockModal > img:visible').hide();
			$('#imageDescriptionModal > span:visible').hide();
			$('#bigImageBlockModal > .img' + imgId + ', #imageDescriptionModal > .img' + imgId).show();
		}
	};
	
	$('#modelSwitcher > img').click(function(e){
		e.preventDefault();
		if($(this).attr('src') == '/images/switcher2DOn.png')
		{
			$('#modelSwfView').removeClass('dn');
			$('#bigImageBlockModal, #imageDescriptionModal, #smallImageBlockModal').hide();
			$.modalUpdate({modalWidth: 502});
			$(this).hide();
			$('img[src$="switcher3DOn.png"]').show();
		}
		else
		{
			$('#modelSwfView').addClass('dn');
			$('#bigImageBlockModal, #imageDescriptionModal, #smallImageBlockModal').show();
			$.modalUpdate({modalWidth: 502});
			$(this).hide();
			$('img[src$="switcher2DOn.png"]').show();
		}
	});
});