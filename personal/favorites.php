<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранный товар");?>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "favorites",
    Array(
        "COMPONENT_TEMPLATE" => ".default",
        "COLUMNS_LIST" => array("NAME", "DISCOUNT", "WEIGHT", "DELETE", "DELAY", "TYPE", "PRICE", "QUANTITY"),
        "PATH_TO_ORDER" => "/personal/order.php",
        "HIDE_COUPON" => "N",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "USE_PREPAYMENT" => "N",
        "QUANTITY_FLOAT" => "N",
        "SET_TITLE" => "Y",
        "ACTION_VARIABLE" => "action",
        "OFFERS_PROPS" => array(),
        /*Дополнительные параметры*/
        //"IBLOCK_ID" => $arZSettings['CATALOG_ID']
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>