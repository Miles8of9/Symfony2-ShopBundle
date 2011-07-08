$(function(){
	$('#basketMini').carousel({mScroll:true});

	// ловим клик по "Корзине"
	$('#basketMini > h2 > a, #basketItems').live('click', function(e){
		e.preventDefault();
		showBasket();
	});

	// добавить в корзину
	$('a[href*="addToBasket"]').click(function(e){
		e.preventDefault();
		var id = $(this).attr('href').replace(/.+addToBasket[\/=]{1}(\d+)/, '$1');
		var product = $('h2 > a', $(this).parent()).text();
		$('#basketMini').load('/basket_mini/addToBasket/' + id, function(){
			$('#basketMini').carousel({mScroll:true});

			// если включена "показывать при добавлении" - показываем корзину
			if(!$.cookie('dontShowBasket') || $.cookie('dontShowBasket') == 'off') {
				showBasket();
			}
		});
	});

	$('.bItemPlus').live('click', function(e){
		e.preventDefault();
		changeBasketQuantity($(this), true);
	});
	$('.bItemMinus').live('click', function(e){
		e.preventDefault();
		changeBasketQuantity($(this), false);
	});

	// удалить	
	$('body').delegate('a[href*="delFromBasket"]', 'click', function(e){
		e.preventDefault();
		$('body').append('<div class="loader"><img src="/images/loader.gif" /></div>');
		var id = $(this).closest('tr.basketItem').attr('itemId');
		$.post('/ajax/delFromBasket/' + id, function(){
			$('.basketItem[itemId=' + id + ']').remove();
			if($('tr.basketItem').size() < 1)
			{
				if($('.modal').size())
				{
					$.modalRemove();
				}
				if(document.location.pathname.indexOf('basket') > 0 || document.location.pathname.indexOf('order') > 0)
					document.location = '/';
			}
			$('tr.basketItem').removeClass('even');
			$('tr.basketItem:even').addClass('even');
			$.modalUpdate();
			countTotal();
			$('#basketMini').load('/basket_mini', function(){
				$('.loader').remove();
				$('#basketMini').carousel({mScroll:true});
				return false;
			});
		});
	});
	
	// расчет суммы за товар по нажатию клавиш в поле ввода кол-ва
	$('input.bItemQuantity').live('keyup',function(){
		var input = $(this);
		var q = parseInt(input.val());
		var id = input.closest('.basketItem').attr('itemId');

		if(isNaN(q) || q <= 0)
			q = 1;

		updateQuantity(id, q);
	});


	// сохранение в куки отказ от показа корзины при добавлении
	$('input#dontShowBasket').live('click', function(){
		var q = ($('input#dontShowBasket').attr('checked')) ? 'on' : 'off';
		$.cookie('dontShowBasket', q, { path: '/' });
	});
});

// окончания
function numberEnding(number, ending0, ending1, ending2) {
	num100 = number % 100;
	num10 = number % 10;
	if (num100 >= 5 && num100 <= 20) {
		return ending0;
	} else if (num10 == 0) {
		return ending0;
	} else if (num10 == 1) {
		return ending1;
	} else if (num10 >= 2 && num10 <= 4) {
		return ending2;
	} else if (num10 >= 5 && num10 <= 9) {
		return ending0;
	} else {
		return ending2;
	}
};

// аналог number_format из php
function number_format(number, decimals, point, separator){
	if(!isNaN(number)){
		point = point ? point : '.';
		number = number.split('.');
		if(separator){
			var tmp_number = new Array();
			for(var i = number[0].length, j = 0; i > 0; i -= 3){
				var pos = i > 0 ? i - 3 : i;
				tmp_number[j++] = number[0].substring(i, pos);
			}
			number[0] = tmp_number.reverse().join(separator);
		}
		if(decimals && number[1]) 
			number[1] = number[1].substr(0, decimals);
		return(number.join(point));
	} else return(null);
};

// инициализашка для корзины
function basketInit() {
	$('.basketItem').each(function(){
		if(!$(this).attr('itemId'))
		{
			if(this.nodeName == 'LI')
				var id = $(this).attr('class').replace(/basketItem item_(\d+)/, '$1');
			else
				var id = $('a[href*="delFromBasket"]', this).attr('href').replace(/.+delFromBasket\/(\d+)/, '$1');

			var price = $('span.price:first > span', this).text();
			price = price.replace(',', '.');
			price = price.replace(/\s+/g, '');
			var q = parseInt($('input.bItemQuantity', this).val());
			$(this).attr('price', parseFloat(price).toFixed(2));
			$(this).attr('sum', (price * q).toFixed(2));
			$(this).attr('itemId', id);
		}
	});
	$('.basketItem > .bQuantity').append('<a class="bItemPlus" href="">+</a>');
	$('.basketItem > .bQuantity').prepend('<a class="bItemMinus" href="">-</a>&nbsp;');
};

// обновление количества товара
function updateQuantity(id, q) {
	$('body').queue(function(){
		$.post('/ajax/product_id/' + id + '/quantity/' + q + '/update_basket_quantity');
		$(this).dequeue();
	});
	li = $('li.basketItem[class="basketItem item_' + id + '"]');
	if(q == 1 && $('span.count', li).length)
		$('span.count', li).remove();
	else
		li.append('<span class="count">' + q + '</span>');

	$('tr.basketItem[itemId=' + id + '] input.bItemQuantity').each(function(){$(this).val(q)});
	$('li.basketItem[itemId=' + id + '] span.count').text(q);
	countItemSum(id, q);
}

// расчет суммы товара
function countItemSum(id, q){
	var item = $('tr.basketItem[itemId=' + id + ']');
	var price = item.attr('price');
	var sum = (price * q).toFixed(2);
	item.attr('sum', sum);
	$('span.bItemSum', item).text(number_format(sum, 2, ',', ' '));
	countTotal();
};

// подсчет значений
function countTotal() {
	var total = 0;
	var totalQuantity = 0;

	$('#basketFull:first tr.basketItem').each(function(){
		total += parseFloat($(this).attr('sum'));
		totalQuantity += parseInt($('input.bItemQuantity', this).val());
	});

	$('span.bTotalQuantity').text(totalQuantity);
	$('span.bTotalQuantity').next().text(numberEnding(totalQuantity, 'товаров', 'товар', 'товара'));
	$('span.bTotal').text(number_format(total.toFixed(2), 2, ',', ' '));
	$.modalUpdate();
};

// показать всплывающую корзину
function showBasket(){
	var p = {
		loadCss: '/css/basket.css',
		ajaxReq: '/basket',
		callBack: function() {
			basketInit();
		},
		modalHeader: 'Моя корзина'
	};
	$.modalShow(p);
};

// изменить кол-во
function changeBasketQuantity(link, increase)
{
	var input = (increase) ? link.prev() : link.next();
	var q = parseInt(input.val());

	if(increase || (q > 1 && !increase)) {
		q = (increase) ? q + 1 : q - 1;
		var id = link.closest('.basketItem').attr('itemId');
		updateQuantity(id, q);
	}
};