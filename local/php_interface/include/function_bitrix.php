<?
/*Пересчет рейтинга товара*/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("UpdateElement", "RatingProduct"));
AddEventHandler("iblock", "OnAfterIBlockElementDelete", Array("UpdateElement", "RatingProduct"));

//Добавление комментария к заказу
AddEventHandler("sale", "OnSaleComponentOrderOneStepComplete",Array("CommentOrder", "OrderCommentPlus"));
AddEventHandler("sale", "OnSaleComponentOrderComplete", Array("CommentOrder", "OrderCommentPlus"));

class CommentOrder{
    function OrderCommentPlus($ID, $arFields){
        $upFields = array("COMMENTS" => $arFields["USER_DESCRIPTION"]);
        $arOrder = CSaleOrder::GetByID($ID);
        if($arOrder['PERSON_TYPE_ID'] == 2)
        {
            //Если Юр лицо добавляем значения реквизитов в заказ для выгрузки в 1С
            $user = $arOrder['USER_ID'];
            $rsUser = CUser::GetByID($user);
            $arUser = $rsUser->Fetch();

            AddOrderProperty('UF_LEGAL_ADDRESS', $arUser['UF_LEGAL_ADDRESS'], $ID);
            AddOrderProperty('UF_INN', $arUser['UF_INN'], $ID);
            AddOrderProperty('UF_KPP', $arUser['UF_KPP'], $ID);
            AddOrderProperty('UF_OKPO', $arUser['UF_OKPO'], $ID);
            AddOrderProperty('UF_OGRN', $arUser['UF_OGRN'], $ID);
            AddOrderProperty('UF_CONTACT_MANAGER', $arUser['UF_CONTACT_MANAGER'], $ID);

            AddOrderProperty('UF_NAME_BANK', $arUser['UF_NAME_BANK'], $ID);
            AddOrderProperty('UF_BIC_BANK', $arUser['UF_BIC_BANK'], $ID);
            AddOrderProperty('UF_CHECKING_ACCOUNT', $arUser['UF_CHECKING_ACCOUNT'], $ID);
            AddOrderProperty('UF_CORR_ACCOUNT', $arUser['UF_CORR_ACCOUNT'], $ID);
            /*
                AddOrderProperty('UF_LEGAL_ADDRESS', $arUser['UF_LEGAL_ADDRESS'], $ID);
                AddOrderProperty('UF_LEGAL_ADDRESS', $arUser['UF_LEGAL_ADDRESS'], $ID);
                AddOrderProperty('UF_LEGAL_ADDRESS', $arUser['UF_LEGAL_ADDRESS'], $ID);
            */
        }
        CSaleOrder::Update($ID, $upFields);
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