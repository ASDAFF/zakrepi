<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="breadcrumbs">
	<a href="/personal/account/orders/index.php?show_all=Y"><?=GetMessage('SPOD_CUR_ORDERS')?></a>
</div>
<?if(strlen($arResult["ERROR_MESSAGE"])):?>

		<?=ShowError($arResult["ERROR_MESSAGE"]);?>

<?else:?>
<div class="workarea">
	<div class="page-title"><?=GetMessage('SPOD_ORDER')?> <?=GetMessage('SPOD_NUM_SIGN')?><?=$arResult["ACCOUNT_NUMBER"]?></div>
	<div class="row">
		<div class="col l8">
			<div class="base-card">
				<div class="order-info row">
					<div class="col l4">
						<div class="order-info-item">
							<span class="medium item-title">Дата заказа: </span>
							<span class="item-value"><?=$arResult["DATE_INSERT_FORMATED"]?></span>
						</div>
						<div class="order-info-item">
							<span class="medium item-title">Статус заказа:</span>
							<span class="item-value status-done"><?=$arResult["STATUS"]["NAME"]?></span>
						</div>
						<div class="order-info-item">
							<span class="medium item-title">Получатель:</span>
							<div class="item-value">
								<?=$arResult['ORDER_PROPS_GROUP']['CONTACT_PROP']['VALUE']?>
							</div>
						</div>
					</div>
					<div class="col l4">
						<div class="order-info-item">
							<span class="medium item-title">Информация об оплате: </span>
							<span class="item-value">
								<?if(intval($arResult["PAY_SYSTEM_ID"])):?>
									<?=$arResult["PAY_SYSTEM"]["NAME"]?>
								<?else:?>
									<?=GetMessage("SPOD_NONE")?>
								<?endif?>
							</span>
						</div>
						
							<div class="order-info-item">
								<span class="medium item-title">Способ доставки: </span>
								<div class="item-value">
									<?if(strpos($arResult["DELIVERY_ID"], ":") !== false || intval($arResult["DELIVERY_ID"])):?>
										<?=$arResult["DELIVERY"]["NAME"]?>
									<?endif;?>
								</div>
							</div>
						<?if($arResult["DELIVERY"]['ID'] == 1){//Самовывоз?>
							<div class="order-info-item">
								<span class="medium item-title">Адрес точки выдачи: </span>
								<div class="item-value">
									<?=$arResult["DELIVERY"]["DESCRIPTION"]?>
								</div>
							</div>
						<?}else{?>
							<div class="order-info-item">
								<span class="medium item-title">Информация о доставке: </span>
								<div class="item-value">
									<?=$arResult['ORDER_PROPS_GROUP']['DELIVERY_PROP']['VALUE']?>
								</div>
							</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col l4">
			<div class="base-card">
				<div class="title big-text">Состав заказа</div>
				<div class="card-content prod-list no-g-padding">
					<?foreach($arResult["BASKET"] as $prod):?>
						<div class="prod-item">
							<p>
								<?$hasLink = !empty($prod["DETAIL_PAGE_URL"]);?>
								<?if($hasLink):?>
									<a href="<?=$prod["DETAIL_PAGE_URL"]?>" target="_blank">
								<?endif?>
								<?=htmlspecialcharsEx($prod["NAME"])?>
								<?if($hasLink):?>
									</a>
								<?endif?>
							</p>
							<p>
								Количество: <?=$prod["QUANTITY"]?> 
								<?if(strlen($prod['MEASURE_TEXT'])):?>
									<?=$prod['MEASURE_TEXT']?>
								<?else:?>
									<?=GetMessage('SPOD_DEFAULT_MEASURE')?>
								<?endif?>
							</p>
							<p>Сумма: <?=priceShow($prod['PRICE'])?>
							</p>
						</div>
					<?endforeach;?>
				</div>
				<div class="card-footer">
					<p><span class="medium">Общая стоимость товаров: </span><?=priceShow($arResult['PRODUCT_SUM_FORMATTED'])?></p>
					<?if(strlen($arResult["PRICE_DELIVERY_FORMATED"])){?>
						<p><span class="medium">Стоимость доставки: </span><?=priceShow($arResult['PRICE_DELIVERY_FORMATED'])?></p>
					<?}else{?>
						<p><span class="medium">Стоимость доставки: </span>Бесплатно</p>
					<?}?>
					<p><span class="medium">Итого: </span><?=priceShow($arResult['PRICE_FORMATED'])?></p>
				</div>
			</div>
		</div>
	</div>
</div> <!-- /.workarea -->
	<?endif?>