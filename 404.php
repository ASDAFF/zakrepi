<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

/*$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);*/
?>
    <div class="page-empty page-404">
        <div class="row">
            <div class="col l5 offset-l1"><img src="/images/404.png"/></div>
            <div class="col l4 offset-l1">
                <div class="page-title">Страница не найдена</div>
                <p>Страница была удалена, переименована или </br>временно недоступна</p>
                <p><a href="/" class="btn primary">На главную</a></p>
            </div>
        </div>
    </div>
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>