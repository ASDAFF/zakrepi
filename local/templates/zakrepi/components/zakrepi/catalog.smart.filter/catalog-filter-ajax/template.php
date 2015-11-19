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
<div class="bx_filter filter">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>
        <?
            $active_elements = 5;
            $countActive = 0;
        ?>
        <ul class="filters-list collapsible" data-collapsible="expandable">
        <?
        //prices
        foreach($arResult["ITEMS"] as $key=>$arItem)
        {
        $key = $arItem["ENCODED_ID"];
            if(isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                continue;
        ?>
            <?
                if(is_positive_int($arItem["VALUES"]["MIN"]["VALUE"]))
                    $price_min = number_format($arItem["VALUES"]["MIN"]["VALUE"],0,'',' ');
                else
                    $price_min = number_format($arItem["VALUES"]["MIN"]["VALUE"],2,'',' ');

                if(is_positive_int($arItem["VALUES"]["MIN"]["VALUE"]))
                    $price_max = number_format($arItem["VALUES"]["MAX"]["VALUE"],0,'',' ');
                else
                    $price_max = number_format($arItem["VALUES"]["MAX"]["VALUE"],2,'',' ');
            ?>
            <li>
                <div class="collapsible-header <?if($countActive <= $active_elements):?>active<?$countActive++; endif;?>">Цена</div>
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
                                <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"><?=$price_min?></label>
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
                                <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"><?=$price_max?></label>
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
            ?>
            <?
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"])
            {
                case "A"://NUMBERS_WITH_SLIDER
                    $value_min = $arItem["VALUES"]["MIN"]["VALUE"];
                    $value_max = $arItem["VALUES"]["MAX"]["VALUE"];
                    ?>
                    <li>
                        <div class="collapsible-header <?if($countActive <= $active_elements):?>active<?$countActive++; endif;?>"><?=$arItem['NAME']?></div>
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
                                        <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"><?=$value_min?></label>
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
                                        <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"><?=$value_max?></label>
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
                        <div class="collapsible-header <?if($countActive <= $active_elements):?>active<?$countActive++; endif;?>"><?=$arItem['NAME']?></div>
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
                                        <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"><?=$value_min?></label>
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
                                        <label class="textfield-placeholder" for="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"><?=$value_max?></label>
                                        <span class="lbl-text">до</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?
                    break;
                case "G"://CHECKBOXES_WITH_PICTURES
                    ?>
                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                        <input
                            style="display: none"
                            type="checkbox"
                            name="<?=$ar["CONTROL_NAME"]?>"
                            id="<?=$ar["CONTROL_ID"]?>"
                            value="<?=$ar["HTML_VALUE"]?>"
                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                        <?
                        $class = "";
                        if ($ar["CHECKED"])
                            $class.= " active";
                        if ($ar["DISABLED"])
                            $class.= " disabled";
                        ?>
                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label dib<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
                                            <span class="bx_filter_param_btn bx_color_sl">
                                                <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                    <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                <?endif?>
                                            </span>
                        </label>
                        <?endforeach?>
                    <?
                    break;
                case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                    ?>
                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                    <input
                        style="display: none"
                        type="checkbox"
                        name="<?=$ar["CONTROL_NAME"]?>"
                        id="<?=$ar["CONTROL_ID"]?>"
                        value="<?=$ar["HTML_VALUE"]?>"
                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                        />
                    <?
                    $class = "";
                    if ($ar["CHECKED"])
                        $class.= " active";
                    if ($ar["DISABLED"])
                        $class.= " disabled";
                    ?>
                    <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
										</span>
										<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                            endif;?></span>
                    </label>
                <?endforeach?>
                    <?
                    break;
                case "P"://DROPDOWN
                    $checkedItemExist = false;
                    ?>
                    <div class="bx_filter_select_container">
                        <div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                            <div class="bx_filter_select_text" data-role="currentOption">
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar)
                                {
                                    if ($ar["CHECKED"])
                                    {
                                        echo $ar["VALUE"];
                                        $checkedItemExist = true;
                                    }
                                }
                                if (!$checkedItemExist)
                                {
                                    echo GetMessage("CT_BCSF_FILTER_ALL");
                                }
                                ?>
                            </div>
                            <div class="bx_filter_select_arrow"></div>
                            <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                                />
                            <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                    />
                            <?endforeach?>
                            <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
                                <ul>
                                    <li>
                                        <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                            <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                        </label>
                                    </li>
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar):
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " selected";
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        ?>
                                        <li>
                                            <label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
                                        </li>
                                    <?endforeach?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?
                    break;
                case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                    ?>
                    <div class="bx_filter_select_container">
                        <div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                            <div class="bx_filter_select_text" data-role="currentOption">
                                <?
                                $checkedItemExist = false;
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    if ($ar["CHECKED"])
                                    {
                                        ?>
                                        <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                        <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                    <?endif?>
                                        <span class="bx_filter_param_text">
														<?=$ar["VALUE"]?>
													</span>
                                        <?
                                        $checkedItemExist = true;
                                    }
                                endforeach;
                                if (!$checkedItemExist)
                                {
                                    ?><span class="bx_filter_btn_color_icon all"></span> <?
                                    echo GetMessage("CT_BCSF_FILTER_ALL");
                                }
                                ?>
                            </div>
                            <div class="bx_filter_select_arrow"></div>
                            <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                                />
                            <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<?=$ar["HTML_VALUE_ALT"]?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                    />
                            <?endforeach?>
                            <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none">
                                <ul>
                                    <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                        <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                            <span class="bx_filter_btn_color_icon all"></span>
                                            <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                        </label>
                                    </li>
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar):
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " selected";
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        ?>
                                        <li>
                                            <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
                                                <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                    <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                <?endif?>
                                                <span class="bx_filter_param_text">
															<?=$ar["VALUE"]?>
														</span>
                                            </label>
                                        </li>
                                    <?endforeach?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?
                    break;
                case "K"://RADIO_BUTTONS
                    ?>

                    <li>
                    <div class="collapsible-header <?if($countActive <= $active_elements):?>active<?$countActive++; endif;?>"><?=$arItem['NAME']?></div>
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
                        <?endforeach;?>
                    </div>
                    </li>
                    <?
                    break;
                case "U"://CALENDAR
                    ?>
                    <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                            <?$APPLICATION->IncludeComponent(
                                'bitrix:main.calendar',
                                '',
                                array(
                                    'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                    'SHOW_INPUT' => 'Y',
                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                    'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                    'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                    'SHOW_TIME' => 'N',
                                    'HIDE_TIMEBAR' => 'Y',
                                ),
                                null,
                                array('HIDE_ICONS' => 'Y')
                            );?>
                        </div></div>
                    <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                            <?$APPLICATION->IncludeComponent(
                                'bitrix:main.calendar',
                                '',
                                array(
                                    'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                    'SHOW_INPUT' => 'Y',
                                    'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                    'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                    'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                    'SHOW_TIME' => 'N',
                                    'HIDE_TIMEBAR' => 'Y',
                                ),
                                null,
                                array('HIDE_ICONS' => 'Y')
                            );?>
                        </div></div>
                    <?
                    break;
                default://CHECKBOXES
                    ?>
                    <?$data_show = 5;?>
                        <li>
                            <div class="collapsible-header  <?if($countActive <= $active_elements):?>active<?$countActive++; endif;?> <?if($arItem["DISPLAY_EXPANDED"]):?>active<?endif?>"><?=$arItem['NAME']?></div>
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
                                                <? echo $ar["DISABLED"] ? 'disabled="disabled"': '' ?>
                                                onclick="smartFilter.click(this)"
                                                />
                                            <label class="checkbox-lbl" data-role="label_<?=$ar["CONTROL_ID"]?>" for="<? echo $ar["CONTROL_ID"] ?>">
                                                <?=$ar["VALUE"];?>
                                                <? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?> <span data-role="count_<?=$ar["CONTROL_ID"]?>">(<?echo $ar["ELEMENT_COUNT"]?>)</span><? endif;?>
                                            </label>
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
            ?>
        <?
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
<?/*?>
<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
<?*/?>
<??>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '');
</script>
<??>