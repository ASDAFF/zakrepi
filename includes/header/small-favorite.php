<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?if($USER->IsAuthorized()):?>
	<?
		$arBasketItems = array();
		CModule::IncludeModule("sale");
		$dbBasketItems = CSaleBasket::GetList(
				array(
						"NAME" => "ASC",
						"ID" => "ASC"
					),
				array(
						"FUSER_ID" => CSaleBasket::GetBasketUserID(),
						"LID" => SITE_ID,
						"ORDER_ID" => "NULL",
						"DELAY" => "Y"
					),
				false,
				false,
				array("ID", "CALLBACK_FUNC", "MODULE", 
					  "PRODUCT_ID", "QUANTITY", "DELAY", 
					  "CAN_BUY", "PRICE", "WEIGHT")
			);
		while ($arItems = $dbBasketItems->Fetch())
		{
			if (strlen($arItems["CALLBACK_FUNC"]) > 0)
			{
				CSaleBasket::UpdatePrice($arItems["ID"], 
										 $arItems["CALLBACK_FUNC"], 
										 $arItems["MODULE"], 
										 $arItems["PRODUCT_ID"], 
										 $arItems["QUANTITY"]);
				$arItems = CSaleBasket::GetByID($arItems["ID"]);
			}
			$arBasketItems[] = $arItems;
		}
		$count_favorite = count($arBasketItems);
	?>
	<?if($count_favorite == 0):?>
		<a href="/personal/favorites/" class="btn btn-favorite btn-icon col"><svg class="icon"><use xlink:href="#heart"/></svg></a>
	<?else:?>
		<a href="/personal/favorites/" class="btn btn-favorite btn-icon col ok-favorite" title="Избранное">
			<svg class="icon"><use xlink:href="#heart"/></svg>
			<div class="notification-favorite"><?=$count_favorite ?></div>
		</a>
	<?endif;?>
<?else:?>
	<a href="#" class="btn btn-favorite btn-icon col"><svg class="icon"><use xlink:href="#heart"/></svg></a>
<?endif;?>