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
use Bitrix\Main\Localization\Loc;
?>

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="review-item row">
            <div class="review-info col l3">
                <div class="name medium-text"><?=$arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']?></div>
                <div class="date light-color"><?=$arItem['DATE_ACTIVE']?></div>
                <div class="rating rate-<?=$arItem['DISPLAY_PROPERTIES']['RATING']['VALUE']?>">
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                </div>
            </div>
            <div class="review-content col l9">
                <div class="subtitle">Достоинства:</div>
                <p><?=$arItem['DISPLAY_PROPERTIES']['BENEFITS']['VALUE']['TEXT']?></p>
                <div class="subtitle">Недостатки:</div>
                <p><?=$arItem['DISPLAY_PROPERTIES']['DISADVANTAGES']['VALUE']['TEXT']?></p>
                <div class="subtitle">Комментарий:</div>
                <p><?=$arItem['DISPLAY_PROPERTIES']['COMMENT']['VALUE']['TEXT']?></p>
            </div>
        </div>
    <?endforeach;?>

    <div class="clearfix"></div>
    <?if(!empty($arResult["ITEMS"])):?>
        <!--pagination-->
        <div class="pagination-<?=$arParams['ROUTE']?>">
            <?if($arResult['NAV_RESULT']->NavPageCount != $arResult['NAV_RESULT']->NavPageNomer){?>
                <span class="btn flat fullsize btn-more loader" style="display:none;">
                    <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                </span>
                <div class="center-align">
                    <a class="btn standart-color btn-toggle-block btn-more" href="javascript:void(0);" onclick="ajax('<?=$arParams['ROUTE']?>','<?=$arParams['ROUTE_URL']?>',<?echo $arResult['NAV_RESULT']->NavPageNomer + 1?>,'<?=$arParams['ROUTE_PARAM']?>');return false;" >Показать еще</a>
                </div>
            <?}?>
            <?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <br /><?=$arResult["NAV_STRING"]?>
            <?endif;*/?>
        </div>
         <!--end pagination-->
    <?endif;?>