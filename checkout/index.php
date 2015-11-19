<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Оформление заказа");
$_SESSION["LOCATION"] = 2186;
?>
<div class="workarea">
<?$APPLICATION->IncludeComponent(
	"zakrepi:sale.order.ajax", 
	"zakrepi-ajax-order",
	array(
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_DELIVERY_TAX" => "N",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "N",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/cart/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "/personal/account/",
		"PAY_FROM_ACCOUNT" => "N",
		"PRODUCT_COLUMNS" => array(
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"GROUP_1" => array(
			0 => "5",
		),
		"GROUP_2" => array(
			0 => "6",
		),
		"DEFAULT_PERSON_TYPE_ID" => "1",
		"CONTACT_PROPERTIES_1" => array(
			0 => "1",
		),
		"CONTACT_PROPERTIES_2" => array(
			0 => "2",
		),
		"DELIVERY_PROPERTIES_1" => array(
			0 => "3",
		),
		"DELIVERY_PROPERTIES_2" => array(
			0 => "4",
		),
		"PAYMENT_GROUP_1" => array(
			0 => "1",
			1 => "2",
		),
		"PAYMENT_GROUP_2" => array(
			0 => "3",
			1 => "4",
		)
	),
	false
);?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>