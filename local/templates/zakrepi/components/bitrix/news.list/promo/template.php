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
        <div class="action-item news-card col l6">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="img-link">
                <img class="item-img" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" />
                <div class="overlay"></div>
                <div class="item-terms"><?=Loc::getMessage('PROMO_DATE');?><?=$arItem['DATE_ACTIVE_PROMO']?></div>
                <div class="item-text">
                    <div class="item-title big-text"><?=$arItem['NAME']?></div>
                    <div class="preview-text medium-text"><?=$arItem['PREVIEW_TEXT']?></div>
                </div>
            </a>
        </div>
    <?endforeach;?>
    <div class="clearfix"></div>
    <!--pagination-->
    <div class="pagination-<?=$arParams['ROUTE']?>">
        <?if($arResult['NAV_RESULT']->NavPageCount != $arResult['NAV_RESULT']->NavPageNomer){?>
            <span class="btn flat fullsize btn-more loader" style="display:none;">
                <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
            </span>
            <a class="btn flat fullsize btn-more" href="javascript:void(0);" onclick="ajax('<?=$arParams['ROUTE']?>','<?=$arParams['ROUTE_URL']?>',<?echo $arResult['NAV_RESULT']->NavPageNomer + 1?>);return false;" >Показать еще</a>
        <?}?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
     <!--end pagination-->