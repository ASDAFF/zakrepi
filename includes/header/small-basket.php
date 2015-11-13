<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "cart", Array(
        "PATH_TO_BASKET" => "/cart/",	// Страница корзины
        "PATH_TO_ORDER" => "/personal/order/make/",	// Страница оформления заказа
        "SHOW_DELAY" => "N",	// Показывать отложенные товары
        "SHOW_NOTAVAIL" => "N",	// Показывать товары, недоступные для покупки
        "SHOW_SUBSCRIBE" => "N",	// Показывать товары, на которые подписан покупатель
    ),
    false
);?>