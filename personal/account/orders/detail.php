<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>

<?$APPLICATION->IncludeComponent(
	"zakrepi:sale.personal.order.detail",
	"order-detail",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"CUSTOM_SELECT_PROPS" => array(""),
		"ID" => $ID,
		"PATH_TO_CANCEL" => "",
		"PATH_TO_LIST" => "",
		"PATH_TO_PAYMENT" => "payment.php",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "1",
		"PICTURE_WIDTH" => "110",
		"PROP_1" => array(""),
		"PROP_2" => array(""),
		"SET_TITLE" => "Y"
	)
);?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>