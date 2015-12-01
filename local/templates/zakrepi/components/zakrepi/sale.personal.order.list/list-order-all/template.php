<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult['ERRORS']['FATAL'])):?>

	<?foreach($arResult['ERRORS']['FATAL'] as $error):?>
		<?=ShowError($error)?>
	<?endforeach?>

<?else:?>

	<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

		<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
			<?=ShowError($error)?>
		<?endforeach?>

	<?endif?>
	<?if(!empty($arResult['ORDERS'])):?>
		<div class="orders-table flex-table center-align row">
			<div class="table-row table-header">
				<div class="col l2">Дата заказа</div>
				<div class="col l2">Номер заказа</div>
				<div class="col l3">Статус</div>
				<div class="col l2">Стоимость</div>
			</div>
			<?foreach($arResult["ORDER_BY_STATUS"] as $key => $group):?>
				
				<?foreach($group as $k => $order):?>
					<div class="table-row">
						<div class="col l2"><?=$order["ORDER"]["DATE_INSERT_FORMATED"];?></div>
						<div class="col l2"><?=$order["ORDER"]["ACCOUNT_NUMBER"]?></div>
						<div class="col l3"><?=$arResult["INFO"]["STATUS"][$key]["NAME"]?></div>
						<div class="col l2"><?=priceShow($order["ORDER"]["PRICE"])?></div>
						<div class="col l3"><a href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>?ID=<?=$order["ORDER"]['ID']?>">Посмотреть детали</a></div>
					</div>
				<?endforeach?>
					
			<?endforeach?>
		</div>
		<?if($arResult['COUNT_ORDERS'] > $arParams['ORDERS_PER_PAGE']):?>
			<a href="<?=$arResult["CURRENT_PAGE"]?>orders/index.php?show_all=Y" class="btn primary center"><?=GetMessage('SPOL_ORDERS_ALL')?></a>
		<?endif;?>
	<?else:?>
		<?=GetMessage('SPOL_NO_ORDERS')?>
	<?endif?>
<?endif?>