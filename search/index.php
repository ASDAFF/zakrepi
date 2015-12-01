<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Поиск');
?>
<div class="row">
        <h1 class="page-title col l9">Поиск</h1>
		<?$APPLICATION->IncludeComponent(
			"zakrepi:search.page",
			"zakrepi-result-search",
			Array(
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "N",
				"COMPONENT_TEMPLATE" => "zakrepi-result-search",
				"DEFAULT_SORT" => "rank",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FILTER_NAME" => "",
				"NO_WORD_LOGIC" => "N",
				"PAGER_SHOW_ALWAYS" => "Y",
				"PAGER_TEMPLATE" => "pagen",
				"PAGER_TITLE" => "Результаты поиска",
				"PAGE_RESULT_COUNT" => "40",
				"RESTART" => "N",
				"SHOW_WHEN" => "N",
				"SHOW_WHERE" => "N",
				"USE_LANGUAGE_GUESS" => "Y",
				"USE_SUGGEST" => "N",
				"USE_TITLE_RANK" => "N",
				"arrFILTER" => array("iblock_1c_catalog"),
				"arrFILTER_iblock_1c_catalog" => array("10"),
				"arrFILTER_main" => array(""),
				"arrWHERE" => array(),

				"CATALOG_ID" => $arZSettings['CATALOG_ID']
			)
		);?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>