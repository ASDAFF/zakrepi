<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?

$id_product = $_GET['ID_PRODUCT'];

$arStore = listRetailStore($id_product);
?>
<pre>
    <?print_r($arStore);?>
</pre>
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
    </div>
</div>