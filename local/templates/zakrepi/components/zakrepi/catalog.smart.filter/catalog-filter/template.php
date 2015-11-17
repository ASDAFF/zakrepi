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

/*$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);
*/
/*if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}*/
/*$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");*/

?>
<div class="filter">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>
        <ul class="filters-list collapsible" data-collapsible="expandable">

        <?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
        {
            $key = $arItem["ENCODED_ID"];
            if(isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    continue;

                $precision = 2;
                if (Bitrix\Main\Loader::includeModule("currency"))
                {
                    $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                    $precision = $res['DECIMALS'];
                }
                $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                $price_min = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                $price_max = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                ?>
                <li>
                    <div class="collapsible-header active">Цена</div>
                    <div class="collapsible-body">
                        <div class="collapsible-body-content">
                            <div class="range-field price">
                                <div class="price-min">
                                    <input
                                        class="min-value min-price inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"><?=$price_min?></label>
                                    <span class="lbl-text">от</span>
                                </div>
                                <div class="price-max">
                                    <input
                                        class="max-price max-value inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"><?=$price_max?></label>
                                    <span class="lbl-text">до</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?endif;
        }

        //not prices
        foreach($arResult["ITEMS"] as $key=>$arItem)
        {
            if(
                empty($arItem["VALUES"])
                || isset($arItem["PRICE"])
            )
                continue;

            if (
                $arItem["DISPLAY_TYPE"] == "A"
                && (
                    $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                )
            )
                continue;
            /*?>
            <div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
            <span class="bx_filter_container_modef"></span>
            <div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)"><span><?=$arItem["NAME"]?> <i data-role="prop_angle" class="fa fa-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>"></i></span></div>
            <?if ($arItem["FILTER_HINT"] <> ""):?>
                <div class="bx_filter_parameters_box_hint" id="item_title_hint_<?echo $arItem["ID"]?>"></div>
                <script type="text/javascript">
                    new top.BX.CHint({
                        parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
                        show_timeout: 10,
                        hide_timeout: 200,
                        dx: 2,
                        preventHide: true,
                        min_width: 250,
                        hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
                    });
                </script>
            <?endif?>
            <div class="bx-filter-block" data-role="bx_filter_block">
            <div class="bx-filter-parameters-box-container">
            <?*/?>

            <?
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"])
            {
                case "A"://NUMBERS_WITH_SLIDER

                    $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                    $value_min = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                    $value_max = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                    ?>
                    <li>
                    <div class="collapsible-header"><?=$arItem['NAME']?></div>
                    <div class="collapsible-body">
                        <div class="collapsible-body-content">
                            <div class="range-field price">
                                <div class="price-min">
                                    <input
                                        class="min-value inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"><?=$value_min?></label>
                                    <span class="lbl-text">от</span>
                                </div>
                                <div class="price-max">
                                    <input
                                        class="max-value inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"><?=$value_max?></label>
                                    <span class="lbl-text">до</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    <?
                    break;
                case "B"://NUMBERS
                    ?>
                    <li>
                    <div class="collapsible-header"><?=$arItem['NAME']?></div>
                    <div class="collapsible-body">
                        <div class="collapsible-body-content">
                            <div class="range-field price">
                                <div class="price-min">
                                    <input
                                        class="min-value inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"><?=$value_min?></label>
                                    <span class="lbl-text">от</span>
                                </div>
                                <div class="price-max">
                                    <input
                                        class="max-value inputtext-small"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                        />
                                    <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"><?=$value_max?></label>
                                    <span class="lbl-text">до</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </li>
                    <?
                    break;
                case "G"://CHECKBOXES_WITH_PICTURES
                   /* ?>

                    <?*/
                    break;
                case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                    /*?>

                    <?*/
                    break;
                case "P"://DROPDOWN
                   /* $checkedItemExist = false;
                    ?>

                    <?*/
                    break;
                case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                   /* ?>

                    <?*/
                    break;
                case "K"://RADIO_BUTTONS
                    ?>
                    <li>
                    <div class="collapsible-header"><?=$arItem['NAME']?></div>
                    <div class="radio">
                        <label class="bx_filter_param_label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
											<span class="bx_filter_input_checkbox">
												<input
                                                    type="radio"
                                                    value=""
                                                    name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                    id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                    onclick="smartFilter.click(this)"
                                                    />
												<span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
											</span>
                        </label>
                    </div>
                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                    <div class="radio">
                        <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
												<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
													<input
                                                        type="radio"
                                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                        name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                        onclick="smartFilter.click(this)"
                                                        />
													<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                            ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                        endif;?></span>
												</span>
                        </label>
                    </div>
                    </li>
                <?endforeach;?>
                    <?
                    break;
                case "U"://CALENDAR
                   /* ?>

                    <?*/
                    break;
                default://CHECKBOXES
                    ?>
                        <?$data_show = 5;?>
                    <?
                        /*Поиск checked элментов*/
                        $key = array_search(1, array_column($arItem["VALUES"], 'CHECKED'));
                    ?>
                        <li>
                        <div class="collapsible-header <?if(strlen($key) > 0 ){?>active<?}?>"><?=$arItem['NAME']?></div>
                        <div class="collapsible-body">
                            <!-- если больше, чем data-show - .toggle-content-box, data-show - нужное количество, чтоб можно было настраивать в настройках компонента/фильтра, data-state - состояние по умолчанию (less/more) -->
                            <div class="collapsible-body-content toggle-content-box" data-show="<?=$data_show?>" data-state="less">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <p class="range-field">
                                    <input
                                        type="checkbox"
                                        value="<? echo $ar["HTML_VALUE"] ?>"
                                        name="<? echo $ar["CONTROL_NAME"] ?>"
                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                        class="custom"
                                        onclick="smartFilter.click(this)"
                                        />
                                    <label class="checkbox-lbl" for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?> <? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])): echo '('.$ar["ELEMENT_COUNT"].')'; endif;?></label>
                                </p>
                            <?endforeach;?>
                                <?if(count($arItem["VALUES"]) > $data_show):?>
                                    <div class="show-buttons">
                                        <button class="btn-link show-more">Показать все</button>
                                        <button class="btn-link show-less">Свернуть</button>
                                    </div>
                                <?endif;?>
                            </div>
                        </div>
                    </li>
                    <?
            }
        }
        ?>
        </ul>
        <div class="actions">
            <div style="display: inline-block;    width: 100%;">
            <input
                class="btn btn-themes left primary"
                type="submit"
                id="set_filter"
                name="set_filter"
                value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
                />
            <input
                style="width:110px;"
                class="btn standart-color mediumsize right"
                type="submit"
                id="del_filter"
                name="del_filter"
                value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
                />
            </div>
            <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                <span class="arrow"></span>
                <br/>
                <a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
            </div>
        </div>
    </form>
</div>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>