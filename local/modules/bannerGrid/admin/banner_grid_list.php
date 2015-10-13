<?php
    define("ADMIN_MODULE_NAME", "bannergrid");

    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/bannergrid/include.php");

    use Bitrix\Main;
    use Bitrix\Main\Localization\Loc;
    Loc::loadMessages(__FILE__);

    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
    $APPLICATION->SetTitle(Loc::getMessage("BANNER_GRID_TITLE"));
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        CBannerGrid::saveParametrBanner($_POST);
    }
?>
<link rel="stylesheet" href="/local/modules/bannergrid/lib/css/style.css">
<form method="POST">
    <div class="banner-box row">
        <div class="col l6">
            <div class="banner big" id="item_banner_1" onclick="getElementItem(1);">
                <?
                   $elem =  CBannerGrid::getBannerGrid(1);
                ?>
                <?if(count($elem)>0):?>
                    <?
                        $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                        $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">1</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_1" value="1"/>
                    <input type="hidden" name="SIZE_1" value="big"/>
                    <input type="hidden" name="ID_1" value="1"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">1</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_1" value="1"/>
                    <input type="hidden" name="SIZE_1" value="big"/>
                    <input type="hidden" name="ID_1" value="1"/>
                <?endif;?>
            </div>
        </div>
        <div class="col l3">
            <div class="banner small" id="item_banner_2" onclick="getElementItem(2);">
                <?
                $elem =  CBannerGrid::getBannerGrid(2);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">2</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_2" value="2"/>
                    <input type="hidden" name="SIZE_2" value="small"/>
                    <input type="hidden" name="ID_2" value="2"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">2</span></div>
                    <input type="hidden" class="param" name="PARAMETR_2" value="2"/>
                    <input type="hidden" name="SIZE_2" value="small"/>
                    <input type="hidden" name="ID_2" value="2"/>
                <?endif;?>
            </div>
            <div class="banner small" id="item_banner_3" onclick="getElementItem(3);">
                <?
                $elem =  CBannerGrid::getBannerGrid(3);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">3</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_3" value="3"/>
                    <input type="hidden" name="SIZE_3" value="small"/>
                    <input type="hidden" name="ID_3" value="3"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">3</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_3" value="3"/>
                    <input type="hidden" name="SIZE_3" value="small"/>
                    <input type="hidden" name="ID_3" value="3"/>
                <?endif;?>
            </div>
        </div>
        <div class="col l3">
            <div class="banner big" id="item_banner_4" onclick="getElementItem(4);">
                <?
                $elem =  CBannerGrid::getBannerGrid(4);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">4</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_4" value="4"/>
                    <input type="hidden" name="SIZE_4" value="medium"/>
                    <input type="hidden" name="ID_4" value="4"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">4</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_4" value="4"/>
                    <input type="hidden" name="SIZE_4" value="medium"/>
                    <input type="hidden" name="ID_4" value="4"/>
                <?endif;?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="col l3">
            <div class="banner big" id="item_banner_5" onclick="getElementItem(5);">
                <?
                $elem =  CBannerGrid::getBannerGrid(5);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">5</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_5" value="5"/>
                    <input type="hidden" name="SIZE_5" value="medium"/>
                    <input type="hidden" name="ID_5" value="5"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">5</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_5" value="5"/>
                    <input type="hidden" name="SIZE_5" value="medium"/>
                    <input type="hidden" name="ID_5" value="5"/>
                <?endif;?>
            </div>
        </div>
        <div class="col l3">
            <div class="banner small" id="item_banner_6" onclick="getElementItem(6);">
                <?
                $elem =  CBannerGrid::getBannerGrid(6);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">6</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_6" value="6"/>
                    <input type="hidden" name="SIZE_6" value="small"/>
                    <input type="hidden" name="ID_6" value="6"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">6</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_6" value="6"/>
                    <input type="hidden" name="SIZE_6" value="small"/>
                    <input type="hidden" name="ID_6" value="6"/>
                <?endif;?>
            </div>
            <div class="banner small" id="item_banner_7" onclick="getElementItem(7);">
                <?
                $elem =  CBannerGrid::getBannerGrid(7);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">7</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_7" value="7"/>
                    <input type="hidden" name="SIZE_7" value="small"/>
                    <input type="hidden" name="ID_7" value="7"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">7</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_7" value="7"/>
                    <input type="hidden" name="SIZE_7" value="small"/>
                    <input type="hidden" name="ID_7" value="7"/>
                <?endif;?>
            </div>
        </div>
        <div class="col l6">
            <div class="banner big" id="item_banner_8" onclick="getElementItem(8);">
                <?
                $elem =  CBannerGrid::getBannerGrid(8);
                ?>
                <?if(count($elem)>0):?>
                    <?
                    $arResult = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS'])
                    ?>
                    <span class="name_banner"><?=$arResult[0]['NAME']?></span>
                    <?
                    $URL = CFile::GetPath($arResult[0]['PREVIEW_PICTURE']);
                    ?>
                    <div class="num" style="background: url('<?=$URL?>') no-repeat;">
                        <span class="number_banner">8</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_8" value="8"/>
                    <input type="hidden" name="SIZE_8" value="big"/>
                    <input type="hidden" name="ID_8" value="8"/>
                <?else:?>
                    <span class="name_banner"></span>
                    <div class="num">
                        <span class="number_banner">8</span>
                    </div>
                    <input type="hidden" class="param" name="PARAMETR_8" value="8"/>
                    <input type="hidden" name="SIZE_8" value="big"/>
                    <input type="hidden" name="ID_8" value="8"/>
                <?endif;?>
            </div>
        </div>
    </div>
    <input type="submit" value="<?=Loc::getMessage("BANNER_GRID_SAVE")?>" class="adm-btn-save"/>
</form>

<div class="modal" id="modal_banner_list">

</div>
<div class="bg-black" onclick="closeModal();"></div>

<script src="/local/modules/bannergrid/lib/js/jquery-1.11.3.min.js"></script>
<script>
    function getElementItem(num){
        $.ajax({
            type: "POST",
            url: '/local/modules/bannergrid/lib/modal_getlist.php',
            data: "num=" + num,
            success: function(msg){
                $('#modal_banner_list').html(msg);
                $('#modal_banner_list').show();
                $('.bg-black').show();
            }
        });
    }
    function closeModal(){
        $('#modal_banner_list').hide();
        $('.bg-black').hide();
    }
    function applyBanner(num)
    {
        id = $("#banner-select option:selected").val();
        name = $("#banner-select option:selected").text();
        $('#item_banner_'+num+' input.param').val(id);
        closeModal();
        $('#item_banner_'+num+' .name_banner').text(name);


    }
    $(document).ready(function(){

    });
</script>
