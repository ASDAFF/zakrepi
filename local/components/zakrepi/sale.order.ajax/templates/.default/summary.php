<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="base-card total-sum-box">
	<div class="title big-text"><?=GetMessage("ORDER_SUMMARY");?></div>
	<div class="card-content">
		<table class="nostyle">
			<tr>
				<td>
				<?
				$productCount = count($arResult["GRID"]["ROWS"]);
				?>
				<?=$productCount?> <?=wordForm($productCount, 'товар', 'товара', 'товаров')?> <?=GetMessage("SOA_TEMPL_SUMM");?></td><td class="sum" align="right"><?=priceShow($arResult["ORDER_PRICE"])?>
				</td>
			</tr>
			<tr>
				<td><?=GetMessage("SOA_TEMPL_SUM_DELIVERY");?></td>
				<td align="right">
					<?
					if ($arResult["DELIVERY_PRICE"] == 0)
						echo GetMessage("FREE_DELIVERY");
					else
						echo priceShow($arResult["DELIVERY_PRICE"]);
					?>
				</td>
			</tr>
			<tr><td><?=GetMessage("SOA_TEMPL_SUM_IT");?></td><td class="sum" align="right"><?=priceShow($arResult["ORDER_TOTAL_PRICE_NOT_FORMATED"])?></td></tr>
		</table>
		<p class="color-text text-light"><?=GetMessage("SOA_TEMPL_AGREEMENT");?></br>
		<a href="/checkout/oferta/" target="_blank" class="text-primary"><?=GetMessage("SOA_TEMPL_AGREEMENT_LINK")?></a></p>
	</div>
</div>
<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="display:none"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>