<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
    <span class="btn btn-minicartloader loader-small-basket" style="display:none;">
        <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
    </span>
<?
if ($arResult["READY"]=="Y" && count($arResult["ITEMS"]) > 0)
{
	$price = 0;
	foreach($arResult["ITEMS"] as $arItem){
		$price += $arItem["PRICE"] * $arItem["QUANTITY"];
	}
	?>
	<a class="btn standart btn-with-icon col l2 btn-minicart" href="<?=$arParams["PATH_TO_BASKET"]?>" id="minicard"><svg class="icon"><use xlink:href="#cart"/></svg><div class="notification"><?=count($arResult["ITEMS"])?></div> <?=priceShow($price)?></a>
	<?
}
else
{
	?>
	<a class="btn standart btn-with-icon col l2 btn-minicart" href="<?=$arParams["PATH_TO_BASKET"]?>" id="minicard"><svg class="icon"><use xlink:href="#cart"/></svg><div class="notification"></div> <?=GetMessage("NO_PRODUCTS");?></a>
	<?
}
?>