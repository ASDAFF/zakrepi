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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?if($arResult["bDescPageNumbering"] === true):?>

	<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?><br /></font>

	<font class="text">

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>
			|
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
			|
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			|
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
				|
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
				|
			<?endif?>
		<?endif?>
	<?else:?>
		<?=GetMessage("nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("nav_prev")?>&nbsp;|
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<b><?=$NavRecordGroupPrint?></b>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	|

	<?if ($arResult["NavPageNomer"] > 1):?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_next")?></a>
		|
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>
	<?else:?>
		<?=GetMessage("nav_next")?>&nbsp;|&nbsp;<?=GetMessage("nav_end")?>
	<?endif?>

<?else:?>
   <? // to show always first and last pages
    $arResult["nStartPage"] = 1;
    $arResult["nEndPage"] = $arResult["NavPageCount"];

    $sPrevHref = '';
    if ($arResult["NavPageNomer"] > 1)
    {
    $bPrevDisabled = false;

    if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
    {
    $sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
    }
    else
    {
    $sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
    }
    }
    else
    {
    $bPrevDisabled = true;
    }

    $sNextHref = '';
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
    {
    $bNextDisabled = false;
    $sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
    }
    else
    {
    $bNextDisabled = true;
    }
    ?>

    <div class="pagination-box">
        <ul class="pagination">
            <?if ($arResult["NavPageNomer"] > 1):?>
                <li class="pagin-prev"><a class="prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><svg class="icon"><use xlink:href="#arrow"/></svg></a></li>
            <?else:?>
                <li class="pagin-prev"><span class="prev disabled"><svg class="icon"><use xlink:href="#arrow"/></svg></span></li>
            <?endif;?>

            <?
            $bFirst = true;
            $bPoints = false;
            $first = 1;
            do
            {
                if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
                {

                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                        ?>
                        <li class="pagin-item <?if($first==1):?>first<?$first++;endif;?> <?if($arResult["nStartPage"]==$arResult['nEndPage']):?>last<?endif;?>"><span class="pagin-link active" href="#"><?=$arResult["nStartPage"]?></span></li>
                    <?
                    elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
                        ?>
                        <li class="pagin-item <?if($first==1):?>first<?$first++;endif;?> <?if($arResult["nStartPage"]==$arResult['nEndPage']):?>last<?endif;?>"><a class="pagin-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
                    <?
                    else:
                        ?>
                        <li class="pagin-item <?if($first==1):?>first<?$first++;endif;?> <?if($arResult["nStartPage"]==$arResult['nEndPage']):?>last<?endif;?>"><a class="pagin-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
                    <?
                    endif;
                    $bFirst = false;
                    $bPoints = true;
                }
                else
                {
                    if ($bPoints)
                    {
                        ?><li class="pagin-item more"><span class="pagin-link">...</span></li><?
                        $bPoints = false;
                    }
                }
                $arResult["nStartPage"]++;
            } while($arResult["nStartPage"] <= $arResult["nEndPage"]);?>
            <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                <li class="pagin-next"><a class="next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><svg class="icon"><use xlink:href="#arrow"/></svg></a></li>
            <?else:?>
                <li class="pagin-next"><span class="next disabled"><svg class="icon"><use xlink:href="#arrow"/></svg></span></li>
            <?endif?>
        </ul>
    </div>

<?endif?>
<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>
<?endif?>