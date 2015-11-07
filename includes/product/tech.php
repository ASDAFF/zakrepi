<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
    $id_product = $_GET['ID_PRODUCT'];

    CModule::IncludeModule('iblock');

    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("ID"=>IntVal($id_product), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
    }
    $not_prop = array(
        "CML2_ATTRIBUTES",
        "CML2_ARTICLE",
        "CML2_TAXES",
        "CML2_BAR_CODE",
        "CML2_TRAITS"
    );
    /*Получаем все свойства элемента*/
    $arResult["DISPLAY_PROPERTIES_ZAKREPI"] = array();
    foreach($arProps as $pid)
    {
        if(!in_array($pid['CODE'],$not_prop)) {
            $prop = &$pid;
            $boolArr = is_array($prop["VALUE"]);
            if (
                ($boolArr && !empty($prop["VALUE"]))
                || (!$boolArr && strlen($prop["VALUE"]) > 0)
            ) {
                $arResult["DISPLAY_PROPERTIES_ZAKREPI"][$pid['CODE']] = $pid;
            }
        }
    }
    /*Формируем необходимый масси с наименованием и параметром*/
    foreach ($arResult['DISPLAY_PROPERTIES_ZAKREPI'] as $a=>$item)
    {
        $arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'][$a]['DESCRIPTION'] = $item['NAME'];
        if( $item['MULTIPLE'] == 'Y'){
            $arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'][$a]['VALUE'] = '';
            foreach($item['~VALUE'] as $k=>$prop)
            {
                $arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'][$a]['VALUE'] .=$prop;
                if($k+1 < count($item['~VALUE'])) $arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'][$a]['VALUE'] .=', ';
            }
        }
        else{
            $arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'][$a]['VALUE'] = $item['~VALUE'];
        }
    }
?>
<div class="subtitle">Характеристики <?=$arFields['NAME'];?></div>
<div class="table col l7 nofloat no-padding">

<?
foreach($arResult['DISPLAY_PROPERTIES']['OPTIONS_5_ELEMENT'] as $a=>$item)
{
    ?>
    <div class="table-row no-padding col l12">
        <div class="table-col col l8"><?=$item['DESCRIPTION']?></div>
        <div class="table-col col l3"><?=$item['VALUE']?></div>
    </div>
    <?
}
?>
</div>