<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");?>
<?
	$arStore = listShops();

?>

<div class="page-title">Наши магазины</div>
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
                    ];
                    var infoShop = [
                        <?foreach($arStore as $store):?>
                        	{
                           		name: "<?echo $store['UF_NAME'];?>",
                           		tel:  "<?=$store['PHONE']?>",
								address: "<?=$store['ADDRESS']?>",
								workhours:  "<?=$store['~SCHEDULE']?>"
                       		},
                        <?endforeach;?>
                    ];

                    zBalloonLayout = ymaps.templateLayoutFactory.createClass(
						'<div class="balloon">'+
							'<button class="btn btn-icon btn-close"><svg class="icon"><use xlink:href="#cross"/></svg></button>'+
							'<div class="balloon-tngl"></div>'+
							'<div class="balloon-inner">'+
								'$[[options.contentLayout observeSize minWidth=300]]'+
							'</div>'+
						'</div>', {
							build: function(){
								this.constructor.superclass.build.call(this);
								this._$element = $('.balloon', this.getParentElement());
								this.applyElementOffset();
								this._$element.find('.btn-close').on('click', $.proxy(this.onCloseClick, this));
							},
							clear: function () {
								this._$element.find('.btn-close').off('click');
								this.constructor.superclass.clear.call(this);
							},
							onSublayoutSizeChange: function (){
								zBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);
								if(!this._isElement(this._$element)) {
			                        return;
			                    }
			                    this.applyElementOffset();
			                    this.events.fire('shapechange');
			                },
							applyElementOffset: function (){
								this._$element.css({
			                        left: -(this._$element[0].offsetWidth / 2),
			                        top: -(this._$element[0].offsetHeight + this._$element.find('.balloon-tngl')[0].offsetHeight)
			                    });
							},
							onCloseClick: function (e){
			                    e.preventDefault();
			                    this.events.fire('userclose');
			                },
							getShape: function (){
								if(!this._isElement(this._$element)) {
			                        return zBalloonLayout.superclass.getShape.call(this);
			                    }
								var position = this._$element.position();
								return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
			                        [position.left, position.top], [
			                            position.left + this._$element[0].offsetWidth,
			                            position.top + this._$element[0].offsetHeight + this._$element.find('.balloon-tngl')[0].offsetHeight
			                        ]
			                    ]));
							},
							_isElement: function (element){
								return element && element[0] && element.find('.balloon-tngl')[0];
							}
						}
					);


                    zBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
						'<div class="balloon-header">'+
							'<div class="title medium-text">{{ properties.name|raw }}</div>'+
							'<div class="small-text color-text text-light">Уточните цену и наличие по телефону:</div>'+
							'<div class="phone medium-text">{{ properties.tel|raw }}</div>'+
						'</div>'+
						'<div class="balloon-content">'+
							'<div class="address">{{ properties.address|raw }}</div>'+
							'<div class="workhours">{{ properties.workhours|raw }}</div>'+
						'</div>'
					);
                    shopsCollection = new ymaps.GeoObjectCollection({}, {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/zakrepi/images/map-marker.png',
                        iconImageSize: [30, 36],
                    });
                    for (var i = 0; i < coords.length; i++) {
                        shopsCollection.add(new ymaps.Placemark(
                        	coords[i],
							infoShop[i],
							{
								balloonShadow: false,
								balloonLayout: zBalloonLayout,
								balloonContentLayout: zBalloonContentLayout,
								balloonPanelMaxMapArea: 0,
								balloonOffset: [130, 0]
							}
						));
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>  