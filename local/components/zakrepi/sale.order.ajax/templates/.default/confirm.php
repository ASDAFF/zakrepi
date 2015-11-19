<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ORDER"]))
{
	?>
	<div class="page-title"><?=GetMessage("SOA_TEMPL_THANKS_FOR_ORDER")?></div>
	<div class="row">
		<div class="col l8">
			<div class="base-card">
				<div class="order-info row">
					<div class="col l4">
						<div class="order-info-item">
							<span class="medium item-title"><?=GetMessage("SOA_TEMPL_ORDER_SUC")?></span>
							<span class="item-value"><?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?></span>
						</div>
						<div class="order-info-item">
							<span class="medium item-title"><?=GetMessage("SOA_TEMPL_ORDER_PERSON")?></span>
							<div class="item-value"><?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["NAME"]?> <?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["LASTNAME"]?> <br/><?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["PHONE"]?></div>
						</div>
					</div>
					<div class="col l4">
						<div class="order-info-item">
							<span class="medium item-title"><?=GetMessage("SOA_TEMPL_ORDER_PAYMENT")?></span>
							<span class="item-value">
							<?
							if (!empty($arResult["PAY_SYSTEM"]))
							{
								echo $arResult["PAY_SYSTEM"]["NAME"];
								if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
								{
									if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
									{
										?>
										<script language="JavaScript">
											window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
										</script>
										<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
										<?
										if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
										{
											?>
											<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
											<?
										}
									}
									else
									{
										if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
										{
											try
											{
												include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
											}
											catch(\Bitrix\Main\SystemException $e)
											{
												if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
													$message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
												else
													$message = $e->getMessage();

												echo '<span style="color:red;">'.$message.'</span>';
											}
										}
									}
								}
							}
							?>
							</span>
						</div>
						<div class="order-info-item">
							<span class="medium item-title"><?=GetMessage("SOA_TEMPL_ORDER_DELIVERY")?></span>
							<div class="item-value"><?=$arResult["ORDER_INFO"]["DELIVERY"]["NAME"]?>, г. <?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["LOCATION"]?>,<br/>
								<?if (!empty($arResult["ORDER_INFO"]["ORDER_PROPS"]["STREET"])):?>ул. <?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["STREET"]?> <?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["HOUSE"]?><?endif;?>
								<?if (!empty($arResult["ORDER_INFO"]["ORDER_PROPS"]["KORPUS"])):?>, корп.<?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["KORPUS"]?><?endif;?>
								<?if (!empty($arResult["ORDER_INFO"]["ORDER_PROPS"]["FLAT"])):?>, кв. <?=$arResult["ORDER_INFO"]["ORDER_PROPS"]["FLAT"]?><?endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="base-card">
				<div class="title big-text"><?=GetMessage("SOA_TEMPL_ORDER_INFO")?></div>
				<div class="card-content prod-list no-g-padding">
					<?foreach($arResult["ORDER_INFO"]["ITEMS"] as $arItem):?>
					<div class="prod-item row">
						<p class="col l4"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></p>
						<p class="col l1 center-align"><?=intval($arItem["QUANTITY"])?> <?=$arItem["MEASURE"]?>.</p>
						<p class="col l3 center-align"><?=priceShow($arItem["PRICE"])?></p>
					</div>
					<?endforeach;?>
				</div>
				<div class="card-footer">
					<p><span class="medium"><?=GetMessage("SOA_TEMPL_ORDER_ITEMS_SUMM")?></span><?=priceShow($arResult["ORDER_INFO"]["ITEMS_SUMM"])?></p>
					<p>
						<span class="medium"><?=GetMessage("SOA_TEMPL_ORDER_DELIVERY_PRICE")?></span>
						<?if (intval($arResult["ORDER"]["PRICE_DELIVERY"]) == 0):
							echo GetMessage("FREE_DELIVERY");
						else:
							echo priceShow($arResult["ORDER"]["PRICE_DELIVERY"]);
						endif;
						?>
					</p>
					<p><span class="medium"><?=GetMessage("SOA_TEMPL_ORDER_ALL_PRICE")?></span><?=priceShow($arResult["ORDER"]["PRICE"])?></p>
				</div>
			</div>
		</div>
	</div>
	<?
}
else
{
	?>
	<div class="page-title"><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></div>
	<?
}
?>
