<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Новости');
?>
    <div class="row">
        <h1 class="page-title col l9">Новости</h1>
        <div class="archive-box col l3 right-align medium-text">
            <span>Архив новостей: </span>
            <select>
                <option value="2015" selected>2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
            </select>
        </div>
    </div>
    <div class="row news-list" id="news-list">
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/news/list.php');?>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>