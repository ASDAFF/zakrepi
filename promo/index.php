<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Акции');
?>
    <h1 class="page-title">Акции</h1>
    <div class="row action-list" id="promo-list">
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/promo/list.php')?>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>