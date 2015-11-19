<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?><?$APPLICATION->SetTitle("Корзина");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"basket",
	Array(
		"ACTION_VARIABLE" => "action",
		"COLUMNS_LIST" => array("NAME","DELETE","PRICE","QUANTITY"),
		"COMPONENT_TEMPLATE" => "basket",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"HIDE_COUPON" => "N",
		"PATH_TO_ORDER" => "/checkout/",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"USE_PREPAYMENT" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>