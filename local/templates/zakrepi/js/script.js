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
                                l2.stop().animate({'height':l4.outerHeight()},300);
                            }
                        } else {
                            //console.log('l4 childs < 4');
                            l2.stop().animate({'height':l4.outerHeight()},300);
                        }
                    } else {
                        //console.log('l2 > l4');
                        l2.stop().animate({'height':l2height},300);
                    }
                } else {
                    //console.log('l3 hasn\'t childs');
                    l2.stop().animate({'height':l2height},300);
                }
            } else {
                //console.log('l3 > l2');
                //console.log(l3height+' > '+l2.outerHeight());
                if((l3.children('.submenu-item').length - l2.children('.submenu-item').length) >= 3){
                    //console.log('l3 childs >=3');
                    if(l3.children('.submenu-item.parent').length > 0){
                        //console.log('l3 has childs');
                        l2.stop().animate({'height':l3height},300);
                    } else {
                        //console.log('l3 hasn\'t childs');
                        l3.addClass('col-2');
                        if((l3height / 2) > l2height){
                            l2.stop().animate({'height':(l3height / 2 + 20)},300);
                        }
                    }
                } else {
                    //console.log('l3 childs < 3');
                    l2.stop().animate({'height':l3height},300);
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

    if($(window).outerWidth() < 992){
        $('select.mobile-synh').change(function(){
            var radio = $('.select-synh[data-select="'+$(this).attr('id')+'"]');
            radio.find('input[type="radio"]').not('[value="'+$(this).val()+'"]').prop('checked', false);
            radio.find('input[type="radio"][value="'+$(this).val()+'"]').prop('checked', true);
            radio.find('input[type="radio"]:checked').parent('.dropdown-item').click();
        });
    }
    $('.select-synh input[type="radio"]').change(function(){
        var select = $(this).parents('.select-synh').attr('data-select');
        if(($(window).outerWidth() > 992) || (!$('#'+select).hasClass('mobile-synh'))){
            $('#'+select).val($(this).val());
            $('#'+select).change();
        }
    });
    // dropdown init
    $('.dropdown-box').each(function(){
        var value = $(this).find('.dropdown-item[data-active="active"]').find('[data-value-text]');
        $(this).find('.dropdown-value > .item-text').html(value.attr('data-value-text'));
    });
    // dropdown open
    $('.dropdown-box').click(function(e){
        $('.dropdown-box').not($(this)).removeClass('open');
        $(this).toggleClass('open');
        e.stopPropagation();
    });
    $('.page').click(function(){
        $('.dropdown-box').removeClass('open');
    });
    // dropdown change
    $('.dropdown-box .dropdown-item').click(function(e){
        var value = $(this).find('[data-value-text]');
        var box = $(this).parents('.dropdown-box');
        $(this).attr('data-active', 'active').siblings().removeAttr('data-active');
        box.find('.dropdown-value > .item-text').html(value.attr('data-value-text'));
        e.stopPropagation();
        box.removeClass('open');
    });

    // jcarousel
    // http://sorgalla.com/jcarousel/docs/
    /*$('.carousel')
        .on('jcarousel:createend', function(){
            if($(this).attr('data-jcarouselautoscroll') == 'true'){
                if($(this).attr('data-interval')){
                    var $interval = $(this).attr('data-interval');
                } else {
                    var $interval = 3000;
                }
                if($(this).attr('data-target')){
                    var $target = $(this).attr('data-target');
                } else {
                    var $target = '+=1';
                }
                $(this).jcarouselAutoscroll({
                    interval: $interval,
                    target: $target,
                    autostart: true
                });
            }
            if($(this).attr('data-wrap') == 'circular'){
                $(this).jcarousel({
                    wrap: 'circular',
                });
            }
        })
        .jcarousel({
            list: '.carousel-inner'
        });
    $('.carousel-nav')
        .jcarouselPagination({
            item: function(page){
                return '<li class="nav-item"><a class="nav-link" href="#'+page+'"></a></li>';
            }
        })
        .on('jcarouselpagination:active', 'li', function(){ // - вот эта херня не работает почему-то
            $(this).children('a').addClass('active');
        })
        .on('jcarouselpagination:inactive', 'li', function(){ // - и эта (а должна!)
            $(this).children('a').removeClass('active');
        });
    $('.carousel-controlls .prev')
        .on('jcarouselcontrol:active', function(){
            $(this).addClass('active');
        })
        .on('jcarouselcontrol:inactive', function(){
            $(this).removeClass('active');
        })
        .on('jcarouselcontrol:create', function(){
            if($(this).attr('data-target')){
                var $target = $(this).attr('data-target');
            } else {
                var $target = '-=1';
            }
            $(this).jcarouselControl({
                target: $target,
            });
        })
        .jcarouselControl();
    $('.carousel-controlls .next')
        .on('jcarouselcontrol:active', function(){
            $(this).addClass('active');
        })
        .on('jcarouselcontrol:inactive', function(){
            $(this).removeClass('active');
        })
        .on('jcarouselcontrol:create', function(){
            if($(this).attr('data-target')){
                var $target = $(this).attr('data-target');
            } else {
                var $target = '+=1';
            }
            $(this).jcarouselControl({
                target: $target,
            });
        })
        .jcarouselControl();
    */


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
 /*   ymaps.ready(init);
    var shopsMap;

    function init(){
        shopsMap = new ymaps.Map("shops-map",{
            center: [57.16565145867384,65.54499550000001], // Тюмень
            zoom: 12,
            controls: ['smallMapDefaultSet','routeEditor','trafficControl']
        });
        // тут бы еще сделать что-то с балунами, действия при клике на метку,
        // связать со списком магазинов рядом с картой, например центрировать
        // и увеличивать карут при клике на адрес магазина в списке....
        // но я этого делать не буду, заебала меня эта карта
        var coords = [
            [57.15689047935417,65.45087498346709],	// Черепанова 29
            [57.15370227137238,65.56400849999996],	// 50 лет Октября, 8/1
            [57.194878271190895,65.5943265],		// Ветеранов Труда, 47
            [57.13485277148095,65.60593249999998],	// Пермякова, 1а
            [57.13079877143909,65.54357149999998],	// Молодежная, 72
            [57.13420827141365,65.4935445],			// Московский тракт, 120/1
        ];
        shopsCollection = new ymaps.GeoObjectCollection({},{
            iconLayout: 'default#image',
            iconImageHref: 'images/map-marker.png',
            iconImageSize: [30, 36],
        });
        for (var i=0;i<coords.length;i++){
            shopsCollection.add(new ymaps.Placemark(coords[i]));
        }
        shopsMap.behaviors.disable('scrollZoom');
        shopsMap.geoObjects.add(shopsCollection);
        if($('#shops-map').parents('.tab-content-item')){
            $('#shops-map').parents('.tab-content-item').on("tabshow", function(){
                shopsMap.container.fitToViewport();
            });
        }
    }*/
    $('.toggle-content-box').each(function(){
        if($(this).attr('data-state')){
            var state = $(this).attr('data-state');
        } else {
            var state = 'less';
        }
        if($(this).attr('data-show')){
            var num = $(this).attr('data-show');
        } else {
            var num = 5;
        }
        toggleContent($(this), 'init', state, num);
    });
    $('.show-buttons .show-more').click(function(){
        toggleContent($(this).parents('.toggle-content-box'), 'toggle', 'more', $(this).parents('.toggle-content-box').attr('data-show'));
        $(this).hide().siblings().show();
    });
    $('.show-buttons .show-less').click(function(){
        toggleContent($(this).parents('.toggle-content-box'), 'toggle', 'less', $(this).parents('.toggle-content-box').attr('data-show'));
        $(this).hide().siblings().show();
    });

    // tabs
    //$('.tabs').tabs();
    // init
    $('.tabs').each(function(){
        var actID = $(this).find('.tab-header-item.active .tab-link').attr('href');
        $(this).children('.tab-content').find(actID).addClass('open');
        if($('.workarea .tab-hide-box').length > 0){
            $('.tab-hide-box[data-hide-id='+actID+']').hide();
        }
    });
    // action
    $('.tab-link').click(function(){
        var actID = $(this).attr('href');
        var tabs = $(actID).parents('.tabs');
        if($(this).parent().hasClass('tab-header-item')){
            $(this).parent('.tab-header-item').addClass('active').siblings().removeClass('active');
        } else {
            $('.tab-header-item [href='+actID+']').parent('.tab-header-item').addClass('active').siblings().removeClass('active');
        }
        tabs.children('.tab-content').find(actID).addClass('open').siblings().removeClass('open');
        if($('.workarea .tab-hide-box').length > 0){
            $('.tab-hide-box[data-hide-id!='+actID+']').show();
            $('.tab-hide-box[data-hide-id='+actID+']').hide();
        }
        $(actID).trigger("tabshow");
        return false;
    });

    // tooltips
    // init
    $('.tooltip').each(function(){
        if($(this).attr('data-box')){
            var box = $($(this).attr('data-box'));
        } else {
            var box = 'page';
        }
        if($(this).attr('data-position')){
            var pos = $(this).attr('data-position');
        } else {
            var pos = 'top-left';
        }
        if($(this).attr('data-offset')){
            var off = parseInt($(this).attr('data-offset'),10);
        } else {
            var off = 23;
        }
        var tooltipW = $(this).outerWidth();
        var tooltipH = $(this).outerHeight();
        var posTop = 0;
        var posLeft = 0;
        if(box != 'page'){
            switch(pos){
                case 'left-top':
                    posTop = box.offset().top;
                    posLeft = box.offset().left - off - tooltipW;
                    break;
                case 'left-middle':
                    posTop = box.offset().top + ((box.outerHeight() - tooltipH)/2);
                    posLeft = box.offset().left - off - tooltipW;
                    break;
                case 'left-bottom':
                    posTop = box.offset().top + box.outerHeight() - tooltipH;
                    posLeft = box.offset().left - off - tooltipW;
                    break;
                case 'right-top':
                    posTop = box.offset().top;
                    posLeft = box.offset().left + off + box.outerWidth();
                    break;
                case 'right-middle':
                    posTop = box.offset().top + ((box.outerHeight() - tooltipH)/2);
                    posLeft = box.offset().left + off + box.outerWidth();
                    break;
                case 'right-bottom':
                    posTop = box.offset().top + box.outerHeight() - tooltipH;
                    posLeft = box.offset().left + off + box.outerWidth();
                    break;
                case 'bottom-left':
                    posTop = box.offset().top + box.outerHeight() + off;
                    posLeft = box.offset().left;
                    break;
                case 'bottom-center':
                    posTop = box.offset().top + box.outerHeight() + off;
                    console.log(box.offset().left+' - '+box.outerWidth()+' - '+tooltipW);
                    posLeft =  box.offset().left + ((box.outerWidth() - tooltipW)/2);
                    break;
                case 'bottom-right':
                    posTop = box.offset().top + box.outerHeight() + off;
                    posLeft = box.offset().left + box.outerWidth() - tooltipW;
                    break;
                case 'top-center':
                    posTop = box.offset().top - off - tooltipW;
                    posLeft = box.offset().left + ((box.outerWidth() - tooltipW)/2);
                    break;
                case 'top-right':
                    posTop = box.offset().top - off - tooltipW;
                    posLeft = box.offset().left + box.outerWidth() - tooltipW;
                    break;
                case 'top-left':
                default:
                    posTop = box.offset().top - off - tooltipW;
                    posLeft = box.offset().left;
                    break;
            }
            $(this).offset({top:posTop,left:posLeft});
        } else {
            console.log('page');
        }
    });
    // show
    $('.show-tooltip').click(function(){
        var tooltip = $(this).attr('data-tooltip');
        tooltip.addClass('show');
    });
    $('.btn.shopping-card').click(function(){
        $('.tooltip[data-box="#minicard"]').addClass('show');
    });
    // hide
    $('.tooltip .btn-close').click(function(){
        $(this).parents('.tooltip').removeClass('show');
    });

});

function position() {
    var pos = $(window).scrollTop();
    $('.page').css({'position': 'fixed', 'top': - pos+'px'});
}
function toggleContent(el,action,state,num){
    // default
    if(!action){
        action = 'init';
    }
    if(!state){
        state = 'less';
    }
    if(!num){
        num = 5;
    }
    var lessHeight = el.children('.show-buttons').outerHeight();
    el.children('*:lt('+num+')').each(function(){
        lessHeight = lessHeight + $(this).outerHeight() + parseFloat($(this).css('margin-bottom'),10);
    });
    var moreHeight = el.children('.show-buttons').outerHeight();
    el.children('[class!="show-buttons"]').each(function(){
        moreHeight = moreHeight + $(this).outerHeight() + parseFloat($(this).css('margin-bottom'),10);
    });
    if(action == 'init'){
        if(state == 'less'){
            el.css('height', lessHeight);
        } else if (state == 'more') {
            el.css('height', moreHeight);
        }
    } else if (action == 'toggle'){
        if(state == 'less'){
            el.animate({'height': lessHeight},300).attr('data-state', 'more');
        } else if (state == 'more') {
            el.animate({'height': moreHeight},300).attr('data-state', 'less');;
        }
    }
}
function tab(){
    console.log('ok');
}

// angularjs 
// https://docs.angularjs.org/guide
// http://angular.ru/guide/
/*
 var zakrepi = angular.module('zakrepi',[]);
 */