<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Договор оферты");
?>
<div class="workarea">
	<div class="page-title">Договор оферты</div>
	<div class="row">
		<div class="col l7">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."includes/oferta.php"), false);?>
		</div>
	</div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>