<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Статьи');
?>
    <div class="row">
        <h1 class="page-title col l9">Статьи</h1>
    </div>
    <div class="row news-list" id="articles-list">
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/articles/list.php');?>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>