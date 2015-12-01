<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>
<div class="breadcrumbs">
    <a href="/personal/account/">Вернуться в личный кабинет</a>
</div>
<div class="workarea">
	<div class="page-title">Мои заказы</div>
	<?/*orders*/?>
	<div class="base-card no-h-padding">
	   <?$APPLICATION->IncludeComponent(
			"zakrepi:sale.personal.order.list",
			"list-order-all",
			Array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => ".default",
				"HISTORIC_STATUSES" => array(""),
				"ID" => $ID,
				"NAV_TEMPLATE" => "",
				"ORDERS_PER_PAGE" => "9999",
				"PATH_TO_BASKET" => "",
				"PATH_TO_CANCEL" => "",
				"PATH_TO_COPY" => "",
				"PATH_TO_DETAIL" => "/personal/account/orders/detail.php",
				"SAVE_IN_SESSION" => "Y",
				"SET_TITLE" => "Y",
				"STATUS_COLOR_F" => "gray",
				"STATUS_COLOR_N" => "green",
				"STATUS_COLOR_O" => "gray",
				"STATUS_COLOR_P" => "yellow",
				"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
				"STATUS_COLOR_W" => "gray"
			)
		);?>
	</div>
	<?/*end orders*/?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>