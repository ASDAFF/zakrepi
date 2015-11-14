<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<div class="workarea">
    <h1 class="page-title">Гайковерты</h1>

    <div class="row">
        <div class="filter-box col l3">
            <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/filter.php')?>
        </div>

        <div class="catalog col l9 no-padding">
            <div class="product-list clearfix">

                <?include($_SERVER['DOCUMENT_ROOT'].'/includes/catalog/catalog.php')?>
                <div class="item col l3" ng-repeat="product in products | orderBy:sort:true">
                    <div class="product-card">
                        <div class="product-info">
                            <a class="item-img" href="product__single.php" style="background-image:url({{product.image}});"></a>
                            <div class="item-name"><a href="product__single.php">{{product.name}}</a></div>
                            <div ng-class="'rating rate-'+product.rating">
                                <svg class="star"><use xlink:href="#star"/></svg>
                                <svg class="star"><use xlink:href="#star"/></svg>
                                <svg class="star"><use xlink:href="#star"/></svg>
                                <svg class="star"><use xlink:href="#star"/></svg>
                                <svg class="star"><use xlink:href="#star"/></svg>
                            </div>
                            <div class="product-price">
                                <div class="old-price" ng-if="product.oldprice">{{product.oldprice}} <i class="rouble">i</i></div>
                                <!-- в цене тысячи отделить неразрывным пробелом &nbsp; -->
                                <div class="price">{{product.price}} <i class="rouble">i</i></div>
                            </div>
                            <a href="#" class="shopping-card btn btn-icon primary">
                                <svg class="icon"><use xlink:href="#cart"/></svg>
                            </a>
                        </div>
                        <div class="compare">
                            <input type="checkbox" id="compare_today_{{product.id}}" />
                            <label class="checkbox-lbl" for="compare_today_{{product.id}}">Cравнить</label>
                        </div>
                    </div>
                </div>
                <div>
                    <a class="btn flat fullwidth big btn-more" href="#">Показать еще</a>
                    Навигация
                </div>
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