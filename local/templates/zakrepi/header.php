<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
CJSCore::Init(array("fx"));
CUtil::InitJSCore(Array("ajax"));
?>
<!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <?//$APPLICATION->ShowHead()?>
        <?
        $APPLICATION->ShowMeta("robots", false, true);
        $APPLICATION->ShowMeta("keywords", false, true);
        $APPLICATION->ShowMeta("description", false, true);
        $APPLICATION->ShowCSS(true, true);

        $APPLICATION->ShowHeadStrings();
        $APPLICATION->ShowHeadScripts();

        //D7
        //use Asset::getInstance()->addJs($src, $additional)
        //use \Bitrix\Main\Page\Asset;
        //Asset::getInstance()->addJs("http://yastatic.net/jquery/2.1.1/jquery.min.js");

        use \Bitrix\Main\Page\Asset;
        //D7 локализация
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-1.11.3.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/modernizr-custom.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/materialize.min.js");
       // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/content-app.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.jcarousel.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/svg-lib.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/script.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/function.js");

        Asset::getInstance()->addJs("http://api-maps.yandex.ru/2.1/?lang=ru_RU");


        //Для работы ajax у формы неавторизованным пользователям AJAX_MODE=>Y
        /*
            Asset::getInstance()->addJs("/bitrix/js/main/core/core.min.js");
            Asset::getInstance()->addJs("/bitrix/js/main/core/core_ajax.min.js");
        */
        //old
        /*
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-1.11.3.min.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.jcarousel.min.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/iscroll.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/svg-lib.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
        */
        ?>
        <title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
        <meta name="viewport" content="width=1200">
        <?=$arZSettings['GOOGLE_ANALYTICS']?>	
	</head>
	<body>
        <?=$arZSettings['YANDEX_METRIKA']?>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
        <div id="svg-placeholder" class="hide"></div>
        <div class="layout">
        <!--    для главной добавить класс к page       .home-page, 
            для сравнения                           .compare-page, 
            оформление заказа                       .checkout-page, 
            lk -                                    .profile-page, 
            авторизация, регистрация                .authorize-page, 
            бренды, сервисные центры -              .brands-page.white-page, 
            бренд -                                 .brand-page-single, 
            магазины -                              .shops-page.white-page,
            ---------------------------------------------------
            структура компании,                     .white-page
            сервисцентр детальная, 
            категория 
        -->
        <?
        $bread = 'Y';
        $uri = $APPLICATION->GetCurUri();

        $pos = strrpos($uri, "personal/");
        if($pos == 1){$class = 'profile-page'; $bread = 'N';}

        $pos = strrpos($uri, "compare/");
        if($pos == 1) {$class = 'compare-page';}

        $pos = strrpos($uri, "checkout/");
        if($pos == 1) {$class = 'checkout-page'; $bread = 'N';}

        $pos = strrpos($uri, "cart/");
        if($pos == 1) {$bread = 'N';}
        
        $pos = strrpos($uri, "brand/");
        if($pos == 1) {$class = 'brands-page white-page';$bread = 'N';}

        $pos = strrpos($uri, "shops/");
        if($pos == 1) {$class = 'shops-page white-page';$bread = 'N';}

        if ($APPLICATION->GetCurPage(false) === '/') {$class = 'home-page';$bread = 'N';}
        ?>
            <div class="page <?=$class?>">
                <!-- если не 404 -->
                <div class="test" style="background: #ce2127;color: #fff;padding: 5px 0;text-align: center;">
                    <div class="container row">
                        Новая версия сайта находится на стадии тестирования. Приносим свои извинения за временные неудобства!
                    </div>
                </div>
                <div class="header-wrapper">
                    <div class="topbar">
                        <div class="container row">

                            <!--geo location-->
                            <div class="geo-box col l3">
                                <svg class="icon"><use xlink:href="#location"/></svg>
                                Тюмень

                                <?
                                    /*CModule::IncludeModule("cityfranchise");
                                    $result = CCityFranchise::getListCity();*/
                                    //Получили список актуальных городов франшиз
                                ?>
                            </div>
                            <!--end geo location-->
                            <!-- extra menu-->
                            <div class="top-menu col l6">

                                 <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "topheader-menu",
                                    Array(
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "ROOT_MENU_TYPE" => "topheader",
                                        "MENU_CACHE_TYPE" => "Y",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array(""),
                                        "MAX_LEVEL" => "1",
                                        "CHILD_MENU_TYPE" => "top",
                                        "USE_EXT" => "Y",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N"
                                    )
                                );?>
                                 <?/*
                                <ul class="menu horizontal-menu">
                                    <li class="menu-item"><a class="menu-link" href="#">Доставка и оплата</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Гарантия и возврат</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Организациям</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Наши магазины</a></li>
                                </ul>*/?>
                            </div>
                            <!--end extra menu-->
                            <!--personal-->
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/includes/header/personal.php"
                                )
                            );?>

                            <!--end personal-->
                        </div>
                    </div>
                    <div class="header">
                        <div class="container row">
                            <!--logo-->
                            <div class="logo col l3">
                                <a class="img-link" href="/">
                                    <img src="/images/logo.png"/>
                                </a>
                            </div>
                            <!--end logo-->
                            <!--phone and text-->
                            <div class="phone-box col l3">
                                <a href="callto:<?=$arZSettings['PHONE_CALLTO']?>" class="nostyle phone-link xbig-text"><?=$arZSettings['PHONE'];?></a><br/>
                                <span class="small light-color small-text">Звонок по России бесплатный</span>
                            </div>
                            <!--end phone and text-->
                            <!--search-->
                            <div class="search-box col l3">
                                <?//if($USER->IsAdmin()):?>
                             <?$APPLICATION->IncludeComponent(
                                    "zakrepi:search.title",
                                    "zakrepi-search",
                                    Array(
                                        "CATEGORY_0" => array("iblock_1c_catalog"),
                                        "CATEGORY_0_TITLE" => "",
                                        "CATEGORY_0_iblock_1c_catalog" => array("10"),
                                        "CHECK_DATES" => "N",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "CONTAINER_ID" => "title-search",
                                        "INPUT_ID" => "title-search-input",
                                        "NUM_CATEGORIES" => "1",
                                        "ORDER" => "date",
                                        "PAGE" => "#SITE_DIR#search/",
                                        "SHOW_INPUT" => "Y",
                                        "SHOW_OTHERS" => "N",
                                        "TOP_COUNT" => "5",
                                        "USE_LANGUAGE_GUESS" => "Y"
                                    )
                                );?>
                                <?/*else:?>
                                    <??><input type="text" class="search inputtext" id="h-search" /><??>
                                    <label for="h-search" class="textfield-placeholder">Поиск по товарам</label>
                                    <button class="search-btn btn btn-icon"><svg class="icon"><use xlink:href="#search"/></svg></button>
                                <?endif;*/?>
                            </div>
                            <!--end search-->
                            <!--cart and like-->
                            <div class="shopping-card-box col l3">
								<span id="small-favorite-ajax">
									<?include($_SERVER['DOCUMENT_ROOT'].'/includes/header/small-favorite.php');?>
								</span>
                                <span id="small-basket-ajax">
                                    <?include($_SERVER['DOCUMENT_ROOT'].'/includes/header/small-basket.php');?>
                                </span>
                                <div class="tooltip minicard-notification noaction" data-box="#minicard" id="minicard-popup" data-position="bottom-right">
                                    <div class="tooltip-tngl"></div>
                                    <button class="btn btn-close btn-icon"><svg class="icon"><use xlink:href="#cross"/></svg></button>
                                    <div class="tooltip-content">
                                        <p>Товар успешно добавлен в корзину</p>
                                        <p><a href="/cart/">Перейти к оформлению</a></p>
                                    </div>
                                </div>
                            </div>
                            <!--end cart and like-->
                        </div>
                    </div>
                    <!--top menu-->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top-menu",
                        Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MAX_LEVEL" => "4",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        )
                    );?>
                    <!--end top menu-->
                </div>
                <!-- /если не 404 -->
                <div class="workarea-wrapper container">
                    <?
                        if ($bread == 'Y'):
                    ?>

                    <!-- если не главная -->
                    <!--breadcrumbs-->
                    <div class="breadcrumbs">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "bread",
                            Array(
                                "START_FROM" => "0",
                                "PATH" => "",
                                "SITE_ID" => "s1"
                            )
                        );?>
                    </div>
                    <!--end breadcrumbs-->
                    <!-- /если не главная -->

                    <?endif;?>
                    <!--div class="workarea"-->
	
						