$(function(){
	$('ul#additionalsBlockTabs a').click(function(e){
		e.preventDefault();
		if(!$('div#additionalsBlock > div:visible').hasClass($(this).attr('class'))) {

			// табы
			$('ul#additionalsBlockTabs > li').removeClass('selected');
			$('ul#additionalsBlockTabs > li > img').remove();
			var imgString = '<img src="/images/cornerb_tr.gif" /><img src="/images/cornerb_tl.gif" />';
			$(this).parent().append(imgString);
			$(this).parent().addClass('selected');

			// показать/скрыть уголки
			if($(this).parent().index() == 0) {
				$('div#additionalsBlock > img[src$="cornerb_tl.gif"]').hide();
				$('div#additionalsBlock').css('borderTopLeftRadius', 0);
			} else {
				$('div#additionalsBlock > img[src$="cornerb_tl.gif"]').show();
				$('div#additionalsBlock').css('borderTopLeftRadius', 15);
			}
			
			// анимация
			var height = $('div#additionalsBlock').height();
			$('div#additionalsBlock > div:visible').fadeOut(200);
			$('div#additionalsBlock').height(height);
			$('div#additionalsBlock').animate({height:$('div.'+$(this).attr('class')).height() + 50}, 300);
			$('div.'+$(this).attr('class')).delay(200).fadeIn(200);
		}

		var top = (!!window.opera) ? 'html' : 'html, body';
		$(top).animate({scrollTop: $(this).offset().top - 20}, 300);
	});
	
	// всплывашка с описанием характеристики
	$('img[src$="feature_description.gif"]').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var p = {
			divReq: $(this).next('div').html(),
			opaque: false,
			modalWidth: 430,
			modalHeight: 300,
			modalLeft: $(this).offset().left + 100,
			modalTop: $(this).offset().top - 410,
			arrow: true,
			arrowLeftOffset: 148,
			modalHeader: $(this).parent().next().text()
		}
		$.modalShow(p);
	});

	// всплывашка с гарантийным планом
	$('ul#warantyBlock > li:first-child > a').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var p = {
			divReq: $(this).next('div').html(),
			opaque: false,
			modalWidth: 430,
			modalHeight: 250,
			modalLeft: $(this).offset().left + 100,
			modalTop: $(this).offset().top - 360,
			arrow: true,
			arrowLeftOffset: 200,
			modalHeader: 'Сервисное обслуживание'
		}
		$.modalShow(p);
	});

	// всплывашка с крупногабаритным товаром
	$('img[src="/images/att_icon.png"], a[href="#hw"]').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		img = $('img', $(this).parent());
		var p = {
			divReq: $('div', $(this).parent()).html(),
			opaque: false,
			scrolled: false,
			modalWidth: 430,
			modalLeft: img.offset().left + 100,
			modalTop: img.offset().top - 310,
			arrow: true,
			arrowLeftOffset: 148,
			modalHeader: 'Ограничения по доставке'
		}
		$.modalShow(p);
		return false;
	});

	// селектор картинок
	if($('#smallImageBlock').length)
		$('#smallImageBlock > li').mouseenter(function(){
			$('#smallImageBlock > li > div:not(:visible)').show();
			$('>div', this).hide();
	
			var imgId = $('>img', this).attr('class').replace('img', '');
			$('#bigImageBlock > img:visible').hide();
			$('p#imageDescription > span:visible').hide();
			$('.img' + imgId).show();
		});

	// всплывашка с картинками
	$('#bigImageBlock, #smallImageBlock > li').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var productId = $('#itemCard > h1').attr('class').replace('product', '');

		if($('>img:visible', this).attr('src') == '/images/blank_mal.jpg')
			return false;
		
		var imgId = $('>img:visible', this).attr('class').replace(/[^0-9]*/, '');
		var p = {
			//loadCss: '/css/main/product/bigImage.css',
			loadJs: '/js/product/bigImage.js',
			modalWidth: 502,
			ajaxReq: '/big_image/' + productId + '/' + imgId,
			opaque: true,
			modalHeader: $('#itemCard > h1').text()
		}
		$.modalShow(p);
	});
	
	// имя в комменте
	$('input[name="product_comment[name]"]').inputReplace('Аноним');
});