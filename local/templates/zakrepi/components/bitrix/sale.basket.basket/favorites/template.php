<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */
$curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
$arUrls = array(
	"delete" => $curPage."delete&id=#ID#",
	"delay" => $curPage."delay&id=#ID#",
	"add" => $curPage."add&id=#ID#",
);
unset($curPage);

$arBasketJSParams = array(
	'SALE_DELETE' => GetMessage("SALE_DELETE"),
	'SALE_DELAY' => GetMessage("SALE_DELAY"),
	'SALE_TYPE' => GetMessage("SALE_TYPE"),
	'TEMPLATE_FOLDER' => $templateFolder,
	'DELETE_URL' => $arUrls["delete"],
	'DELAY_URL' => $arUrls["delay"],
	'ADD_URL' => $arUrls["add"]
);
?>
<?
if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
{
	?>
	<div id="warning_message">
		<?
		if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
		{
			foreach ($arResult["WARNING_MESSAGE"] as $v)
				ShowError($v);
		}
		?>
	</div>
	<?
	$delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
	$delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

	$subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
	$subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

	$naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
	$naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

    ?>
    <div class="workarea">
        <div class="row page-title-basket">
            <div class="page-title col l10"><?= GetMessage("SALE_OTLOG_TITLE")?></div>
            <div class="col l2 right-align"><button class="btn-link btn-clear-basket">Очистить избранное</button></div>
        </div>
        <div class="row col">
            <div class="base-card flex-table no-padding basket-table">
                <div class="table-row table-header">
                    <div class="col l6"><?= GetMessage("SALE_NAME")?></div>
                    <div class="col l3"><?= GetMessage("SALE_PRICE")?></div>
                </div>
                <div class="table-body">
                    <?
                    foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                        if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y"):
                            ?>
                            <div class="table-row product-item" id="favorite-<?=$arItem['ID']?>">

                                <div class="loader-favorite hide" id="loader-favorite-<?=$arItem['ID']?>">
                                    <div class="loader-center">
                                        <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                                    </div>
                                </div>

                                <div class="col l2 product-img">
                                    <img src="<?echo $arItem["PREVIEW_PICTURE_SRC"] ?>"/>
                                </div>
                                <div class="col l4 product-name">
                                    <?echo $arItem["NAME"]?>
                                    <p><a class="color-text text-light" href="javascript:void(0);" onclick="remove_favorite(<?=$arItem['ID']?>);">Удалить</a></p>
                                </div>
                                <div class="col l3 sum">
                                    <?=priceShow($arItem["PRICE"]);?>
                                </div>
                                <div class="col l3">
                                    <a href="javascript:void(0);" onclick="add_basket_in_favorite(<?=$arItem['ID']?>)" class="shopping-card mini center btn btn-icon primary">
                                        <svg class="icon"><use xlink:href="#cart"/></svg>
                                    </a>
                                </div>
                            </div>
                        <?endif;?>
                    <?
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        </br></br></br></br></br></br></br></br></br></br>
    </div> <!-- /.workarea -->

<?
}
else
{
	ShowError($arResult["ERROR_MESSAGE"]);
}
?>