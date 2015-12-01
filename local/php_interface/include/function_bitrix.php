<?
/*Пересчет рейтинга товара*/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("UpdateElement", "RatingProduct"));
AddEventHandler("iblock", "OnAfterIBlockElementDelete", Array("UpdateElement", "RatingProduct"));

//Добавление комментария к заказу
AddEventHandler("sale", "OnSaleComponentOrderOneStepComplete",Array("CommentOrder", "OrderCommentPlus"));
AddEventHandler("sale", "OnSaleComponentOrderComplete", Array("CommentOrder", "OrderCommentPlus"));

class CommentOrder{
    function OrderCommentPlus($ID, $arFields){
        
        /*require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/htmls.ordercomment/order_filelds_list.php");

        $arOrderFieldsList = Array(
            "ID" => GetMessage("SPS_ORDER_ID"), 
            "DATE_INSERT" => GetMessage("SPS_ORDER_DATETIME"), 
            "DATE_INSERT_DATE" => GetMessage("SPS_ORDER_DATE"), 
            "SHOULD_PAY" => GetMessage("SPS_ORDER_PRICE"), 
            "CURRENCY" => GetMessage("SPS_ORDER_CURRENCY"), 
            "PRICE" => GetMessage("SPS_ORDER_SUM"), 
            "LID" => GetMessage("SPS_ORDER_SITE"), 
            "PRICE_DELIVERY" => GetMessage("SPS_ORDER_PRICE_DELIV"), 
            "DISCOUNT_VALUE" => GetMessage("SPS_ORDER_DESCOUNT"), 
            "USER_ID" => GetMessage("SPS_ORDER_USER_ID"), 
            "PAY_SYSTEM_ID" => GetMessage("SPS_ORDER_PS"), 
            "DELIVERY_ID" => GetMessage("SPS_ORDER_DELIV"), 
            "TAX_VALUE" => GetMessage("SPS_ORDER_TAX"),
            "USER_DESCRIPTION" => GetMessage("SPS_USER_DESCRIPTION"));

        $AddComment = array();
        foreach($arOrderFieldsList as $Field => $Desc){

            if(COption::GetOptionString("htmls.ordercomment", $Field) == "Y"){
                if($Field == 'DATE_INSERT_DATE'){
                    $AddComment[] = CDatabase::FormatDate($arFields['DATE_INSERT'], "YYYY-MM-DD HH:MI:SS", "DD.MM.YYYY");
                }
                elseif($Field == 'DATE_INSERT'){
                    $AddComment[] = CDatabase::FormatDate($arFields['DATE_INSERT'], "YYYY-MM-DD HH:MI:SS", "DD.MM.YYYY HH:MI:SS");
                }
                elseif($Field == 'SHOULD_PAY'){
                    $AddComment[] = $arFields['PRICE'];
                }
                elseif($Field == "PAY_SYSTEM_ID"){
                    $arPaySys = CSalePaySystem::GetByID($arFields['PAY_SYSTEM_ID'], $arFields['PERSON_TYPE_ID']);
                    $AddComment[] = $arPaySys["NAME"];
                }
                elseif($Field == "DELIVERY_ID"){
                    $arDeliv = CSaleDelivery::GetByID($arFields[$Field]);
                    $AddComment[] = $arDeliv["NAME"];
                }
                elseif(!empty($arFields[$Field])){
                    $AddComment[] = $arFields[$Field];
                }
            }
        }

        $OrderProps = CSaleOrderPropsValue::GetOrderProps($ID);
        while ($arProps = $OrderProps->Fetch()){
            if(COption::GetOptionString("htmls.ordercomment", "PROP_" . $arProps['ORDER_PROPS_ID']) == "Y"){
                $AddComment[] = $arProps['VALUE'];
            }
        }
*/
        $upFields = array("COMMENTS" => $arFields["USER_DESCRIPTION"]);
        CSaleOrder::Update($ID, $upFields);
        /*if(count($AddComment) > 0){
            $upFields = array("COMMENTS" => implode(COption::GetOptionString("htmls.ordercomment", "SPS_SEPARATOR", ", "), $AddComment));
            CSaleOrder::Update($ID, $upFields);
        }*/
    }

}



class UpdateElement
{
    // создаем обработчик события "OnAfterIBlockElementUpdate"
    function RatingProduct(&$arFields)
    {
        //id инфоблока отзывов 8
        if($arFields['IBLOCK_ID'] == 8)
        {
            $section_id = 0;
            $arSelect = Array("IBLOCK_SECTION_ID");
            $arFilter = Array("ID"=>$arFields['ID'], "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arResult = $ob->GetFields();
                $section_id= $arResult['IBLOCK_SECTION_ID'];
            }
            /*Получаем рейтинги*/
            $ratings = self::listElementReviewsRating($arFields['IBLOCK_ID'],$section_id);
            $sum_rating = 0;
            /*Считаем рейтинг*/
            foreach($ratings as $rat)
            {
                $sum_rating += $rat;
            }
            $rating = $sum_rating/count($ratings);
            /*получаем символьный код раздела для связи его с товаром*/
            $res = CIBlockSection::GetByID($section_id);
            if($ar_res = $res->GetNext())
                $code = $ar_res['CODE'];
            /*Получаем id нужного товара для установки его рейтинга*/
            $arSelect = Array("ID", "NAME", "CODE");
            $arFilter = Array("IBLOCK_ID"=>7, "ACTIVE"=>"Y", "CODE"=>$code);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arResult = $ob->GetFields();
                $PRODUCT_ID = $arResult['ID'];
            }
            /*Устаналиваем рейтинг*/
            CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "rating", $rating);
            CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "vote_count", count($ratings));
        }
    }
    /*Получить все активные значения рейтингов*/
    function listElementReviewsRating($id_iblock,$id_section)
    {
        CModule::IncludeModule('iblock');
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
        $arFilter = Array("IBLOCK_ID"=>$id_iblock, "SECTION_ID"=>$id_section,  "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        $ratings = array();
        while($ob = $res->GetNextElement())
        {
            //$arFields = $ob->GetFields();
            $arProp = $ob->GetProperties();
            $ratings[]= $arProp['RATING']['VALUE'];
        }
        return $ratings;
    }
}
?>