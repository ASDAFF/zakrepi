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

$isAjax = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajax_action"]) && $_POST["ajax_action"] == "Y");
?>
<div class="compare" id="bx_catalog_compare_block">
	<?
	if ($isAjax)
	{
		$APPLICATION->RestartBuffer();
	}
	?>
	<div class="row compare-header">
		<div class="col l3 compare-actions">
			<button class="btn-link<? echo (!$arResult["DIFFERENT"] ? ' active' : ''); ?>" onclick="location.href='<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=N'; ?>'"><?=GetMessage("COMPARE_ALL_PARAMETERS")?></button>
			<button class="btn-link<? echo ($arResult["DIFFERENT"] ? ' active' : ''); ?>" onclick="location.href='<? echo $arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=Y'; ?>'"><?=GetMessage("COMPARE_DIFFERENT_PARAMETERS")?></button>
		</div>
		<div class="col compare-products" id="compareSliderProducts">
			<div class="compare-carousel">
				<div class="carousel-inner clearfix">
					<?foreach($arResult["ITEMS"] as $arItem):?>
					<div class="item compare-item col l2">
						<?if (strlen($arItem["DISPLAY_IMG_SRC"]) > 0):?>
						<div class="prod-img"><img src="<?=$arItem["DISPLAY_IMG_SRC"]?>"/></div>
						<?endif;?>
						<div class="prod-name">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
							<a class="btn btn-icon btn-compare-delete" onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arItem['~DELETE_URL'])?>');" href="javascript:void(0)"><svg class="icon"><use xlink:href="#cross"/></svg></a>
							<?/*<a class="btn btn-icon btn-compare-delete" href="<?=$arItem['~DELETE_URL']?>"><svg class="icon"><use xlink:href="#cross"/></svg></a>*/?>
						</div>
					</div>
					<?endforeach;?>
				</div>
			</div>
			<div class="carousel-controlls">
				<button class="prev active" id="compareSliderBtnLeft"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
				<button class="next active" id="compareSliderBtnRight"><svg class="icon"><use xlink:href="#arrow"/></svg></button>
			</div>
		</div>
	</div>
	<div class="compare-body">
		<div class="row param-line price">
			<div class="col l3 param-name"><?=GetMessage("COMPARE_PRICE")?></div>
			<div class="compare-carousel col param-value">
				<div class="carousel-inner">
					<?
					foreach ($arResult["ITEMS"] as &$arElement)
					{
						echo '<div class="item col l2">';
						if (isset($arElement['MIN_PRICE']) && is_array($arElement['MIN_PRICE']))
						{
							?><? echo $arElement['MIN_PRICE']['DISCOUNT_VALUE']; ?> <span class="rouble">i</span><?
						}
						echo '</div>';
					}
					unset($arElement);
					?>
				</div>
			</div>
		</div>			
		<?
		if (!empty($arResult["SHOW_FIELDS"]))
		{
			foreach ($arResult["SHOW_FIELDS"] as $code => $arProp)
			{
				if (in_array($code, Array("PREVIEW_PICTURE", "DETAIL_PICTURE", "NAME")))
					continue;

				$showRow = true;
				if (!isset($arResult['FIELDS_REQUIRED'][$code]) || $arResult['DIFFERENT'])
				{
					$arCompare = array();
					foreach($arResult["ITEMS"] as &$arElement)
					{
						$arPropertyValue = $arElement["FIELDS"][$code];
						if (is_array($arPropertyValue))
						{
							sort($arPropertyValue);
							$arPropertyValue = implode(" / ", $arPropertyValue);
						}
						$arCompare[] = $arPropertyValue;
					}
					unset($arElement);
					$showRow = (count(array_unique($arCompare)) > 1);
				}
				if ($showRow)
				{
					?>
					<div class="row param-line">
						<div class="col l3 param-name"><?=GetMessage("IBLOCK_FIELD_".$code)?></div>
						<div class="compare-carousel col l8 product-params">
							<div class="carousel-inner">
							<?
							foreach($arResult["ITEMS"] as &$arElement)
							{
								?><div class="item col l2"><?=$arElement["FIELDS"][$code]?></div><?
							}
							unset($arElement);
							?>
							</div>
						</div>
					</div>
					<?
				}
			}
		}
		
		if (!empty($arResult["SHOW_OFFER_FIELDS"]))
		{
			foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp)
			{
				$showRow = true;
				if ($arResult['DIFFERENT'])
				{
					$arCompare = array();
					foreach($arResult["ITEMS"] as &$arElement)
					{
						$Value = $arElement["OFFER_FIELDS"][$code];
						if(is_array($Value))
						{
							sort($Value);
							$Value = implode(" / ", $Value);
						}
						$arCompare[] = $Value;
					}
					unset($arElement);
					$showRow = (count(array_unique($arCompare)) > 1);
				}
				if ($showRow)
				{
				?>
				<div class="row param-line">
					<div class="col l3 param-name"><?=GetMessage("IBLOCK_OFFER_FIELD_".$code)?></div>
					<div class="compare-carousel col l8 product-params">
						<div class="carousel-inner">
						<?foreach($arResult["ITEMS"] as &$arElement)
						{
						?><div class="item col l2"><?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?></div><?
						}
						unset($arElement);
						?>
						</div>
					</div>
				</div>
				<?
				}
			}
		}

		if (!empty($arResult["SHOW_PROPERTIES"]))
		{
			foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty)
			{
				$showRow = true;
				if ($arResult['DIFFERENT'])
				{
					$arCompare = array();
					foreach($arResult["ITEMS"] as &$arElement)
					{
						$arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
						if (is_array($arPropertyValue))
						{
							sort($arPropertyValue);
							$arPropertyValue = implode(" / ", $arPropertyValue);
						}
						$arCompare[] = $arPropertyValue;
					}
					unset($arElement);
					$showRow = (count(array_unique($arCompare)) > 1);
				}

				if ($showRow)
				{
					?>
					<div class="row param-line">
						<div class="col l3 param-name"><?=$arProperty["NAME"]?></div>
						<div class="compare-carousel col l8 product-params">
							<div class="carousel-inner">
								<?foreach($arResult["ITEMS"] as &$arElement)
								{
									?><div class="item col l2"><?=(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?></div><?
								}
								unset($arElement);
								?>
							</div>
						</div>
					</div>
				<?
				}
			}
		}

		if (!empty($arResult["SHOW_OFFER_PROPERTIES"]))
		{
			foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty)
			{
				$showRow = true;
				if ($arResult['DIFFERENT'])
				{
					$arCompare = array();
					foreach($arResult["ITEMS"] as &$arElement)
					{
						$arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
						if(is_array($arPropertyValue))
						{
							sort($arPropertyValue);
							$arPropertyValue = implode(" / ", $arPropertyValue);
						}
						$arCompare[] = $arPropertyValue;
					}
					unset($arElement);
					$showRow = (count(array_unique($arCompare)) > 1);
				}
				if ($showRow)
				{
				?>
				<div class="row param-line">
					<div class="col l3 param-name"><?=$arProperty["NAME"]?></div>
					<div class="compare-carousel col l8 product-params">
						<div class="carousel-inner">
							<?foreach($arResult["ITEMS"] as &$arElement)
							{
							?><div class="item col l2"><?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?></div><?
							}
							unset($arElement);
							?>
						</div>
					</div>
				</div>
				<?
				}
			}
		}
		?>
	</div>
	<?
	if ($isAjax)
	{
		die();
	}
	?>
</div>
<script type="text/javascript">
	var CatalogCompareObj = new BX.Iblock.Catalog.CompareClass("bx_catalog_compare_block");
	compareSlider.Init();
</script>