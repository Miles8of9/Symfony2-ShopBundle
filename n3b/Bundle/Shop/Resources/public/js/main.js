$.modalShow = function(p) {

	// параметры по умолчанию
	p = $.extend({
		callBack: function(){},
		arrow: false,
		arrowLeftOffset: 100,
		fadeSpeed: 200,
		loadCss: false,
		loadJs: false,
		modalHeight: 'auto',
		modalHeader: 'Заголовок',
		modalLeft: '50%',
		modalTop: $(window).scrollTop() + 50,
		modalWidth: 900,
		opaque: true,
		scrolled: true
	}, p || {});

	// если уже существует, закрыть
	if($('.modal').size() > 0) {
		p.reopen = true;
		$.modalRemove(p);
		return false;
	}

	// подгрузить css файл по запросу
	if(p.loadCss && !$('link[href="' + p.loadCss + '"]').length)
	{
		$('head').append('<link>');
		$('head > link:last-child').attr({
			rel:  'stylesheet',
			type: 'text/css',
			href: p.loadCss
		});
	}

	// добавлять или нет бэкграунд
	if(p.opaque) {
		$('body').append('<div class="opaque"></div>');
		$('div.opaque').height($(document).height());
	}

	// добавляем модальный див пока без контента
	$('<div class="modal dn"><img src="/images/x.png" /></div>').appendTo('body')
	.css({ width: p.modalWidth, height: p.modalHeight, top: p.modalTop, left: p.modalLeft })
	.append('<div class="modalTL"></div><div class="modalT"></div><div class="modalTR"></div><div class="modalL"></div><div class="modalContent"><div class="modalContentHeader"></div><div class="modalContentContent"></div></div><div class="modalR"></div><div class="modalBL"></div><div class="modalB"></div><div class="modalBR"></div>');

	// вешаем события на закрытие модалки (в частности: нажатие ESC, клик за модалкой, клик на картинку X)
	$(document).bind('keyup.modalClose', function(e){
		if(e.keyCode == 27) {
			$.modalRemove();
		}
	});
	$(document).bind('click.modalOutsideClick', function(e){
		if(!$('.modal').has(e.target).length)
			$.modalRemove();
	});
	$('img[src$="x.png"]').click(function(){
		$.modalRemove();
	});

	// а ля baloon
	if(p.arrow) {
		$('.modal').append('<img src="/images/modal_arrow.png" />');
		$('img[src$="modal_arrow.png"]').css('left', p.arrowLeftOffset);
	}

	$('.modalContentHeader').html('<h2>' + p.modalHeader + '</h2>');

	if(p.ajaxReq) {
		$('body').append('<div class="loader"><img src="/images/loader.gif" align="middle" /> Загрузка</div>');
		$('.modalContentContent').load(p.ajaxReq, function(){
			$('.modal').fadeIn(p.fadeSpeed);
			$('.loader').remove();
			$.modalUpdate(p);
			p.callBack();
			// подгрузить js файл по запросу
			if(p.loadJs)
				$.getScript(p.loadJs);
		});
	}
	else if(p.divReq)
	{
		$('.modalContentContent').html(p.divReq);
		$('.modal').fadeIn(p.fadeSpeed);
		$.modalUpdate(p);
		p.callBack();
		if(p.loadJs)
			$.getScript(p.loadJs);
	}

	// скролы
	if(p.scrolled)
	{
		fleXenv.initByClass('modalContentContent');
		$('.modal .vscrollerbase').css({ height: $('.modal .vscrollerbase').height() - 40, margin: '20px 0'});
		$('.modal .vscrollerbasebeg, .modal .vscrollerbaseend').css('margin-top', -20);
	}

	function getParameters(){
		return p;
	};
};

//обновление размеров модалки
$.modalUpdate = function(p) {
	p = $.extend({
		modalWidth: 900,
		modalHeight: 'auto',
		modalLeft: '50%',
		modalTop: $(window).scrollTop() + 100
	}, p || {});

	$('.modalContent').width(p.modalWidth);

	$('.modalContentContent').height(p.modalHeight);

	$('.modal').width($('.modalContent').outerWidth(true) + 80);
	$('.modal').css('margin-left', $('.modal').width()/-2);
	$('.modalT, .modalB').width($('.modalContent').outerWidth(true));
	$('.modalL, .modalR').height($('.modalContent').outerHeight(true));
};

// закрытие модалки
$.modalRemove = function(p) {
	p = $.extend({
		reopen:false
	}, p || {});

	if($('.modal').size() == 0)
		return false;

	$(document).unbind('keyup.modalClose');
	$(document).unbind('click.modalOutsideClick');

	if($('.opaque').length)
		$('.opaque').remove();
	
	if($('.loader').length)
		$('.loader').remove();

	$('.modal').fadeOut(100, function(){
		$('.modal').remove();
		if(p.reopen)
			$.modalShow(p);
	});
};

$(function() {
	// поиск фокус/блур
	$('#searchBox input[name="query"]').inputReplace('Поиск');
	
	/*
	// всплывашка
	if($('#notice').length){
		$('#notice').fadeIn(300).delay(3000).fadeOut(300);
	}

	$.noticeShow = function(text){
		if(!$('#notice').length)
			$('body').append('<div id="notice"></div>');
		
		$('#notice').queue(function(){
			$(this).html(text);
			$(this).fadeIn(300);
			$(this).delay(3000);
			$(this).fadeOut(300);
			$(this).dequeue();
		});
	};
	*/
	
	// меню
	$('#mainMenu > li').click(function(e){
		e.preventDefault();
		document.location = $('>a', this).attr('href');
	});

	// инициализашка для формы обратной связи
	function initFeedback(){
		$('#feedbackForm').submit(function(){
			$('.modalContentContent').append('<div class="loader"><img src="/images/loader.gif" align="middle" /> Отправка</div>');
			$('input[name="user_referer"]', this).val(document.location);
			$('.modalContentContent').load('/feedback', $('#feedbackForm').serialize(), function(){
				$('.modalL, .modalR').height($('.modalContent').outerHeight(true));
				initFeedback();
			});
			return false;
		});
		$('#feedbackForm input:checkbox').change(function(){
			if($(this).is(':checked'))
				$('#feedback_phone, label[for="feedback_phone"]').show();
			else
				$('#feedback_phone, label[for="feedback_phone"]').hide();
			$('.modalL, .modalR').height($('.modalContent').outerHeight(true));
		});
	};

	$('a.feedback').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var p = {
			callBack: function(){
				initFeedback();
			},
			loadCss: '/css/feedback.css',
			ajaxReq: '/feedback',
			modalWidth: 310,
			modalHeader: 'Отправить сообщение'
		};
		$.modalShow(p);
	});

	// сворачивалки для контента
	$('h4.hide').css('text-decoration', 'underline').next('span').hide();
	$('h4.hide').click(function(){
	    span = $(this).next('span');
	    //console.log('span', span.length);
	    if(span.is(':visible'))
	    {
	    	//console.log('span:visible', span.is(':visible'));
	    	//span.hide();
	    	span.css('display', 'none');
	    }
	    else
	    {
	    	//console.log('span:visible', span.is(':visible'));
	    	//span.show();
	    	span.css('display', 'block');
	    }
	});
	
	// добавляем углы
	$('div.cornered').append('<img src="/images/corner_tl.gif"><img src="/images/corner_tr.gif"><img src="/images/corner_bl.gif"><img src="/images/corner_br.gif">');
});
