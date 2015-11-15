<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
if (!empty($arResult['ITEMS']))
{
?>
    <pre><?print_r($arResult['ITEMS']);?></pre>
<div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
    <?
foreach ($arResult['ITEMS'] as $key => $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);

	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);

	?>
    <?
    /*Получаем изоброажение товара*/
    $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    ?>
    <div class="item col l3">
        <div class="product-card">
            <div class="product-info">
                <a class="item-img center-align" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                    <img src="<? echo $file['src']; ?>"/>
                </a>
                <div class="item-name"><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $productTitle; ?></a></div>
                <?
                    $rating = 0;
                    if($arItem['PROPERTIES']['rating']['VALUE']!='') $rating = $arItem['PROPERTIES']['rating']['VALUE'];
                ?>
                <div class="rating rate-<?=$rating?>">
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                </div>
                <div class="product-price">
                    <?/*?>
                    <div class="old-price" ><i class="rouble">i</i></div>
                    <?*/?>
                    <!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->
                    <?
                    if (!empty($minPrice))
                    {
                        if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
                        {
                            echo GetMessage(
                                'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
                                array(
                                    '#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
                                    '#MEASURE#' => GetMessage(
                                        'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
                                        array(
                                            '#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
                                            '#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
                                        )
                                    )
                                )
                            );
                        }
                        else
                        {
                           // echo $minPrice['PRINT_DISCOUNT_VALUE'];
                            $price = $minPrice['DISCOUNT_VALUE'];
                        }
                        if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE'])
                        {
                            $price = $minPrice['DISCOUNT_VALUE'];

                        }
                    }

                    unset($minPrice);
                    ?>
                    <div class="price"><?=priceShow($price);?></div>
                </div>
                <a href="#" class="shopping-card btn btn-icon primary">
                    <svg class="icon"><use xlink:href="#cart"/></svg>
                </a>
            </div>
            <div class="compare">
                <input type="checkbox" id="compare_today_{{product.id}}" />
                <label class="checkbox-lbl" for="compare_today_{{product.id}}">Cравнить</label>
            </div>
        </div>
    </div>
<?
}
?>

    <div style="clear: both;"></div>
</div>

    <div class="bx-section-desc <? echo $templateData['TEMPLATE_CLASS']; ?>">
        <p class="bx-section-desc-post"><?=$arResult["DESCRIPTION"]?></p>
    </div>
    <?/*
<script type="text/javascript">
BX.message({
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>
*/?>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}