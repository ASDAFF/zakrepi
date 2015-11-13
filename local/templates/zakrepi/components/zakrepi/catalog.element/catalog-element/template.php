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
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
    'FAVORITE_ID' => $strMainID.'_favorite_id',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?>

<div class="product-page row">
<div class="col l12">
    <div class="main-info clearfix">
        <div class="col l9">
            <div class="card-header">
                <?/*name product*/?>
                <h1 class="product-title col l11"><?
                    echo (
                    isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                        ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                        : $arResult["NAME"]
                    ); ?></h1>
                <?/*end name product*/?>

                <?
                    $addFavorite = '';
                    if($USER->IsAuthorized()) {
                        if (!empty($arResult['OFFERS'])) {
                            $addFavorite = 'favorite_product(\'' . $arResult['OFFERS'][0]['ID'] . '\')';
                        } else {
                            $addFavorite = 'favorite_product(\'' . $arResult['ID'] . '\')';
                        }
                    }
                    else{
                        $addFavorite = 'showPopupAuthorized();';
                    }
                ?>
                <?/*add in favorite*/?>
                <div class="col l1 right-align no-padding">
                    <a href="javascript:void(0);" id="favorite-<?=$arItemIDs['ADD_BASKET_LINK']?>" onclick="<?=$addFavorite?>" class="btn btn-favorite btn-icon"><svg class="icon"><use xlink:href="#heart"/></svg></a>
                </div>
                <?/*end add in favorite*/?>
                <div class="clearfix"></div>

                <?/*rating*/?>
                <? $rating = ceil($arResult['DISPLAY_PROPERTIES']['rating']['DISPLAY_VALUE']);?>
                <div class="rating rate-<?=$rating?>">
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                </div>
                <?/*end rating*/?>

                <?/*articul*/?>
                <?if($arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['DISPLAY_VALUE']!=''):?>
                    <div class="articul"><?=$arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['NAME']?>: <?=$arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['DISPLAY_VALUE']?></div>
                <?endif;?>
                <?/*end articul*/?>
            </div>

            <?/*images*/?>
            <div class="product-imgs row">
                    <?/*small carousel images*/?>
                        <div class="thumbs carousel-box vertical col">


                        <?
                        if ($arResult['SHOW_SLIDER'])
                        {
                            if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
                            {
                                if (5 < $arResult['MORE_PHOTO_COUNT'])
                                {
                                    $strOneWidth = (100/$arResult['MORE_PHOTO_COUNT']).'%';
                                    $strWidth = (20*$arResult['MORE_PHOTO_COUNT']).'%';
                                }
                                else
                                {
                                    $strOneWidth = '20%';
                                    $strWidth = '100%';
                                }
                                ?>
                                <div class="carousel">
                                    <div class="carousel-inner">
                                        <?
                                        if(count($arResult['MORE_PHOTO'])>1) {
                                            foreach ($arResult['MORE_PHOTO'] as $i => &$arOnePhoto) {
                                                ?>
                                                <a class="item thumb-link img-link center-align <? if ($i == 0): ?>active<? endif; ?>"
                                                   href="<? echo $arOnePhoto['SRC']; ?>">
                                                    <img class="thumb-img" src="<? echo $arOnePhoto['SRC']; ?>"/>
                                                </a>
                                            <?
                                            }
                                            unset($arOnePhoto);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?if(count($arResult['MORE_PHOTO'])>3):?>
                                <div class="carousel-controlls">
                                    <button class="prev"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
                                    <button class="next"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
                                </div>
                                <?endif;?>
                            <?
                            }
                            else
                            {
                                foreach ($arResult['OFFERS'] as $key => $arOneOffer)
                                {
                                    if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
                                        continue;
                                    if (5 < $arOneOffer['MORE_PHOTO_COUNT'])
                                    {
                                        $strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
                                        $strWidth = (20*$arOneOffer['MORE_PHOTO_COUNT']).'%';
                                    }
                                    else
                                    {
                                        $strOneWidth = '20%';
                                        $strWidth = '100%';
                                    }
                                    ?>
                                    <div class="carousel">
                                        <div class="carousel-inner">
                                            <?
                                            if(count($arResult['MORE_PHOTO'])>1) {
                                                foreach ($arOneOffer['MORE_PHOTO'] as $i => &$arOnePhoto) {
                                                    ?>
                                                    <a class="item thumb-link img-link center-align <? if ($i == 0): ?>active<? endif; ?>"
                                                       href="<? echo $arOnePhoto['SRC']; ?>">
                                                        <img class="thumb-img" src="<? echo $arOnePhoto['SRC']; ?>"/>
                                                    </a>
                                                <?
                                                }
                                                unset($arOnePhoto);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?if(count($arResult['MORE_PHOTO'])>3):?>
                                        <div class="carousel-controlls">
                                            <button class="prev"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
                                            <button class="next"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
                                        </div>
                                    <?endif;?>
                                <?
                                }
                            }
                        }
                        ?>
                    </div>
                    <?/*end small carousel images*/?>
                <?/*big image*/?>
                <?
                    reset($arResult['MORE_PHOTO']);
                    $arFirstPhoto = current($arResult['MORE_PHOTO']);
                ?>
                <div class="full-img col"><img id="<? echo $arItemIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>"></div>
                <?/*end big image*/?>
            </div>
            <?/*end images*/?>

        </div>
        <div class="col l3 no-padding">
            <div class="action-panel">

                <?/*price*/?>
                <div class="product-price center-align">
                    <?
                        $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                        $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                    ?>
                    <!-- если скидки нет, .old-price не выводить -->
                    <?if($boolDiscountShow):?>
                        <div class="old-price"><?=priceShow($minPrice['VALUE']);?></div>
                    <?endif;?>
                    <div class="price" id="price_<?=$arItemIDs['ADD_BASKET_LINK']?>"><?=priceShow($minPrice['DISCOUNT_VALUE']);?></div>
                </div>
                <?/*end price*/?>

                <?/*options product*/?>
                <?if(!empty($arResult['OFFERS'])):?>

                    <?
                    $offers = array();
                    foreach($arResult['OFFERS'] as $i=>$itemOffer):
                        $minPrice = (isset($itemOffer['RATIO_PRICE']) ? $itemOffer['RATIO_PRICE'] : $itemOffer['MIN_PRICE']);
                        $option = '';
                        foreach($itemOffer['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $a=>$item):
                            if($a==0){ $option .= $item;}
                            else{$option .= ' '.$item;}
                        endforeach;
                        $offers[$i]['ID'] = $itemOffer['ID'];
                        $offers[$i]['PRICE'] = $minPrice['VALUE'];
                        $offers[$i]['OPTION'] = $option;

                        $offers[$i]['CATALOG_PRICE_1'] = $itemOffer['CATALOG_PRICE_1'];
                        $offers[$i]['CATALOG_PRICE_ID_1'] = $itemOffer['CATALOG_PRICE_ID_1'];
                        $offers[$i]['NAME'] = $itemOffer['NAME'];
                    endforeach;?>

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
                                    <input type="radio" class="dropdown-inp" name="prod-size" value="<?=$itemOffer['ID']?>" id="prod-size-rad-v<?=$i?>" <?if($i==0):?>checked="checked"<?endif;?> data-value-text="<?=$itemOffer['OPTION'];?>"/>
                                    <label class="dropdown-title" for="prod-size-rad-v<?=$i?>">
                                        <div class="item-text"><?=$itemOffer['OPTION'];?></div>
                                    </label>
                                </li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?/*end options product*/?>
                <?endif;?>
                <?/*add basket*/?>
                <div class="action-buttons">
                    <?
                        $addBasket = '';
                        if(!empty($arResult['OFFERS'])){$addBasket = 'add_basket(\''.$offers[0]['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}else{$addBasket = 'add_basket(\''.$arResult['ID'].'\',\''.$arItemIDs['ADD_BASKET_LINK'].'\')';}
                    ?>
                    <span class="btn center fullwidth loader" id="loader-<? echo $arItemIDs['ADD_BASKET_LINK']; ?>" style="display:none;">
                        <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                    </span>
                    <a class="btn primary center fullwidth" href="javascript:void(0);" id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>" onclick="<?=$addBasket?>">В корзину</a>
                    <a class="btn standart-color center fullwidth" href="javascript:void(0);" onclick="buyInOneClick(<?=$arResult['ID']?>);">Купить в 1 клик</a>
                </div>
                <?/*end add basket*/?>

                <?/*delevery*/?>
                <div class="delivery-text">
                    <table>
                        <tr><td>Самовывоз:</td><td>Сегодня, Бесплатно</td></tr>
                        <tr><td>Доставим:</td><td>5 сентября, 8 699<i class="rouble">i</i></td></tr>
                    </table>
                </div>
                <?/*end delevery*/?>

                <?/*add compare*/?>
                <?
                    /*Проверяем добавлен ли этот товар в сравнение и сколько товаров добавлено в сравение*/
                    /*
                     * массив списка сравнений SESSION["имя списка сравниваемых элементов"]["ID информационного блока"]["ITEMS"]["ID элемента"] = $arElement;
                     */
                    $arCompare = $_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"];
                    $key = array_search($arResult['ID'], array_column($arCompare, 'ID'));
                ?>
                <div class="compare">
                    <input type="checkbox" id="compare_today_<?=$arResult['ID'];?>" onchange="compare_product(<?=$arResult['ID'];?>,'<?=$arParams['COMPARE_PATH']?>');" <?if(strlen($key) > 0 ):?>checked<?endif?>/>
                    <label class="checkbox-lbl" for="compare_today_<?=$arResult['ID'];?>">Cравнить</label>
                </div>
                <?/*end add compare*/?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>


<?/*more info and tabs*/?>
<div class="more-info full-width tabs">
<div class="tab-header"><div class="container">
        <ul class="tab-header-list">
            <li class="tab-header-item active">
                <a class="tab-link" href="#desc">Обзор товара</a>
            </li>
            <?/*Если больше 5 добавляем возможность посмотреть все характеристики*/?>
            <?if(count($arResult['DISPLAY_PROPERTIES']['OPTIONS_ALL_ELEMENT'])>5):?>
            <li class="tab-header-item">
                <a class="tab-link" href="#<?=$arParams['ROUTE_TECH']?>" onclick="ajax_more_information_product('<?=$arResult['ID']?>','<?=$arParams['ROUTE_TECH']?>','<?=$arParams['ROUTE_TECH_URL']?>')">Технические характеристики</a>
            </li>
            <?endif;?>

            <?if(!empty($arResult['WITH_PRODUCTS'])):?>
            <li class="tab-header-item">
                <a class="tab-link" href="#accs">Аксессуары</a>
            </li>
            <?endif;?>
            <li class="tab-header-item">
                <a class="tab-link" href="#<?=$arParams['ROUTE_REVIEWS']?>" onclick="ajax_more_information_product('<?=$arResult['ID']?>','<?=$arParams['ROUTE_REVIEWS']?>','<?=$arParams['ROUTE_REVIEWS_URL']?>')">Отзывы о товаре</a>
            </li>
            <li class="tab-header-item">
                <a class="tab-link"href="#<?=$arParams['ROUTE_STORE']?>" onclick="ajax_more_information_product('<?=$arResult['ID']?>','<?=$arParams['ROUTE_STORE']?>','<?=$arParams['ROUTE_STORE_URL']?>')">Наличие в магазинах</a>
            </li>
        </ul></div>
</div>
<div class="tab-content">
<div class="tab-content-item" id="desc">
    <div class="container">
        <div class="subtitle">Описание</div>
        <div class="desc-text col l9 no-padding nofloat">
            <?/*detail text*/?>
            <?
            if ('' != $arResult['DETAIL_TEXT'])
            {
                ?>
                    <?
                    if ('html' == $arResult['DETAIL_TEXT_TYPE'])
                    {
                        echo $arResult['DETAIL_TEXT'];
                    }
                    else
                    {
                        ?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
                    }
                    ?>
            <?
            }
            ?>
            <?/*end detail text*/?>

            <?/*options 5 element*/?>
            <div class="table col l5 nofloat no-padding">
                <?foreach($arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'] as $item):?>
                    <div class="table-row no-padding col l12">
                        <div class="table-col col l7"><?=$item['DESCRIPTION']?></div>
                        <div class="table-col col l5"><?=$item['VALUE']?></div>
                    </div>
                <?endforeach;?>

                <?/*Если больше 5 добавляем возможность посмотреть все характеристики*/?>
                <?if(count($arResult['DISPLAY_PROPERTIES']['OPTIONS_ALL_ELEMENT'])>5):?>
                    <a class="tab-link"  href="#<?=$arParams['ROUTE_TECH']?>" onclick="ajax_more_information_product('<?=$arResult['ID']?>','<?=$arParams['ROUTE_TECH']?>','<?=$arParams['ROUTE_TECH_URL']?>')">Посмотреть все характеристики</a>
                <?endif;?>
            </div>
            <?/*end options 5 element*/?>

            <?/*seo text*/?>
            <p><?=$arResult['PROPERTY_DESCRIPTION_VALUE']['ELEMENT_META_DESCRIPTION']?></p>
            <?/*end seo text*/?>

            <?/*
                <a href="#">Посмотреть все Гайковерты Hitachi </a>
            */?>
        </div>
    </div>
</div>
<?
/*
 * Если больше 5 добавляем возможность посмотреть все характеристики
 * Выводим технические характеристики
 * */
?>
<?if(count($arResult['DISPLAY_PROPERTIES']['OPTIONS_ALL_ELEMENT'])>5):?>
<div class="tab-content-item" id="<?=$arParams['ROUTE_TECH']?>">
    <div class="container">
        <?=loader($arParams['ROUTE_TECH']);?>
        <?
        /*
         * Технические характеристики берутся из файла по пути $arParams['ROUTE_TECH_URL']
         * Там же строятся все параметры
         */
        ?>
        <?/*all options element*/?>
         <div id="route-<?=$arParams['ROUTE_TECH']?>"></div>
        <?/*end all options element*/?>
    </div>
</div>
<?endif;?>


<?if(!empty($arResult['WITH_PRODUCTS'])):?>
<div class="tab-content-item" id="accs">
    <div class="container">
        <div class="row">
            <div class="col l3">
                <ul class="menu sidebar-menu">
                    <li class="menu-item active"><a href="#" class="menu-link">Все</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Сверла и биты</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Головки торцевые</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Системы хранения</a></li>
                    <li class="menu-item"><a href="#" class="menu-link">Средства защиты</a></li>
                </ul>
            </div>
            <div class="col l9 catalog no-padding" ng-controller="CatalogProductsCtrl">
                <div class="product-list clearfix">
                    <div class="item col l3" ng-repeat="product in products | orderBy:sort:true">
                        <div class="product-card">
                            <div class="product-info">
                                <a class="item-img" href="product__single.php" style="background-image:url({{product.image}});"></a>
                                <div class="item-name"><a href="product__single.php">{{product.name}}</a></div>
                                <div ng-class="'rating rate-'+product.rating">
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                </div>
                                <div class="product-price">
                                    <div class="old-price" ng-if="product.oldprice">{{product.oldprice}} <i class="rouble">i</i></div>
                                    <!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->
                                    <div class="price">{{product.price}} <i class="rouble">i</i></div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?endif;?>

<div class="tab-content-item" id="<?=$arParams['ROUTE_REVIEWS']?>">
    <div class="container" id="reviews-res">
        <?=loader($arParams['ROUTE_REVIEWS']);?>
        <?
        /*
         * Технические характеристики берутся из файла по пути $arParams['ROUTE_TECH_URL']
         * Там же строятся все параметры
         */
        ?>
        <?/*comments*/?>
        <div id="route-<?=$arParams['ROUTE_REVIEWS']?>"></div>
        <?/*end comments*/?>
    </div>
    <?/*form*/?>
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/product/reviews/form.php');?>
    <?/*end form*/?>

</div>
<div class="tab-content-item" id="<?=$arParams['ROUTE_STORE']?>">
    <div class="container">
        <?=loader($arParams['ROUTE_STORE']);?>
        <?/*store*/?>
        <div id="route-<?=$arParams['ROUTE_STORE']?>"></div>
        <?/*end store*/?>
    </div>
</div>
</div>
</div>
<?/*end more info and tabs*/?>
</div>


<?/*with this product bought*/?>
<?if(!empty($arResult['WITH_PRODUCTS'])):?>
    <div class="tab-hide-box" data-hide-id="#accs">
        <div class="subtitle">Вместе с этим товаром покупают</div>
        <div class="product-carousel carousel-box" ng-controller="CatalogProductsCtrl">
            <div class="carousel row" data-jcarouselautoscroll="true" data-target="+=4" data-wrap="circular" data-interval="5000">
                <div class="carousel-inner product-list clearfix">
                    <div class="item col l3" ng-repeat="product in products | orderBy:sort:true">
                        <div class="product-card">
                            <div class="product-info">
                                <a class="item-img" href="#" style="background-image:url({{product.image}});"></a>
                                <div class="item-name"><a href="#">{{product.name}}</a></div>
                                <div ng-class="'rating rate-'+product.rating">
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                    <svg class="star"><use xlink:href="#star"/></svg>
                                </div>
                                <div class="product-price">
                                    <div class="old-price" ng-if="product.oldprice">{{product.oldprice}} <i class="rouble">i</i></div>
                                    <div class="price">{{product.price}} <i class="rouble">i</i></div>
                                </div>
                                <a href="#" class="shopping-card btn btn-icon primary">
                                    <svg class="icon"><use xlink:href="#cart"/>
                                </a>
                            </div>
                            <div class="compare">
                                <input type="checkbox" id="compare_today_{{product.id}}" />
                                <label class="checkbox-lbl" for="compare_today_{{product.id}}">Cравнить</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-controlls">
                <button class="prev" data-target="-=4"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
                <button class="next" data-target="+=4"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
            </div>
        </div>
    </div>
<?endif;?>
<?/*end with this product bought*/?>



    <div class="one-click-form-box modal" id="one-click-form_product-id">
        <button class="btn-close-modal btn btn-icon btn-close"><svg class="icon"><use xlink:href="#cross"/></svg></button>
        <div class="modal-content">
            <input type="hidden" name="PRODUCT_ID" value=""/>
            <div class="title">Купить в 1 клик</div>
            <p class="note-text">Укажите Ваши данные, и наш менеджер свяжется с Вами для оформления заказа.</p>
            <div class="table-field">
                <span class="label">Имя</span>
                <div class="field"><input type="text" name="NAME"/></div>
            </div>
            <div class="table-field">
                <span class="label">Телефон</span>
                <div class="field"><input type="tel" name="phone"/></div>
            </div>
            <div class="table-field time-field">
                <span class="label">Удобное время для звонка:</span>
                <div class="first-field">
                    <input type="radio" name="time" value="v1" id="time-v1"/>
                    <label class="radio-lbl" for="time-v1">8:00 - 12:00</label>
                </div>
                <div class="field">
                    <input type="radio" checked name="time" value="v2" id="time-v2"/>
                    <label class="radio-lbl" for="time-v2">12:00 - 18:00</label>
                </div>
            </div>
            <button class="btn primary big bigsize center">Купить</button>
        </div>
    </div>

<?/*
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
	BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>
*/?>