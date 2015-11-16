<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<div class="workarea">
    <?
        $title = titleCatalog($_REQUEST['code'],$arZSettings['CATALOG_ID']);
    ?>
    <h1 class="page-title"><?=$title?></h1>

    <div class="row">
        <div class="sort-box col l9">
            <span class="sort-text">Сортировать по:</span>
            <input type="radio" class="hide sort-ctrl" name="sort" id="sort-reviews" ng-model="sort" value="reviews" ng-init="sort = 'reviews'"/>
            <label class="sort-item" for="sort-reviews">популярности</label>
            <input type="radio" class="hide sort-ctrl" name="sort" id="sort-price" ng-model="sort" value="price"/>
            <label class="sort-item" for="sort-price">цене</label>
            <input type="radio" class="hide sort-ctrl" name="sort" id="sort-id" ng-model="sort" value="id"/>
            <label class="sort-item" for="sort-id">новизне</label>
            <input type="radio" class="hide sort-ctrl" name="sort" id="sort-rating" ng-model="sort" value="rating"/>
            <label class="sort-item" for="sort-rating">рейтингу</label>
        </div>

        <div class="compare-box col l3" id="compare-small">
            <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/compare-min.php')?>

        </div>
    </div>

    <div class="row">
        <div class="filter-box col l3">
            <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/filter.php')?>
        </div>

        <div class="catalog col l9 no-padding">
            <div class="product-list clearfix">

                <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/catalog.php')?>
               <?/* <div>
                    <a class="btn flat fullwidth big btn-more" href="#">Показать еще</a>
                </div>
                */?>
            </div>
            <div class="col l12">
                <div class="text-box">
                    <p>Гайковертом называется инструмент, предназначенный для сборки/разборки различных резьбовых соединений. Его используют в случаях, когда невозможно обойтись простым гаечным ключом: к примеру, когда необходимо разобрать труднодоступные соединения, заржавевший металл, прикипевшие гайки и т.п. </p>
                    <p>В отличие от ручного инструмента, электрический гайковёрт позволяет существенно снизить затрачиваемые усилия и сократить время выполнения работ. Еще одним неоспоримым преимуществом является контролируемый момент при затяжке или отворачивании резьбовых соединений. Это позволяет обеспечить максимальную точность выполняемых работ.</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.workarea -->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>