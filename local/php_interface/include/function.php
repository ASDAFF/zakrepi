<?php
function dateActive($date_start,$date_finish)
{
    $arDateStart = explode(' ',$date_start);
    $arDateFinish = explode(' ',$date_finish);

    $arDateStart = explode('.',$arDateStart[0]);//[0]-d [1]-m [2]-Y
    $arDateFinish = explode('.',$arDateFinish[0]);

    $result = '';

    if((int)$arDateStart[2] != (int)$arDateFinish[2])
    {
        $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date_start)).' '.$arDateStart[2].' - '.$arDateFinish[0].' '.FormatDate("F", MakeTimeStamp($date_finish)).' '.$arDateFinish[2];
    }
    else
    {
        $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date_start)).' - '.$arDateFinish[0].' '.FormatDate("F", MakeTimeStamp($date_finish)).' '.$arDateFinish[2];
    }
    return $result;
}
function dateActiveFrom($date)
{
    $arDateStart = explode(' ',$date);

    $arDateStart = explode('.',$arDateStart[0]);//[0]-d [1]-m [2]-Y

    $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date)).' '.$arDateStart[2];

    return $result;
}
/*вывод цены товара*/
function priceShow($str)
{
    $str = floatVal($str).'.00'; //Незнаю зачем эти два ноля но без них не определяет что число целое

    if(is_positive_int($str))
    {
        $result = number_format($str,0,'',' ').'&nbsp;<i class="rouble">i</i>';
    }
    else
    {
        $result = number_format($str,2,'.',' ').'&nbsp;<i class="rouble">i</i>';
    }
    return $result;
}
/*Проверка на целое число*/
function is_positive_int($num){
    $intNum = floor($num);
    $result = floatVal($num - $intNum);
    if($result == 0) return true;
    else return false;
}

/*вывод preloader*/
function loader($route)
{
    $result = '<div class="loader center-align loader-'.$route.'"><img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/></div>';
    return $result;
}

/*Список розничных магазинов где товар есть в наличии*/
function listRetailStore($id_product){

    /*Определяем является ли товар с торговым предложением*/
    $arOffers = listTradeOffer($id_product);
    CModule::IncludeModule('catalog');
    if(empty($arOffers)) {
        $arFilter = array("PRODUCT_ID" => $id_product, "ACTIVE" => "Y", ">PRODUCT_AMOUNT" => 0, "UF_RETAIL_STORE" => "1");
        $arSelect = array("ID", "TITLE", "ADDRESS", "PHONE", "SCHEDULE", "PRODUCT_AMOUNT", "SHIPPING_CENTER", "GPS_N", "GPS_S", "UF_RETAIL_STORE", "UF_NAME");
        $res = CCatalogStore::GetList(Array(), $arFilter, false, false, $arSelect);

        $arStore = array();
        while ($ar_res = $res->GetNext()) {
            $arStore[] = $ar_res;
        }
        return $arStore;
    }else{

        $arStore = array();
        foreach($arOffers as $offer)
        {
            $arFilter = array("PRODUCT_ID" => $offer['ID'], "ACTIVE" => "Y", ">PRODUCT_AMOUNT" => 0, "UF_RETAIL_STORE" => "1");
            $arSelect = array("ID", "TITLE", "ADDRESS", "PHONE", "SCHEDULE", "PRODUCT_AMOUNT", "SHIPPING_CENTER", "GPS_N", "GPS_S", "UF_RETAIL_STORE", "UF_NAME");
            $res = CCatalogStore::GetList(Array(), $arFilter, false, false, $arSelect);

            while ($ar_res = $res->GetNext()) {
                $key = array_search($ar_res['ID'], array_column($arStore, 'ID'));
                if(strlen($key) == 0 )
                {
                    //Если нет то добавляем данное значение
                    array_push($arStore,$ar_res);
                }
            }
        }
        return $arStore;
    }
}
/*Определяем является ли товар с торговым предложением*/
function listTradeOffer($id_product)
{
    CModule::IncludeModule('iblock');
    $arFilter = array("PROPERTY_CML2_LINK"=>$id_product, "ACTIVE" => "Y");
    $arSelect = array("ID", "NAME");
    $res = CIBlockElement::GetList(Array(),$arFilter,false,false,$arSelect);
    $arOffers = array();
    while($ar_res = $res->GetNext())
    {
        $arOffers[] = $ar_res;
    }
    return $arOffers;
}

/*Аналог array_column в php 5.5*/

function array_column ($input, $columnKey, $indexKey = null) {
    if (!is_array($input)) {
        return false;
    }
    if ($indexKey === null) {
        foreach ($input as $i => &$in) {
            if (is_array($in) && isset($in[$columnKey])) {
                $in    = $in[$columnKey];
            } else {
                unset($input[$i]);
            }
        }
    } else {
        $result    = array();
        foreach ($input as $i => $in) {
            if (is_array($in) && isset($in[$columnKey])) {
                if (isset($in[$indexKey])) {
                    $result[$in[$indexKey]]    = $in[$columnKey];
                } else {
                    $result[]    = $in[$columnKey];
                }
                unset($input[$i]);
            }
        }
        $input    = &$result;
    }
    return $input;
}
