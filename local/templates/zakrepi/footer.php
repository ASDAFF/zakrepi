<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!--/div> <!-- /.workarea -->
</div><!-- /.workarea-wrapper -->
<div class="footer-wrapper">
   <?/*?>
    <!--subscribe-->
    <div class="subscribe-box">
        <div class="container row">
            <div class="sbscr-text col l6">Подпишись на новости, скидки и акции компании</div>
            <div class="sbscr-form col l6 no-padding">
                <div class="col l4">
                    <input type="email" class="inputtext" id="sbscr-field"/>
                    <label for="sbscr-field" class="textfield-placeholder">Введите свой email</label>
                </div>
                <div class="col l2">
                    <input type="submit" class="btn primary fullwidth" value="Подписаться"/>
                </div>
            </div>
        </div>
    </div>
    <!--end subscribe-->
    <?*/?>
    <div class="footer container row">
        <!--footer company menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Компания</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "vertical-menu",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "ROOT_MENU_TYPE" => "footercompany",
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
        </div>
        <!--end footer company menu-->
        <!--footer buyer menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Покупателю</div>
             <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "vertical-menu",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "ROOT_MENU_TYPE" => "footerbuyer",
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
        </div>
        <!--end footer buyer menu-->
        <!--footer information menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Информация</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "vertical-menu",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "ROOT_MENU_TYPE" => "footerinform",
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
        </div>
        <!--end footer information menu-->
        <div class="contact-box col l3">
            <!--footer phone-->
            <div class="phone-box">
                <div class="box-title">Обратная связь</div>
                <a href="callto:<?=$arZSettings['PHONE_CALLTO']?>" class="nostyle phone-link xbig-text"><?=$arZSettings['PHONE'];?></a><br/>
                <span class="small light-color small-text">Звонок по России бесплатный</span>
            </div>
            <!--end footer phone-->
            <!--mode-->
            <div class="schedule-box">
                <div class="box-title">Режим работы</div>
                <?=$arZSettings['TIME_WORK'];?>
            </div>
            <!--end mode-->
            <!--social link-->
            <div class="soc-box">
                <ul class="soc-list horizontal">
                    <?foreach($arZSettings['SOCIAL'] as $item):?>
                        <li class="soc-item"><a class="soc-link <?=$item['CLASS']?>" href="<?=$item['LINK']?>" target="_blank"><svg class="icon"><use xlink:href="<?=$item['ID_SVG']?>"/></svg></a></li>
                    <?endforeach;?>

                </ul>
            </div>
            <!--end social link-->
        </div>
    </div>
    <div class="bottombar">
        <div class="container row" style="display: flex;">
            <div class="col l2" style="margin: auto;">© Крепыж, 2004 — <?=date('Y');?></div>
            
            <div class="col l8" style="margin: auto;">
            <?
                //настройки сайта
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/footer/pay_system.php"
                    )
                );?>
            </div>
            <!--creator-->
            <div class="col l2 right-align" style="margin: auto;"><a href="http://legacystudio.ru" class="img-link" target="_blank"><img src="/images/logo-legacy.png" /></a></div>
            <!--end creator-->
        </div>
    </div>
</div>
</div> <!-- /.page -->
</div> <!-- /.layout -->


<div class="dark-bg"></div>

	</body>
</html>