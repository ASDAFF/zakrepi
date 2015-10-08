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
	
	// menu
	$('.js-menu').click(function(){
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
	});
	$('.mobile-menu .parent > .menu-link').click(function(){
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
	});
	
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
	// http://sorgalla.com/jcarousel/docs/
	$('.carousel').jcarousel({
		list: '.carousel-inner',
		wrap: 'circular',
		transitions: Modernizr.csstransitions ? {
			transforms:   Modernizr.csstransforms,
			transforms3d: Modernizr.csstransforms3d,
			easing:       'ease'
		} : false
	});
	/*$('.carousel-nav')
		.jcarouselPagination({
			item: function(page){
				return '<li class="nav-item"><a class="nav-link" href="#'+page+'"></a></li>';
			}
		})
		.on('jcarouselpagination:active', 'a', function(){ // - вот эта херня не работает почему-то
			$(this).addClass('active');
		})
		.on('jcarouselpagination:inactive', 'a', function(){ // - и эта (а должна!)
			$(this).removeClass('active');
		});*/
	$('.carousel-controlls .prev')
		.on('jcarouselcontrol:active', function(){
			$(this).addClass('active');
		})
		.on('jcarouselcontrol:inactive', function(){
			$(this).removeClass('active');
		})
		.jcarouselControl({
			target: '-=1'
		});
	$('.carousel-controlls .next')
		.on('jcarouselcontrol:active', function(){
			$(this).addClass('active');
		})
		.on('jcarouselcontrol:inactive', function(){
			$(this).removeClass('active');
		})
		.jcarouselControl({
			target: '+=1'
		});
	
	
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