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
	<h1 class="page-title"><?=$arResult["NAME"]?></h1>
	<div class="row">
		<div class="col l8">
			<div class="base-card vakansi-single">
				<div class="card-content">
					<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
						<?echo $arResult["DETAIL_TEXT"];?>
					<?else:?>
						<?echo $arResult["PREVIEW_TEXT"];?>
					<?endif?>
				</div>
			</div>
			<?/*?>
			<a href="#" class="btn primary big fullwidth">Откликнуться на вакансию</a>
			<?*/?>
		</div>
	</div>