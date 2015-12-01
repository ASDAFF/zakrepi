<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<div class="workarea">
    <?
        $title = titleCatalog($_REQUEST['code'],$arZSettings['CATALOG_ID']);
    ?>
    <h1 class="page-title"><?=$title?></h1>

    <?
    //$_COOKIE['SORT_CATALOG'] = 'asc';
        if($_COOKIE['CATALOG_SORT'] == '')
        {
            $_COOKIE['CATALOG_SORT'] = 'asc';
            $sort = 'asc';
        }


        if($_COOKIE['CATALOG_SORT_TYPE'] == '')
            $_COOKIE['CATALOG_SORT_TYPE'] = 'id';


        if($_GET['sort']!='' && $_GET['sort']=='asc')
        {
             $_COOKIE['CATALOG_SORT'] = $_GET['sort'];
             $sort = 'desc';
        }
        if($_GET['sort']!='' && $_GET['sort']=='desc')
        {
            $_COOKIE['CATALOG_SORT'] = $_GET['sort'];
            $sort = 'asc';
        }


        if($_GET['sort_type']!=''){
            switch ($_GET['sort_type']){
                case 'price':
                     $_COOKIE['CATALOG_SORT_TYPE'] = 'CATALOG_PRICE_1';
                break;
                case 'hit':
                    $_COOKIE['CATALOG_SORT_TYPE'] = 'DATE_CREATE';
                break;
                case 'new':
                    $_COOKIE['CATALOG_SORT_TYPE'] = 'DATE_CREATE';
                break;
            }
        }
    $url_sort = $_SERVER['REQUEST_URI'];
    $url_sort = deleteGET($url_sort, 'sort'); 
    $url_sort = deleteGET($url_sort, 'sort_type'); 

    $pos = strripos($url_sort, '?');
    if ($pos === false) {
        $url_sort.='?';
    }
    else{
        $url_sort.='&';
    }
    ?>
    <div class="row">
        <div class="sort-box col l9">
            <span class="sort-text">Сортировать по:</span>
               <?/*?> <a href="<?=$url_sort?>sort=<?=$sort?>&sort_type=hit" rel="nofollow" class="sort-item">популярности</a><?*/?>
                <a href="<?=$url_sort?>sort=<?=$sort?>&sort_type=price" rel="nofollow" class="sort-item">цене <?if($_COOKIE['CATALOG_SORT_TYPE'] == 'CATALOG_PRICE_1'){ if($_COOKIE['CATALOG_SORT'] =='asc'){?>↓<?}else{?>↑<?}}?></a>
                <a href="<?=$url_sort?>sort=<?=$sort?>&sort_type=new" rel="nofollow" class="sort-item">новизне <?if($_COOKIE['CATALOG_SORT_TYPE'] == 'DATE_CREATE'){ if($_COOKIE['CATALOG_SORT'] =='asc'){?>↓<?}else{?>↑<?}}?></a>
               <?/*?> <a href="<?=$url_sort?>sort=<?=$sort?>&sort_type=hit" rel="nofollow" class="sort-item">рейтингу</a> <?*/?>
        </div>

        <div class="compare-box col l3" id="compare-small">
            <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/compare-min.php');?>

        </div>
    </div>

    <div class="row">
        <div class="filter-box col l3">
            <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/filter.php');?>
        </div>



        <div class="catalog col l9 no-padding">
            <div class="product-list clearfix" id="catalog-list">

                <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/catalog.php');?>
               <?/* <div>
                    <a class="btn flat fullwidth big btn-more" href="#">Показать еще</a>
                </div>
                */?>
            </div>
            <div class="modal notification compare-full" id="compare-full-notification">
                <button class="btn btn-icon btn-close btn-close-modal"><svg class="icon"><use xlink:href="#cross"/></svg></button>
                <div class="item-text medium-text">Вы можете добавить к сравнению не более 5 товаров.</div>
            </div>
            <?/*?>
            <div class="col l12">
                <div class="text-box">
                    <p>Гайковертом называется инструмент, предназначенный для сборки/разборки различных резьбовых соединений. Его используют в случаях, когда невозможно обойтись простым гаечным ключом: к примеру, когда необходимо разобрать труднодоступные соединения, заржавевший металл, прикипевшие гайки и т.п. </p>
                    <p>В отличие от ручного инструмента, электрический гайковёрт позволяет существенно снизить затрачиваемые усилия и сократить время выполнения работ. Еще одним неоспоримым преимуществом является контролируемый момент при затяжке или отворачивании резьбовых соединений. Это позволяет обеспечить максимальную точность выполняемых работ.</p>
                </div>
            </div>
            <?*/?>
        </div>
    </div>
</div> <!-- /.workarea -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>