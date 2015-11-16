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

        'ADD_BASKET_LINK' => 'add_basket_'.$strMainID,

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
    $price = 0;
	?>
    <?
    /*Получаем изоброажение товара*/
    $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    ?>
    <div class="item col l3">
        <div class="product-card">
            <?/*
            <pre><?print_r($arItem['OFFERS']);?></pre>
            <pre><?print_r($arItem['OFFERS_LIST']);?></pre>
            */?>
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

                <?
                $offers = array();
                foreach($arItem['OFFERS_LIST'] as $i=>$itemOffer):
                   // $minPrice = (isset($itemOffer['RATIO_PRICE']) ? $itemOffer['RATIO_PRICE'] : $itemOffer['MIN_PRICE']);
                    $option = '';
                    foreach($itemOffer['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $a=>$item):
                        if($a==0){ $option .= $item;}
                        else{$option .= ' '.$item;}
                    endforeach;
                    $offers[$i]['ID'] = $itemOffer['ID'];
                    $offers[$i]['PRICE'] = $itemOffer['PRICE']['PRICE'];
                    $offers[$i]['OPTION'] = $option;
                    $offers[$i]['NAME'] = $itemOffer['NAME'];
                endforeach;?>
                <? if($arItem['OFFERS'] == 'Y'):?>
                    <!-- если есть -->
                    <div class="product-options">
                        <div class="inline-field clearfix">
                            <span class="label">Размер</span>
                            <div class="select-box hide-on-large-only">
                                <select name="prod-size-sel" id="select_<?=$arItemIDs['ADD_BASKET_LINK']?>" onchange="select_prop('select_<?=$arItemIDs['ADD_BASKET_LINK']?>','<?=$arItemIDs['ADD_BASKET_LINK']?>','Y');" >
                                    <?foreach($offers as $i=>$itemOffer):?>
                                        <option value="<?=$itemOffer['ID']?>" data-price="<?=$itemOffer['PRICE']?>" <?if($i==0):?>selected<?endif;?>><?=$itemOffer['OPTION'];?></option>
                                    <?endforeach;?>
                                </select>
                                <div class="triangle"></div>
                            </div>
                            <div class="dropdown-box hide-on-med-and-down right">
                                <div class="dropdown-value">
                                    <div class="item-text"></div>
                                    <div class="triangle"></div>
                                </div>
                                <ul class="dropdown-list select-synh hide-on-med-and-down" data-select="select_<?=$arItemIDs['ADD_BASKET_LINK']?>">
                                    <?foreach($offers as $i=>$itemOffer):?>
                                        <li class="dropdown-item"  <?if($i==0):?>data-active="active"<?endif;?>>
                                            <input type="radio" class="dropdown-inp" name="prod-size" value="<?=$itemOffer['ID']?>" id="prod-size-rad-<?=$arItemIDs['ADD_BASKET_LINK']?>-<?=$i?>" <?if($i==0):?>checked="checked"<?endif;?> data-value-text="<?=$itemOffer['OPTION'];?>"/>
                                            <label class="dropdown-title" for="prod-size-rad-<?=$arItemIDs['ADD_BASKET_LINK']?>-<?=$i?>">
                                                <div class="item-text"><?=$itemOffer['OPTION'];?></div>
                                            </label>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?endif;?>
                <?
                if (!empty($minPrice))
                {
                    $price = $minPrice['DISCOUNT_VALUE'];
                }
                if($arItem['OFFERS'] == 'Y')
                {
                    $price = $arItem['OFFERS_LIST'][0]['PRICE']['PRICE'];
                }
                unset($minPrice);
                ?>
                <?if($price != 0){?>

                    <div class="product-price">
                        <?/*?>
                        <div class="old-price" ><i class="rouble">i</i></div>
                        <?*/?>
                        <!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->

                        <div class="price" id="price_<?=$arItemIDs['ADD_BASKET_LINK']?>" ><?=priceShow($price);?></div>
                    </div>
                    <?
                        $addBasket = '';
                        if(!empty($arItem['OFFERS_LIST'])){$addBasket = 'add_basket(\''.$offers[0]['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}else{$addBasket = 'add_basket(\''.$arResult['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}
                    ?>

                    <span class="btn center  shopping-card btn-icon loader" id="loader-<? echo $arItemIDs['ADD_BASKET_LINK']; ?>" style="display:none;">
                            <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                    </span>
                    <a href="javascript:void(0);" onclick="<?=$addBasket?>" class="shopping-card btn btn-icon primary" id="<?=$arItemIDs['ADD_BASKET_LINK']?>">
                        <svg class="icon"><use xlink:href="#cart"/></svg>
                    </a>
                <?}else{?>
                    <div class="product-price">
                        <?/*?>
                        <div class="old-price" ><i class="rouble">i</i></div>
                        <?*/?>
                        <!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->

                        <div class="price" id="price_<?=$arItemIDs['ADD_BASKET_LINK']?>" ></div>
                    </div>
                    <a href="javascript:void(0);"  class="shopping-card btn btn-icon primary gray" id="<?=$arItemIDs['ADD_BASKET_LINK']?>">
                        <svg class="icon"><use xlink:href="#cart"/></svg>
                    </a>
                <?}?>
            </div>
            <?
            $arCompare = $_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"];
            $key = array_search($arItem['ID'], array_column($arCompare, 'ID'));
            $countCompare = count($arCompare);
            ?>
            <div class="compare">
                <input type="checkbox" class="compare-input <?if(strlen($key) > 0 ){?>checked<?}else{?>no-check<?}?>" id="compare_today_<?=$arItem['ID'];?>" onclick="compare_product(<?=$arItem['ID'];?>,'<?=$arParams['COMPARE_PATH']?>');" <?if(strlen($key) > 0 ):?>checked<?endif?> <?if($countCompare>=5):?><?if(strlen($key) > 0 ){?>checked<?}else{?>disabled<?}?><?endif;?>/>
                <label class="checkbox-lbl" for="compare_today_<?=$arItem['ID'];?>">Cравнить</label>
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