<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?/*$APPLICATION->IncludeComponent(
    "zakrepi:catalog.smart.filter",
    "catalog-filter",
    //"",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "",
        "IBLOCK_ID" => $arZSettings['CATALOG_ID'],
        "SECTION_ID" => "",//$_REQUEST["SECTION_ID"],
        "SECTION_CODE" => $_REQUEST["code"],

        "PRICE_CODE" =>  array("Оптовая", "Розничная"),

        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "TEMPLATE_THEME" => "blue",
        "FILTER_VIEW_MODE" => "vertical",
        "DISPLAY_ELEMENT_COUNT" => "Y",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SAVE_IN_SESSION" => "N",
        "INSTANT_RELOAD" => "N",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PRICE_CODE" => array(),
        "CONVERT_CURRENCY" => "N",
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "-",
        "SECTION_DESCRIPTION" => "-"
    )
);*/?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.filter",
    "",
    Array(
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPONENT_TEMPLATE" => ".default",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_ID" => $arZSettings['CATALOG_ID'],
        "IBLOCK_TYPE" => "1c_catalog",
        "LIST_HEIGHT" => "5",
        "NUMBER_WIDTH" => "5",
        "OFFERS_FIELD_CODE" => array("*", ""),
        "OFFERS_PROPERTY_CODE" => array("", ""),
        "PAGER_PARAMS_NAME" => "arrPager",
        "PRICE_CODE" => array("Оптовая", "Розничная"),
        "PROPERTY_CODE" => array("*", ""),
        "SAVE_IN_SESSION" => "N",
        "TEXT_WIDTH" => "20"
    )
);?>