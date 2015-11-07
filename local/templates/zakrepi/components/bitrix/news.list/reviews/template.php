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
                <div class="name medium-text"><?=$arItem['NAME']?></div>
                <div class="date light-color"><?=$arItem['DATE_ACTIVE']?></div>
                <div class="rating rate-2">
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                </div>
            </div>
            <div class="review-content col l9">
                <div class="subtitle">Достоинства:</div>
                <p>Пользуюсь год. Разбираю им машины. Крутит хорошо, без нареканий. Не понятно зачем нужен штифт, который вставляется в головку инструмента. Думаю, чтобы головка не слетала, хотя странное решение.</p>
                <div class="subtitle">Недостатки:</div>
                <p>Тяжелый и громоздкий. Подлезть куда то проблематично.</p>
                <div class="subtitle">Комментарий:</div>
                <p>Рекомендую. Не дорогой и надежный.</p>
            </div>
        </div>
    <?endforeach;?>
    <div class="clearfix"></div>
    <!--pagination-->
    <div class="pagination-<?=$arParams['ROUTE']?>">
        <?if($arResult['NAV_RESULT']->NavPageCount != $arResult['NAV_RESULT']->NavPageNomer){?>
            <span class="btn flat fullsize btn-more loader" style="display:none;">
                <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
            </span>
            <a class="btn flat fullsize btn-more" href="javascript:void(0);" onclick="ajax('<?=$arParams['ROUTE']?>','<?=$arParams['ROUTE_URL']?>',<?echo $arResult['NAV_RESULT']->NavPageNomer + 1?>,'<?=$arParams['ROUTE_PARAM']?>');return false;" >Показать еще</a>
        <?}?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
     <!--end pagination-->