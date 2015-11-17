<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
if(in_array(6,CUser::GetUserGroup(CUser::GetID()))) $type_price = "Оптовая";//Оптовая
elseif(in_array(5,CUser::GetUserGroup(CUser::GetID()))) $type_price = "Розничная";//Розничная
else $type_price = "Розничная";//Розничная
$APPLICATION->IncludeComponent(
    "zakrepi:catalog.smart.filter",
    //"catalog-filter",
    "catalog-filter-ajax",
    //"visual_vertical",
    //"",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "",
        "IBLOCK_ID" => $arZSettings['CATALOG_ID'],
        "SECTION_ID" => "",//$_REQUEST["SECTION_ID"],
        "SECTION_CODE" => $_REQUEST["code"],

        "PRICE_CODE" =>  array($type_price),

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
        "INSTANT_RELOAD" => "Y",
        "PAGER_PARAMS_NAME" => "arrPager",
        "CONVERT_CURRENCY" => "N",
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "-",
        "SECTION_DESCRIPTION" => "-"
    )
);?>