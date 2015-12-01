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
    if($arItem['DETAIL_PICTURE']['ID'] != ''){
        $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
    elseif($arItem['PREVIEW_PICTURE']['ID'] != ''){
        $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
    elseif($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'][0] != ''){
        $file = CFile::ResizeImageGet($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'][0], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
    elseif($arItem['PROPERTIES']['FILES']['VALUE'][0] != ''){
        $file = CFile::ResizeImageGet($arItem['PROPERTIES']['FILES']['VALUE'][0], array('width'=>240, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
    else
    {
        $file['src'] = '/local/templates/zakrepi/components/zakrepi/catalog.element/catalog-element/images/no_photo.png';
    }


    		
    			if($arItem['OFFERS'] == 'Y'):
	                $offers = array();
	                $quentity_product = 0;
	                $num=0;
	                foreach($arItem['OFFERS_LIST'] as $i=>$itemOffer):
	                   // $minPrice = (isset($itemOffer['RATIO_PRICE']) ? $itemOffer['RATIO_PRICE'] : $itemOffer['MIN_PRICE']);
	                    $option = '';
	                    foreach($itemOffer['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $a=>$item):
	                        if($a==0){ $option .= $item;}
	                        else{$option .= ' '.$item;}
	                    endforeach;

	                    $quentity = CCatalogProduct::GetByID($itemOffer['ID']);
	                   	$itemOffer['CATALOG_QUANTITY'] = $quentity['QUANTITY'];

	                   	$quentity_product += $itemOffer['CATALOG_QUANTITY'];

	                    if($itemOffer['CATALOG_QUANTITY']!=0 ):
	                        $offers[$num]['ID'] = $itemOffer['ID'];
					        $offers[$num]['PRICE'] = $itemOffer['PRICE']['PRICE'];
					        $offers[$num]['OPTION'] = $option;
					        $offers[$num]['NAME'] = $itemOffer['NAME'];
					        $num++;
	                    endif;
	                endforeach;
	                $arItem['CATALOG_QUANTITY'] = $quentity_product;
	            endif;
    ?>
    <div class="item col l3 <? if($arItem['OFFERS'] == 'Y' && $quentity_product > 0):?>with-offer<?endif;?>">
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
                <?if($arItem['CATALOG_QUANTITY'] != 0){?>
					
						<div class="product-price">
                            <?if($price != 0):?>
    							<?/*?>
    							<div class="old-price" ><i class="rouble">i</i></div>
    							<?*/?>
    							<!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->

    							<div class="price" id="price_<?=$arItemIDs['ADD_BASKET_LINK']?>" ><?=priceShow($price);?></div>
                            <?endif;?>
						</div>
					
                    <?
                        $addBasket = '';
                        if(!empty($arItem['OFFERS_LIST'])){$addBasket = 'add_basket(\''.$offers[0]['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}else{$addBasket = 'add_basket(\''.$arItem['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}
                    ?>

                    <span class="btn center  shopping-card btn-icon loader" id="loader-<? echo $arItemIDs['ADD_BASKET_LINK']; ?>" style="display:none;">
                            <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                    </span>
                    <a href="javascript:void(0);" onclick="<?=$addBasket?>" class="shopping-card btn btn-icon primary" id="<?=$arItemIDs['ADD_BASKET_LINK']?>">
                        <svg class="icon"><use xlink:href="#cart"/></svg>
                    </a>
                <?}else{?>
					
						<div class="product-price">
                            <?if($price != 0):?>
    							<?/*?>
    							<div class="old-price" ><i class="rouble">i</i></div>
    							<?*/?>
    							<!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->

    							<div class="price" id="price_<?=$arItemIDs['ADD_BASKET_LINK']?>" ><?=priceShow($price);?></div>
						    <?endif;?>
                        </div>
					
                    <a href="javascript:void(0);"  class="shopping-card btn btn-icon primary gray" id="<?=$arItemIDs['ADD_BASKET_LINK']?>">
                        <svg class="icon"><use xlink:href="#cart"/></svg>
                    </a>
                <?}?>
            </div>


 				<? if($arItem['OFFERS'] == 'Y' && $quentity_product > 0):?>
                    <!-- если есть -->
                    <div class="offer">
						<div class="table-field">
							<div class="label color-text text-light">Размер</div>
							<div class="field select-box hide-on-large-only">
								<select name="prod-size-sel" id="select_<?=$arItemIDs['ADD_BASKET_LINK']?>" onchange="select_prop('select_<?=$arItemIDs['ADD_BASKET_LINK']?>','<?=$arItemIDs['ADD_BASKET_LINK']?>','Y');" >
									 <?foreach($offers as $i=>$itemOffer):?>
                                        <option value="<?=$itemOffer['ID']?>" data-price="<?=$itemOffer['PRICE']?>" <?if($i==0):?>selected<?endif;?>><?=$itemOffer['OPTION'];?></option>
                                    <?endforeach;?>
								</select>
								<div class="triangle"></div>
							</div>
							<div class="field dropdown-box style-2 hide-on-med-and-down">
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
            $arCompare = $_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"];
            $key = array_search($arItem['ID'], array_column($arCompare, 'ID'));
            $countCompare = count($arCompare);
            ?>
            <div class="compare">
                <input type="checkbox" class="compare-input <?if(strlen($key) > 0 ){?>checked<?}else{?>no-check<?}?>" id="compare_today_<?=$arItem['ID'];?>" onclick="compare_product(<?=$arItem['ID'];?>,'<?=$arParams['COMPARE_PATH']?>');" <?if(strlen($key) > 0 ):?>checked<?endif?> <?if($countCompare>=5):?><?if(strlen($key) > 0 ){?><?}else{?>disabled<?}?><?endif;?>/>
                <label class="checkbox-lbl" for="compare_today_<?=$arItem['ID'];?>" onclick="compare_product_check(this)">Cравнить</label>
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
    <!--pagination-->
    <div class="pagination-<?=$arParams['ROUTE']?>">
        <?/*if($arResult['NAV_RESULT']->NavPageCount != $arResult['NAV_RESULT']->NavPageNomer){?>
            <span class="btn flat fullsize btn-more loader" style="display:none;">
                    <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                </span>
            <a class="btn flat fullsize btn-more" href="javascript:void(0);" onclick="ajax('<?=$arParams['ROUTE']?>','<?=$arParams['ROUTE_URL']?>',<?echo $arResult['NAV_RESULT']->NavPageNomer + 1?>,'<?=$arParams['ROUTE_PARAM']?>');return false;" >Показать еще</a>
        <?}*/?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
    <!--end pagination-->
<?
}