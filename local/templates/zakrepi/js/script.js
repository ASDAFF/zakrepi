$(document).ready(function(){
	
	$('#svg-placeholder').html(svg);
	
	$(window).scroll(function(){
		if($(window).scrollTop() > 50) {
			$('.header').addClass('fixed');
		} else {
			$('.header').removeClass('fixed');
		}
	});
	
	// modal
	$('.btn-modal').click(function(){
		var modal = $(this).attr('data-modal');
		$('.dark-bg, #'+modal).fadeIn(500);
	});
	$('.modal .btn-close, .dark-bg').click(function(){
		$('.dark-bg, .modal').fadeOut(500);
	});
	
	// main-menu
	$('.horizontal-multilevel-menu .menu-item.parent').hover(function(){
		var l2 = $(this).children('.level-2');
		var l3 = $(this).find('.level-2 > .submenu-item.active > .level-3');
		if(l2.outerHeight() < l3.outerHeight()){
			if((l3.children('.submenu-item').length - l2.children('.submenu-item').length) >= 3){
				if(l3.children('.submenu-item.parent').length > 0){
					l2.css('height',l3.outerHeight());
				} else {
					l3.addClass('col-2');
				}
			} else {
				l2.css('height',l3.outerHeight());
			}
		}
	});
	$('.horizontal-multilevel-menu .submenu-item').hover(function(){
		if($(this).hasClass('parent')){
			$(this).addClass('active').siblings().removeClass('active');
			var l2 = $(this).parents('.submenu.level-2');
			if($(this).parent('.submenu').hasClass('level-2')){
				var l3 = $(this).children('.submenu');
			} else {
				var l3 = $(this).parents('.submenu.level-3');
			}
			var l2height = 40;
			l2.children('.submenu-item').each(function(){
				l2height = l2height + $(this).height();
			});
			var l3height = 40;
			l3.children('.submenu-item').each(function(){
				l3height = l3height + $(this).height();
			});
			//console.log(l3height);
			if(l2height > l3height){
				//console.log('l2 > l3');
				if(l3.children('.submenu-item.parent').length > 0){
					//console.log('l3 has childs');
					var l4 = l3.children('.submenu-item.parent.active').children('.submenu.level-4');
					l4height = 40;
					l4.children('.submenu-item').each(function(){
						l4height = l4height + $(this).height();
					});
					if(l4height > l2.outerHeight()){
						//console.log('l4 > l2');
						if((l4.children('.submenu-item').length - l2.children('.submenu-item').length) >= 4){
							//console.log('l4 childs >= 4');
							l4.addClass('col-2');
							if((l4height / 2 + 20) > l2.outerHeight()){
								//console.log('l4 height > l2');
								l2.animate({'height':l4.outerHeight()},300);
							}
						} else {
							//console.log('l4 childs < 4');
							l2.animate({'height':l4.outerHeight()},300);
						}
					} else {
						//console.log('l2 > l4');
						l2.animate({'height':l2height},300);
					}
				} else {
					//console.log('l3 hasn\'t childs');
					l2.animate({'height':l2height},300);
				}
			} else {
				//console.log('l3 > l2');
				//console.log(l3height+' > '+l2.outerHeight());
				if((l3.children('.submenu-item').length - l2.children('.submenu-item').length) >= 3){
					//console.log('l3 childs >=3');
					if(l3.children('.submenu-item.parent').length > 0){
						//console.log('l3 has childs');
						l2.animate({'height':l3height},300);
					} else {
						//console.log('l3 hasn\'t childs');
						l3.addClass('col-2');
						if((l3height / 2) > l2height){
							l2.animate({'height':(l3height / 2 + 20)},300);
						}
					}
				} else {
					//console.log('l3 childs < 3');
					l2.animate({'height':l3height},300);
				}
			}
		} else {
			$(this).toggleClass('active').siblings().removeClass('active');
		}
	});
	
	// menu
	/*$('.js-menu').click(function(){
		var act = $(this).attr('data-action');
		switch(act){
			case 'open':
				position();
				$('.page-aside').addClass('open');
				$('.js-menu').attr('data-action', 'close');
			break;
			case 'close':
			default:
				var pos = parseInt($('.page').css('top'), 10);
				$('.page-aside').removeClass('open');
				$('.js-menu').attr('data-action', 'open');
				$('.page').css({'position': 'relative', 'top': '0px'});
				$(window).scrollTop(-pos);
		}
	});*/
	/*$('.mobile-menu .parent > .menu-link').click(function(){
		$(this).parent('.parent').siblings().addClass('inactive').removeClass('open');
		if($(this).parent('.parent').hasClass('submenu-item')){
			$(this).parent('.submenu-item').parent('.submenu').siblings().addClass('inactive');
		} else {
			$(this).parent('.menu-item').parent('.menu').siblings('.menu').addClass('inactive');
		}
		$('.menu-back-btn').addClass('active');
		$(this).parent('.parent').addClass('open');
		return false;
		//e.preventDefault;
	});
	$('.mobile-menu .menu-back-btn').click(function(){
		$('.menu .parent.open:last').removeClass('open');
	});*/
	
	// placeholder
	$('.inputtext, input:not([type="submit"])').keyup(function(){
		$(this).change();
	});
	$('.inputtext, input:not([type="submit"])').change(function(){
		if($(this).val().length > 0){
			$(this).addClass('dirty');
		} else {
			$(this).removeClass('dirty');
		}
	});
	
	// collapsible 
	$('.collapsible').collapsible();
	
	// jcarousel

	// anchor-menu
	$('.anchor-manu .menu-link.anchor:not(.inactive)').click(function(e){
		var el = $(this).attr('href');
		$(el).addClass('show').siblings().removeClass('show');
		var scrollto = $(el).position();
		$('html,body').animate({scrollTop: scrollto.top},700);
		return false;
		//e.preventDefault;
	});
	// неактивная ссылка меню
	$('.inactive').click(function(){
		return false;
	});
	// anchor-link
	$('.anchor-link').click(function(e){
		var el = $(this).attr('href');
		var scrollto = $(el).offset();
		$('html,body').animate({scrollTop: scrollto.top - 100},700);
		return false;
		//e.preventDefault;
	});
	
	// yandex.map
	// https://tech.yandex.ru/maps/doc/jsapi/2.1/quick-start/tasks/quick-start-docpage/
	/*ymaps.ready(init);
	var luxMap, luxPlacemark;
	
	function init(){
		luxMap = new ymaps.Map("map",{
			center: [57.13319444, 65.56589206],
			zoom: 17
		});
		luxPlacemark = new ymaps.Placemark(luxMap.getCenter(),{},{
			iconLayout: 'default#image',
			iconImageHref: 'images/map-marker.png',
			iconImageSize: [50, 90],
			iconImageOffset: [-30,-70]
		});
		luxMap.behaviors.disable('scrollZoom');
		luxMap.geoObjects.add(luxPlacemark);
	}*/

});

function position() {
	var pos = $(window).scrollTop();
	$('.page').css({'position': 'fixed', 'top': - pos+'px'});
}

// angularjs 
// https://docs.angularjs.org/guide
// http://angular.ru/guide/
/*
var zakrepi = angular.module('zakrepi',[]);
*/