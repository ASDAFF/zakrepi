<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
    <div class="breadcrumbs">
        <a class="brdcmb-link" href="#">Главная</a> /
        <a class="brdcmb-link" href="#">Строительство и ремонт</a> /
        <a class="brdcmb-link" href="#">Инструменты</a> /
        <a class="brdcmb-link" href="#">Электроинструменты</a> /
        <a class="brdcmb-link" href="#">Гайковерты</a>
    </div>
<div class="workarea">
<?$APPLICATION->IncludeComponent(
    "zakrepi:catalog.element",
    "catalog-element",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "",
        "IBLOCK_ID" => $arZSettings['CATALOG_ID'],
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["code"],
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "HIDE_NOT_AVAILABLE" => "N",
        "PROPERTY_CODE" =>  array(
            "CML2_ARTICLE",
            "CML2_BASE_UNIT",
            "vote_count",
            "CML2_MANUFACTURER",
            "rating",
            "CML2_TRAITS",
            "CML2_TAXES",
            "vote_sum",
            "CML2_ATTRIBUTES",
            "CML2_BAR_CODE",
            "*"),
        /*Параметры которые не выводить*/
        "NOT_PROPERTY_CODE"=>array(
            "CML2_ATTRIBUTES",
            "CML2_ARTICLE",
            "CML2_TAXES",
            "CML2_BAR_CODE",
            "CML2_TRAITS",
            "vote_count",
            "rating",
            "vote_sum"
        ),
        "OFFERS_LIMIT" => "0",
        "TEMPLATE_THEME" => "blue",
        "DISPLAY_NAME" => "Y",
        "DETAIL_PICTURE_MODE" => "IMG",
        "ADD_DETAIL_TO_SLIDER" => "N",
        "DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",

        /*rating*/
        "USE_VOTE_RATING" => "Y",
        /*comments*/
        "USE_COMMENTS" => "Y",

        "BRAND_USE" => "Y",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "CHECK_SECTION_ID_VARIABLE" => "N",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "SET_CANONICAL_URL" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_LAST_MODIFIED" => "N",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "USE_ELEMENT_COUNTER" => "Y",
        "SHOW_DEACTIVATED" => "N",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "DISPLAY_COMPARE" => "Y",
        "COMPARE_PATH" => "/compare/",
        "PRICE_CODE" => array(0 => "Розничная",),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "CONVERT_CURRENCY" => "N",
        "BASKET_URL" => "/cart/index.php",
        "USE_PRODUCT_QUANTITY" => "N",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "PRODUCT_PROPERTIES" => array(),
        "ADD_TO_BASKET_ACTION" => array("ADD"),
        "LINK_IBLOCK_TYPE" => "",
        "LINK_IBLOCK_ID" => "",
        "LINK_PROPERTY_SID" => "",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",

        /*ajax подгрузка дополнительного материала*/
        /*технические характеристики*/
        "ROUTE_TECH" => "tech",
        "ROUTE_TECH_URL" => "/includes/product/tech.php",
        /*отзывы о товаре*/
        "ROUTE_REVIEWS" => "reviews",
        "ROUTE_REVIEWS_URL" => "/includes/product/reviews.php",
        /*наличие товара в магазинах*/
        "ROUTE_STORE" => "store",
        "ROUTE_STORE_URL" => "/includes/product/store.php",
    )
);?>
</div> <!-- /.workarea -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>