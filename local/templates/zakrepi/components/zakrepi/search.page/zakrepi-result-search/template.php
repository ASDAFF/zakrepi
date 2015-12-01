<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="search-page">
<div class="container row" style="display: inline-block; margin-bottom: 25px;    margin-left: 10px;">
	<form action="" method="get">
	<?if($arParams["USE_SUGGEST"] === "Y"):
		if(strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
		{
			$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
			$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
			$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
		}
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:search.suggest.input",
			"",
			array(
				"NAME" => "q",
				"VALUE" => $arResult["REQUEST"]["~QUERY"],
				"INPUT_SIZE" => 40,
				"DROPDOWN_SIZE" => 10,
				"FILTER_MD5" => $arResult["FILTER_MD5"],
			),
			$component, array("HIDE_ICONS" => "Y")
		);?>
	<?else:?>
		<input type="text" name="q" class="col l3" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" />
	<?endif;?>
	<?if($arParams["SHOW_WHERE"]):?>
		&nbsp;<select name="where">
		<option value=""><?=GetMessage("SEARCH_ALL")?></option>
		<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
		<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
		<?endforeach?>
		</select>
	<?endif;?>
		&nbsp;<input type="submit" class="btn primary col l1" style="margin-left:10px;" value="<?=GetMessage("SEARCH_GO")?>" />
		<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
	<?if($arParams["SHOW_WHEN"]):?>
		<script>
		var switch_search_params = function()
		{
			var sp = document.getElementById('search_params');
			var flag;
			var i;

			if(sp.style.display == 'none')
			{
				flag = false;
				sp.style.display = 'block'
			}
			else
			{
				flag = true;
				sp.style.display = 'none';
			}

			var from = document.getElementsByName('from');
			for(i = 0; i < from.length; i++)
				if(from[i].type.toLowerCase() == 'text')
					from[i].disabled = flag;

			var to = document.getElementsByName('to');
			for(i = 0; i < to.length; i++)
				if(to[i].type.toLowerCase() == 'text')
					to[i].disabled = flag;

			return false;
		}
		</script>
		<br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
		<div id="search_params" class="search-page-params" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"]? 'block': 'none'?>">
			<?$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'',
				array(
					'SHOW_INPUT' => 'Y',
					'INPUT_NAME' => 'from',
					'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
					'INPUT_NAME_FINISH' => 'to',
					'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
					'INPUT_ADDITIONAL_ATTR' => 'size="10"',
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);?>
		</div>
	<?endif?>
	</form>
</div>
<br />

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["SEARCH"])>0):?>
	<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

	<?
		$filter_or = array();
		global $arrFilter;
		$arrFilter = array();
		$filter_or = array();
		$filter_or['LOGIC'] = 'OR';
	?>
	<?foreach($arResult["SEARCH"] as $arItem):?>

		<?
			$filter_or_element = array('ID' => $arItem['ITEM_ID']);
			$filter_or =  array_merge($filter_or, array($filter_or_element));
		/*
			CModule::IncludeModule("catalog");
			$ar_res = CCatalogProduct::GetByIDEx($arItem['ID']);
		?>


		<pre><?print_r($ar_res);?></pre>

		<a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
		<p><?echo $arItem["BODY_FORMATED"]?></p>
		<?if (
			$arParams["SHOW_RATING"] == "Y"
			&& strlen($arItem["RATING_TYPE_ID"]) > 0
			&& $arItem["RATING_ENTITY_ID"] > 0
		):?>
			<div class="search-item-rate"><?
				$APPLICATION->IncludeComponent(
					"bitrix:rating.vote", $arParams["RATING_TYPE"],
					Array(
						"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
						"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
						"OWNER_ID" => $arItem["USER_ID"],
						"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
						"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
						"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
						"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
						"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
						"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
						"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);?>
			</div>
		<?endif;?>
		<small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br /><?
		if($arItem["CHAIN_PATH"]):?>
			<small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
		endif;
		?><hr />
		*/?>
	<?endforeach;?>
	<?
		$arrFilter = array_merge($arrFilter, array($filter_or));
	?>
	<div class="product-list clearfix" id="catalog-list">
	<?$APPLICATION->IncludeComponent(
	    "zakrepi:catalog.section",
	    "catalog-section",
	    //"",
	    array(
	        "COMPONENT_TEMPLATE" => ".default",
	        "IBLOCK_TYPE" => "1c_catalog",
	        "IBLOCK_ID" => $arParams['CATALOG_ID'],
	        "SECTION_ID" => "",//$_REQUEST["SECTION_ID"],
	        "SECTION_CODE" => $_REQUEST["code"],
	        "SECTION_USER_FIELDS" => array(
	            0 => "",
	            1 => "",
	        ),
	        "ELEMENT_SORT_FIELD" => "sort",
	        "ELEMENT_SORT_ORDER" => "asc",
	        "ELEMENT_SORT_FIELD2" => "id",
	        "ELEMENT_SORT_ORDER2" => "desc",
	        "FILTER_NAME" => "arrFilter",
	        "INCLUDE_SUBSECTIONS" => "Y",
	        "SHOW_ALL_WO_SECTION" => "Y",
	        "HIDE_NOT_AVAILABLE" => "N",
	        "PAGE_ELEMENT_COUNT" => $arParams['PAGE_RESULT_COUNT'],
	        "LINE_ELEMENT_COUNT" => "3",
	        "PROPERTY_CODE" => array(
	            "rating"
	        ),
	        "OFFERS_LIMIT" => "0",
	        "TEMPLATE_THEME" => "blue",
	        "PRODUCT_SUBSCRIPTION" => "N",
	        "SHOW_DISCOUNT_PERCENT" => "N",
	        "SHOW_OLD_PRICE" => "N",
	        "SHOW_CLOSE_POPUP" => "N",
	        "MESS_BTN_BUY" => "Купить",
	        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
	        "MESS_BTN_SUBSCRIBE" => "Подписаться",
	        "MESS_BTN_DETAIL" => "Подробнее",
	        "MESS_NOT_AVAILABLE" => "Нет в наличии",
	        "SECTION_URL" => "",
	        "DETAIL_URL" => "",
	        "SECTION_ID_VARIABLE" => "SECTION_ID",
	        "SEF_MODE" => "N",
	        "AJAX_MODE" => "N",
	        "AJAX_OPTION_JUMP" => "N",
	        "AJAX_OPTION_STYLE" => "N",
	        "AJAX_OPTION_HISTORY" => "N",
	        "AJAX_OPTION_ADDITIONAL" => "",
	        "CACHE_TYPE" => "A",
	        "CACHE_TIME" => "36000000",
	        "CACHE_GROUPS" => "Y",
	        "SET_TITLE" => "Y",
	        "SET_BROWSER_TITLE" => "Y",
	        "BROWSER_TITLE" => "-",
	        "SET_META_KEYWORDS" => "Y",
	        "META_KEYWORDS" => "-",
	        "SET_META_DESCRIPTION" => "Y",
	        "META_DESCRIPTION" => "-",
	        "SET_LAST_MODIFIED" => "N",
	        "USE_MAIN_ELEMENT_SECTION" => "N",
	        "ADD_SECTIONS_CHAIN" => "Y",
	        "CACHE_FILTER" => "N",
	        "ACTION_VARIABLE" => "action",
	        "PRODUCT_ID_VARIABLE" => "id",
	        "PRICE_CODE" => array(
	            0 => "Розничная",
	            1 => "Оптовая",
	        ),
	        "USE_PRICE_COUNT" => "N",
	        "SHOW_PRICE_COUNT" => "1",
	        "PRICE_VAT_INCLUDE" => "Y",
	        "CONVERT_CURRENCY" => "N",
	        "BASKET_URL" => "/cart/index.php",
	        "USE_PRODUCT_QUANTITY" => "N",
	        "PRODUCT_QUANTITY_VARIABLE" => "",
	        "ADD_PROPERTIES_TO_BASKET" => "Y",
	        "PRODUCT_PROPS_VARIABLE" => "prop",
	        "PARTIAL_PRODUCT_PROPERTIES" => "N",
	        "PRODUCT_PROPERTIES" => array(
	        ),
	        "ADD_TO_BASKET_ACTION" => "ADD",
	        "PAGER_TEMPLATE" => "pagen",
	        "DISPLAY_TOP_PAGER" => "N",
	        "DISPLAY_BOTTOM_PAGER" => "N",
	        "PAGER_TITLE" => "Товары",
	        "PAGER_SHOW_ALWAYS" => "N",
	        "PAGER_DESC_NUMBERING" => "N",
	        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	        "PAGER_SHOW_ALL" => "N",
	        "PAGER_BASE_LINK_ENABLE" => "N",
	        "SET_STATUS_404" => "N",
	        "SHOW_404" => "N",
	        "MESSAGE_404" => "",
	        "OFFERS_FIELD_CODE" => array(
	            0 => "",
	            1 => "",
	        ),
	        "OFFERS_PROPERTY_CODE" => array(
	            0 => "",
	            1 => "",
	        ),
	        "OFFERS_SORT_FIELD" => "sort",
	        "OFFERS_SORT_ORDER" => "asc",
	        "OFFERS_SORT_FIELD2" => "id",
	        "OFFERS_SORT_ORDER2" => "desc",
	        "OFFERS_CART_PROPERTIES" => array(
	        ),
	        "PRODUCT_DISPLAY_MODE" => "N",
	        "ADD_PICT_PROP" => "-",
	        "LABEL_PROP" => "-",
	        "DISPLAY_COMPARE" => "Y",
	        "COMPARE_PATH" => "/compare/",

	        /*id инфоблока торговова предложения*/
	        //"ID_IBLOCK_OFFERS" => 9,

	        //Путь до подгрузки route компонента /include/PROMO/list.php
	        "ROUTE" => 'catalog',
	        "ROUTE_URL" => '/includes/catalog/catalog.php',
	        "ROUTE_PARAM" =>   "code=".$_REQUEST["code"]
	    ),
	    false
	);?>
	</div>
	
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
	<br />
	<p>
	<?/*if($arResult["REQUEST"]["HOW"]=="d"):?>
		<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
	<?else:?>
		<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
	<?endif;*/?>
	</p>
<?else:?>
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>
</div>