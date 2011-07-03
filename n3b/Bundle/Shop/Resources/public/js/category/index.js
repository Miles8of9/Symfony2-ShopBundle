$(function(){
	$('ul.groups_list a.parent_link, ul.brands_list a.parent_link').mouseover(function(){
		$('div#info_block > div').remove();
		$('> .group_info', $(this).parent()).clone().appendTo($('div#info_block'));
		$('div#info_block > div').removeClass('dn');
	});

	$('.child_group > ul > li:not(:first-child)').click(function(){
		document.location = $(' > a', this).attr('href');
	});

	$('a.parent_link').click(function(e){
		$('a.parent_link').show();
		$('a.parent_link').removeClass('selectedMenuParent');
		ul = $(' > .child_group', $(this).parent());
		if(ul.size() > 0) {
			e.preventDefault();
			if(ul.is(':visible')) {
				ul.hide('fast');
			} else {
				$('.child_group').hide('fast');
				ul.show('fast');
				$(this).addClass('selectedMenuParent');
				$(this).not('.left_menu').hide('fast');
			}
		}
	});

	$('#specialBlock').carousel();
});