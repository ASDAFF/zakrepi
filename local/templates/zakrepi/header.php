<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
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
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
        <?
        //настройки сайта
        /*$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "COMPONENT_TEMPLATE" => ".default",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/includes/settings.php"
            )
        );*/?>
        <div id="svg-placeholder" class="hide"></div>
        <div class="layout">
            <!-- для главной добавить класс home-page к page, для новостей и благотворительности - news-page,
                для проектов - projects-page -->
            <div class="page" ng-app="zakrepi">
                <!-- если не 404 -->
                <div class="header-wrapper">
                    <div class="topbar">
                        <div class="container row">

                            <!--geo location-->
                            <div class="geo-box col l3 small-text">
                                <svg class="icon"><use xlink:href="#location"/></svg>
                                Петропавловск-Камчатский
                            </div>
                            <!--end geo location-->
                            <!-- extra menu-->
                            <div class="top-menu col l6">
                                <ul class="menu horizontal-menu">
                                    <li class="menu-item"><a class="menu-link" href="#">Доставка и оплата</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Гарантия и возврат</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Организациям</a></li>
                                    <li class="menu-item"><a class="menu-link" href="#">Наши магазины</a></li>
                                </ul>
                            </div>
                            <!--end extra menu-->
                            <!--personal-->
                            <div class="auth-box col l3">
                                <a class="auth-link login" href="#"><svg class="icon"><use xlink:href="#profile"/></svg> Вход</a>
                                <a class="auth-link register" href="#">Регистрация</a>
                            </div>
                            <!--end personal-->
                        </div>
                    </div>
                    <div class="header">
                        <div class="container row">
                            <!--logo-->
                            <div class="logo col l3">
                                <a class="img-link" href="/">
                                    <img src="images/logo.png"/>
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
                                <input type="text" class="search inputtext" id="h-search" />
                                <label for="h-search" class="textfield-placeholder">Поиск по товарам</label>
                                <button class="search-btn btn btn-icon"><svg class="icon"><use xlink:href="#search"/></svg></button>
                            </div>
                            <!--end search-->
                            <!--cart and like-->
                            <div class="shopping-card-box col l3">
                                <a href="#" class="btn btn-favorite btn-icon col"><svg class="icon"><use xlink:href="#heart"/></svg></a>
                                <a class="btn standart btn-with-icon col l2 btn-minicart" href="#"><svg class="icon"><use xlink:href="#cart"/></svg> Нет товаров</a>
                            </div>
                            <!--end cart and like-->
                        </div>
                    </div>
                    <!--top menu-->
                    <div class="main-menu">
                        <div class="container row">
                            <ul class="menu horizontal-multilvl-menu col">
                                <li class="menu-item"><a class="menu-link" href="#">строительство и ремонт</a></li>
                                <li class="menu-item"><a class="menu-link" href="#">сад и огород</a></li>
                                <li class="menu-item"><a class="menu-link" href="#">отдых и туризм</a></li>
                                <li class="menu-item"><a class="menu-link" href="#">спецодежда</a></li>
                                <li class="menu-item"><a class="menu-link" href="#">акции</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end top menu-->
                </div>
                <!-- /если не 404 -->
                <div class="workarea-wrapper container">
                    <?/*
                    <!-- если не главная -->
                    <!--breadcrumbs-->
                    <div class="breadcrumbs">
                        <a class="brdcmb-link" href="#">Главная</a> /
                        <a class="brdcmb-link" href="#">Строительство и ремонт</a> /
                        <a class="brdcmb-link" href="#">Инструменты</a> /
                        <span class="brdcmb-curpage">Электроинструменты</span>
                    </div>
                    <!--end breadcrumbs-->
                    <!-- /если не главная -->
                    */?>
                    <!--div class="workarea"-->
	
						