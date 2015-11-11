<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?

$id_product = $_GET['ID_PRODUCT'];

$arStore = listRetailStore($id_product);
?>
<?/*
<pre>
    <?print_r($arStore);?>
</pre>
*/?>
<div class="subtitle">Наличие товара в розничных магазинах «Крепыж»</div>
<div class="row">
    <div class="col l3 shops-list">
        <?foreach($arStore as $store):?>
        <div class="shop-item">

            <div class="shop-title medium-text">
                <?if($store['~UF_NAME']!='') {
                    echo $store['UF_NAME'];
                }
                else{
                    echo $store['TITLE'];
                }?>
            </div>
            <div class="shop-address">
                <svg class="icon"><use xlink:href="#location"/></svg>
                <span class="item-text"><?=$store['ADDRESS']?></span>
            </div>
            <?if($store['~SCHEDULE']!=''):?>
                <div class="shop-workhours">
                    <svg class="icon">
                        <use xlink:href="#clock"/>
                    </svg>
                    <span class="item-text">
                        <?=$store['~SCHEDULE']?>
                    </span>
                </div>
            <?endif;?>
        </div>
        <?endforeach;?>
    </div>
    <div class="col l9 shops-map">
        <div id="shops-map" class="map"></div>
        <script type="text/javascript">
                ymaps.ready(init);
                var shopsMap;

                function init() {
                    shopsMap = new ymaps.Map("shops-map", {
                        center: [57.16565145867384, 65.54499550000001], // Тюмень
                        zoom: 12,
                        controls: ['smallMapDefaultSet', 'routeEditor', 'trafficControl']
                    });
                    // тут бы еще сделать что-то с балунами, действия при клике на метку,
                    // связать со списком магазинов рядом с картой, например центрировать
                    // и увеличивать карут при клике на адрес магазина в списке....
                    // но я этого делать не буду, заебала меня эта карта
                    var coords = [
                        <?foreach($arStore as $store):?>
                            <?if($store['GPS_N']!=0 || $store['GPS_S']!=0):?>
                                [<?=$store['GPS_N']?>, <?=$store['GPS_S']?>],
                            <?endif;?>
                        <?endforeach;?>
                        /*[57.15689047935417,65.45087498346709],	// Черепанова 29
                         [57.15370227137238,65.56400849999996],	// 50 лет Октября, 8/1
                         [57.194878271190895,65.5943265],		// Ветеранов Труда, 47
                         [57.13485277148095,65.60593249999998],	// Пермякова, 1а
                         [57.13079877143909,65.54357149999998],	// Молодежная, 72
                         [57.13420827141365,65.4935445],			// Московский тракт, 120/1*/
                    ];
                    shopsCollection = new ymaps.GeoObjectCollection({}, {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/zakrepi/images/map-marker.png',
                        iconImageSize: [30, 36],
                    });
                    for (var i = 0; i < coords.length; i++) {
                        shopsCollection.add(new ymaps.Placemark(coords[i]));
                    }
                    shopsMap.behaviors.disable('scrollZoom');
                    shopsMap.geoObjects.add(shopsCollection);
                    if ($('#shops-map').parents('.tab-content-item')) {
                        $('#shops-map').parents('.tab-content-item').on("tabshow", function () {
                            shopsMap.container.fitToViewport();
                        });
                    }
                }
        </script>
    </div>
</div>