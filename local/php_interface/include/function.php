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
    $str = (float) $str;
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
    $intNum = (int) $num;
    return ($intNum == $num && is_int($intNum));
}

/*вывод preloader*/
function loader($route)
{
    $result = '<div class="loader center-align loader-'.$route.'"><img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/></div>';
    return $result;
}

/*Список розничных магазинов где товар есть в наличии*/
function listRetailStore($id_product){
    CModule::IncludeModule('catalog');
    $arFilter = array("PRODUCT_ID"=>$id_product, "ACTIVE" => "Y", ">PRODUCT_AMOUNT" => 0,"UF_RETAIL_STORE" => "1");
    $arSelect = array("ID", "TITLE", "ADDRESS", "PHONE", "SCHEDULE", "PRODUCT_AMOUNT", "SHIPPING_CENTER","GPS_N","GPS_S","UF_RETAIL_STORE","UF_NAME");
    $res = CCatalogStore::GetList(Array(),$arFilter,false,false,$arSelect);

    $arStore = array();
    while($ar_res = $res->GetNext())
    {
        $arStore[] = $ar_res;
    }
    return $arStore;
}
