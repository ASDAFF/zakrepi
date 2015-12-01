<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="carousel home-carousel row" data-jcarouselautoscroll="true" data-wrap="circular">
    <div class="carousel-inner clearfix">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="item col l12">
                <a href="<?=$arItem['PROPERTIES']['link']['VALUE']?>" class="item-link img-link"><img class="item-img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" /></a>
            </div>
        <?endforeach;?>
    </div>
    <ul class="carousel-nav"></ul>
</div>
<script>
    $(document).ready(function(){
    // http://sorgalla.com/jcarousel/docs/
    $('.carousel')
        .on('jcarousel:createend', function(){
            if($(this).attr('data-jcarouselautoscroll') == 'true'){
                if($(this).attr('data-interval')){
                    var $interval = $(this).attr('data-interval');
                } else {
                    var $interval = <?=$arParams['~TIME_SLIDER']?>;
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
    });

</script>
