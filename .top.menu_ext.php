<?php
global $APPLICATION;

// компонент сам формирует массив $aMenuLinksExt в нужном виде
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "IS_SEF" => "Y", /* использовать ли ЧПУ */
        /*"SECTION_PAGE_URL" => "#SECTION_CODE#/",
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",*/
        "IBLOCK_TYPE" => "information", /* тип инфоблока */
        "IBLOCK_ID" => 7, /* ID инфоблока */
        "DEPTH_LEVEL" => "4", /* уровень вложенности разделов */
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000"
    ),
    false
);

/* потом остается только объединить массивы */
/* файл .тип_меню.menu_ext.php должен возвращать массив $aMenuLinks для корректной работы компонента меню */
$aMenuLinks = array_merge(
    $aMenuLinksExt, /* наш созданный массив с разделами */
    $aMenuLinks /* массив с пунктами меню, который был изначально */
);