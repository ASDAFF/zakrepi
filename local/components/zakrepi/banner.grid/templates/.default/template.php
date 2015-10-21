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
if(!CModule::IncludeModule("bannergrid"))
    return;
?>
<div class="banner-box row">
    <?foreach ($arResult as $item):?>
        <?/*big*/?>
        <?if($item['SIZE']=='big'):?>
        <div class="<?=$item['STYLE']?>">
            <div class="banner <?=$item['SIZE_DIV']?>"><a href="<?=$item['LINK']?>" class="img-link"><img src="<?=$item['IMG_URL']?>" class="banner-img"/></a></div>
        </div>
        <?endif;?>

        <?/*medium*/?>
        <?if($item['SIZE']=='medium'):?>
            <div class="<?=$item['STYLE']?>">
                <div class="banner <?=$item['SIZE_DIV']?>"><a href="<?=$item['LINK']?>" class="img-link"><img src="<?=$item['IMG_URL']?>" class="banner-img"/></a></div>
            </div>
        <?endif;?>

        <?/*small*/?>
        <?if($item['SIZE']=='small'):?>
            <?if($item['NUM'] == 1):?>
                <div class="<?=$item['STYLE']?>">
            <?endif;?>
                <div class="banner <?=$item['SIZE_DIV']?>"><a href="<?=$item['LINK']?>" class="img-link"><img src="<?=$item['IMG_URL']?>" class="banner-img"/></a></div>
            <?if($item['NUM'] == 2):?>
                </div>
            <?endif;?>
        <?endif;?>

    <?endforeach;?>
</div>
