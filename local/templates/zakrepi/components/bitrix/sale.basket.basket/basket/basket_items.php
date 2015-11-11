<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

if ($normalCount > 0):
	foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
		$arHeaders[] = $arHeader["id"];
	endforeach;
?>

<div class="base-card" id="min_summ_note" <?if($arResult["allSum"] > ORDER_MIN_SUMM):?>style="display:none"<?endif;?>>
	<?=GetMessage("MIN_ORDER_SUMM")?> <?=priceShow(ORDER_MIN_SUMM)?>
</div>

<div class="base-card" id="free_delivery_note" <?if($arResult["allSum"] < ORDER_MIN_SUMM):?>style="display:none"<?endif;?>>
	<?=GetMessage("FREE_DELIVERY_IN_TYUMEN")?> <?=priceShow(FREE_DELIVERY_SUMM)?><span id="free_delivery_need_summ" <?if(FREE_DELIVERY_SUMM < $arResult["allSum"]):?>style="display:none;"<?endif;?>><?=GetMessage("NEED_MORE_PRODUCTS")?> <span class="primary-text"><?=priceShow(FREE_DELIVERY_SUMM-$arResult["allSum"])?></span></span>
</div>

<script type="text/javascript">
	var scriptPath = '<?=$this->GetFolder()?>/ajax.php';
	var ORDER_MIN_SUMM = <?=ORDER_MIN_SUMM?>;
	var FREE_DELIVERY_SUMM = <?=FREE_DELIVERY_SUMM?>;
</script>

<div id="basket_items_list">
	<div class="row col">
		<div class="base-card basket-table flex-table no-padding">
			<div class="table-row table-header">
				<div class="col l6" id="col_NAME"><?=GetMessage('BASKET_TABLE_HEADER_PRODUCT')?></div>
				<div class="col l2" id="col_QUANTITY"><?=GetMessage('BASKET_TABLE_HEADER_COUNT')?></div>
				<div class="col l3" id="col_PRICE"><?=GetMessage('BASKET_TABLE_HEADER_PRICE')?></div>
			</div>
			<div class="table-body" id="basket_items">
				<?foreach($arResult["GRID"]["ROWS"] as $arItem):
					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):?>
					<div class="table-row product-item basket-item" id="<?=$arItem["ID"]?>">
						<div class="col l2 product-img">
							<?
							if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
								$url = $arItem["PREVIEW_PICTURE_SRC"];
							elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
								$url = $arItem["DETAIL_PICTURE_SRC"];
							else:
								//$url = $templateFolder."/images/no_photo.png";
								$url = "";
							endif;
							?>
							<?if (strlen($url) > 0):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img src="<?=$url?>" />
							</a>
							<?endif;?>
						</div>
						<div class="col l4 product-name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="nostyle"><?=$arItem["NAME"]?></a></div>
						<div class="col l2 quantity">
							<div class="quantity-field">
								<?
								$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
								$max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
								$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
								$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
								?>
								<input
									type="text"
									id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
									name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
									size="2"
									class="quantity-value"
									min="0"
									<?=$max?>
									step="<?=$ratio?>"
									value="<?=$arItem["QUANTITY"]?>"
									onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
								>
								<?
								if (!isset($arItem["MEASURE_RATIO"]))
								{
									$arItem["MEASURE_RATIO"] = 1;
								}

								if (
									floatval($arItem["MEASURE_RATIO"]) != 0
								):
								?>
									<button class="btn-up" <?if (isset($arItem["AVAILABLE_QUANTITY"]) && $arItem["AVAILABLE_QUANTITY"] == $arItem["QUANTITY"]):?>disabled<?endif;?> onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>); return false;"></button>
									<button class="btn-down" <?if ($arItem["QUANTITY"] == 1):?>disabled<?endif;?> onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>); return false;"></button>
								<?
								endif;
								?>
								<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
							</div>
						</div>
						<div class="col l3 sum">
							<span id="current_price_<?=$arItem["ID"]?>"><?=priceShow($arItem["FULL_PRICE"])?></span>
						</div>
						<div class="col l1 delete"><button class="btn btn-icon btn-delete-from-card" onclick="deleteBasketItem(<?=$arItem["ID"]?>); return false;"><svg class="icon"><use xlink:href="#cross"/></svg></button></div>
					</div>
				<?
					endif;
				endforeach;?>
			</div>
		</div>
	</div>

	<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
	<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

	<div class="row">
		<div class="col l3">
			<div id="coupons_block">
			<?
			if ($arParams["HIDE_COUPON"] != "Y")
			{
			?>
				<?
				if (!empty($arResult['COUPON_LIST']))
				{
					$couponValue = '';
					foreach ($arResult['COUPON_LIST'] as $oneCoupon)
					{
						$couponValue = htmlspecialcharsbx($oneCoupon['COUPON']);
						break;
					}
					unset($oneCoupon);
				}
				?>
				<div class="promo-code-box base-card <?if(!empty($couponValue)):?>hide<?endif;?>">Есть промокод?  <a href="#" class="btn-toggle-block" data-block=".promo-code-box">Активируйте!</a></div>
				<div class="promo-code-box base-card <?if(empty($couponValue)):?>hide<?endif;?>">Введите промокод
					<div class="promocode-field">
						<input type="text" id="coupon" name="COUPON" value="<?=$couponValue?>" data-coupon="<?=$couponValue?>" /><button class="btn btn-icon primary small" onclick="enterCoupon(); return false;"><svg class="icon"><use xlink:href="#arr"/></svg></button>
					</div>
				</div>

			<?		
			}
			else
			{
				?>&nbsp;<?
			}
			?>
			</div>
		</div>
		<div class="col l4 right total-sum-box">
			<div class="base-card">
				<div class="big-text title"><?=GetMessage("PRODUCT_COST")?></div>
				<table class="nostyle">
					<tr><td><?=GetMessage("SUMM_WITHOUT_DISCOUNT")?></td><td class="sum" align="right" id="PRICE_WITHOUT_DISCOUNT"><?=priceShow($arResult["allSum"] + $arResult["DISCOUNT_PRICE_ALL"])?></td></tr>
					<tr><td><?=GetMessage("DISCOUNT")?></td><td class="sum" align="right" id="DISCOUNT_PRICE_ALL"><?=priceShow($arResult["DISCOUNT_PRICE_ALL"])?></td></tr>
					<tr>
						<td>
							<span id="summ_with_delivery" <?if(FREE_DELIVERY_SUMM > $arResult["allSum"]):?>style="display:none;"<?endif;?>><?=GetMessage("SUMM_TO_PAYMENT")?></span>
							<span id="summ_without_delivery" <?if(FREE_DELIVERY_SUMM < $arResult["allSum"]):?>style="display:none;"<?endif;?>><?=GetMessage("SUMM_WITHOUT_DELIVERY")?></span>
						</td>
						<td class="sum" align="right" id="allSum_FORMATED"><?=priceShow($arResult["allSum"])?></td>
					</tr>
				</table>
			</div>
			<button id="orderBtn" class="btn primary fullwidth big btn-checkout" <?if($arResult["allSum"] < ORDER_MIN_SUMM):?>disabled<?endif;?> onclick="checkOut();"><?=GetMessage("SALE_ORDER")?></button>
		</div>
	</div>
</div>
<?
else:
?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td colspan="<?=$numCells?>" style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?
endif;
?>