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
<div class="brand-box">
    <ul class="brand-list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <li class="brand-item">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="brand-link img-link"><img class="brand-img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" /></a>
            </li>
        <?endforeach;?>
        <li class="brand-item">
            <a href="/brand/" class="brand-link">Все бренды</a>
        </li>
    </ul>
</div>