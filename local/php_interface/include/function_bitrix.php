<?
/*Пересчет рейтинга товара*/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("UpdateElement", "RatingProduct"));
AddEventHandler("iblock", "OnAfterIBlockElementDelete", Array("UpdateElement", "RatingProduct"));

//Добавление комментария к заказу
AddEventHandler("sale", "OnSaleComponentOrderOneStepComplete",Array("CommentOrder", "OrderCommentPlus"));
AddEventHandler("sale", "OnSaleComponentOrderComplete", Array("CommentOrder", "OrderCommentPlus"));

//Добавление параметров при отправки писем
// Событие вызывается перед отправкой письма о новом заказе
AddEventHandler("sale", "OnOrderNewSendEmail", array('ZakrepiSaleOrder', "OnOrderNewSendEmailHandler"));
//Перед отправкой присьма о смене статуса
//AddEventHandler("sale", "OnOrderStatusSendEmail", array('ZakrepiSaleOrder', "OnSaleStatusEMailHandler"));


class ZakrepiSaleOrder
{
    function OnOrderNewSendEmailHandler($orderID, &$eventName, &$arFields)
    {
        // Поменять вид списка товаров
        if (!CModule::IncludeModule('sale') || !CModule::IncludeModule('catalog')) return;
        //global $pre_defined_variables, $DB;

        $arOrder = CSaleOrder::GetById($orderID);

        $dbBasketItems = CSaleBasket::GetList(array("NAME" => "ASC"), array("ORDER_ID" => $orderID), false, false, array("ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "DETAIL_PAGE_URL"));
        $strOrderList = "";
        $strOrderList .= '<table width="100%">';
        $strOrderList .= '<thead><tr>';
        foreach(array("Название","Количество","Цена","Сумма") as $th) $strOrderList .= '<th>'.$th.'</th>';
        $strOrderList .= '</tr></thead>';

        $strOrderList .= '<tbody>';

        $price_total = 0;
        $arBasketItems = array();
        while ($arBasketItem = $dbBasketItems->Fetch())
        {
            $dbProp = CSaleBasket::GetPropsList(Array("SORT" => "ASC", "NAME" => "ASC"), Array("BASKET_ID" => $arBasketItem["ID"], "!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")));
            while($arProp = $dbProp -> GetNext())
                $arBasketItem["PROPS"][] = $arProp;
            $arBasketItems[] = $arBasketItem;

            $strOrderList .= '<tr>';
            $strOrderList .= '<td>';
            $strOrderList .= '<a href="http://www.zakrepi.ru'.$arBasketItem["DETAIL_PAGE_URL"].'" target="_blank">'.$arBasketItem["NAME"].'</a>';
            // Из свойств товара заказа показать лишь стандартные и название филиала
            foreach($arBasketItem['PROPS'] as &$arProp)
            {
                $strOrderList .= '<div style="font-size:80%">'.$arProp['NAME'].': '.$arProp['VALUE'].'</div>';
            }
            $strOrderList .= '</td>';
            $strOrderList .= '<td style="text-align: center;">'.$arBasketItem["QUANTITY"].'&nbsp;шт.</td>';
            $strOrderList .= '<td style="text-align: center;">'.SaleFormatCurrency($arBasketItem["PRICE"], $arBasketItem["CURRENCY"]).'</td>';
            $strOrderList .= '<td style="text-align: center;">'.SaleFormatCurrency($arBasketItem["PRICE"] * $arBasketItem["QUANTITY"], $arBasketItem["CURRENCY"]).'</td>';
            $strOrderList .= '</tr>';
            $price_total += $arBasketItem["PRICE"] * $arBasketItem["QUANTITY"];
            $price_currency = $arBasketItem["CURRENCY"];
        }
        $price_total_formatted = $price_currency? SaleFormatCurrency($price_total, $price_currency): '0';
        $strOrderList .= '<tr><td colspan="3" style="text-align:right;">Общая стоимость:&nbsp;</td><td style="text-align: center;">'.$price_total_formatted.'</td></tr>';


        //Получаем стоимость доставки цену и общую сумму вместе с ценой доставки

        // Указываем способ доставки
        // $arOrder['PRICE'] - Общая стоимость
        $arFields['DELIVERY'] = '';
        if (strlen($arOrder['DELIVERY_ID']))
        {

            if (is_string($arOrder['DELIVERY_ID']))
            {

                $sid = explode(":", $arOrder['DELIVERY_ID']);
                $dbDeliv = CSaleDeliveryHandler::GetBySID($sid[0]);
                $arDeliv = $dbDeliv->GetNext();
                $arFields['DELIVERY'] = '<p><b>Способ доставки:</b> '.$arDeliv['NAME'].'</p>';
                $price_total += $arOrder['PRICE_DELIVERY'];

                $strOrderList .= '<tr><td colspan="3" style="text-align:right;">Стоимость доставки:&nbsp;</td><td style="text-align: center;">'.SaleFormatCurrency($arOrder['PRICE_DELIVERY'], $price_currency).'</td></tr>';

                $strOrderList .= '<tr><td colspan="3" style="text-align:right;">Итого:&nbsp;</td><td style="text-align: center;">'.SaleFormatCurrency($price_total, $price_currency).'</td></tr>';

                $arFields['ALL_PRICE'] = '<p><b>Итого: </b>'.SaleFormatCurrency($price_total, $price_currency).'</p>';
            }
            else{
                $arDelivery = CSaleDelivery::GetById($arOrder['DELIVERY_ID']);
                if ($arDelivery)
                {
                    $value = $arDelivery['NAME'];
                    $value_name = $arDelivery['NAME'];
                    $value_price = '';
                    if ($arDelivery['PRICE']<=0)
                    {
                        $value .= ', Бесплатно';
                        $value_price = 'Бесплатно';
                    }
                    else
                    {
                        $value .= ', '.SaleFormatCurrency($arDelivery['PRICE'], $arDelivery['CURRENCY']);

                        $value_price = SaleFormatCurrency($arDelivery['PRICE'], $arDelivery['CURRENCY']);

                        $strOrderList .= '<tr><td colspan="3" style="text-align:right;">Стоимость доставки:&nbsp;</td><td style="text-align: center;">'.$value_price.'</td></tr>';
                    }
                    $arFields['DELIVERY'] = '<p><b>Способ доставки:</b> '.$value_name.'</p>';
                    $price_total += $arDelivery['PRICE'];

                    $strOrderList .= '<tr><td colspan="3" style="text-align:right;">Итого:&nbsp;</td><td style="text-align: center;">'.SaleFormatCurrency($price_total, $price_currency).'</td></tr>';

                    $arFields['ALL_PRICE'] = '<p><b>Итого: </b>'.SaleFormatCurrency($price_total, $price_currency).'</p>';
                }
            }
        }


        $strOrderList .= '</tbody>';
        $strOrderList .= '</table>';
        $arFields["ORDER_LIST_NEW"] = $strOrderList;



        // Указываем свойства заказа - Начало
        /* $arProps = array();
         $dbProps = CSaleOrderPropsValue::GetOrderProps($orderID);
         while ($arProp = $dbProps->Fetch())
         {
             $arProps[$arProp['CODE']] = $arProp;

             $val = $arProp['VALUE'];
             if ($arProp['TYPE']=="LOCATION") {
                 $v = CSaleLocation::GetByID($val);
                 $val = $v['CITY_NAME_LANG'];
             } elseif (in_array($arProp['TYPE'], array("SELECT", "MULTISELECT", "RADIO"))) {
                 $v = CSaleOrderPropsVariant::GetByValue($arProp['ORDER_PROPS_ID'], $val);
                 $val = $v['NAME'];
             }

             $arProp['VALUE_FORMATTED'] = $val;

         }*/

        // Получаем список исключенных свойств в зависимости от выбранной службы доставки
        /*$delivery_id = $arOrder['DELIVERY_ID'];
        $EXCLUDE_PROPS = $pre_defined_variables['ORDER_MAKE']["EXCLUDE_PROP_ON_DELIVERY_ID"];
        if (array_key_exists($delivery_id, $EXCLUDE_PROPS))
            $EXCLUDE_PROP = $EXCLUDE_PROPS[$delivery_id];
        else
            $EXCLUDE_PROP = array();
        $EXCLUDE_PROP = array_merge(array('AGREE'), $EXCLUDE_PROP);

        // Выводим свойства
        $strPropsList = '';
        foreach($arProps as $prop_code=>&$arProp)
        {
            if (in_array($prop_code, $EXCLUDE_PROP)) continue;

            $strPropsList .= '<p>';
            $value = strlen(trim($arProp['VALUE']))? $arProp['VALUE']: '<i>не указано</i>';
            $strPropsList .= '<b>'.$arProp['NAME'].':</b> '.$value;
            $strPropsList .= '</p>';
        }
        $arFields['PROPS_LIST'] = $strPropsList;*/
        // Указываем свойства заказа - Конец



        // Указываем способ оплаты
        $arFields['PAY_SYSTEM'] = '';
        if (strlen($arOrder['PAY_SYSTEM_ID']))
        {
            $arPaySystem = CSalePaySystem::GetByID($arOrder['PAY_SYSTEM_ID'], $arOrder['PERSON_TYPE_ID']);
            if ($arPaySystem)
            {
                $value = strlen(trim($arPaySystem['PSA_NAME']))? $arPaySystem['PSA_NAME']: $arPaySystem['NAME'];
                if($arOrder['PAY_SYSTEM_ID'] == 1 || $arOrder['PAY_SYSTEM_ID'] == 2)
                {
                    $arFields['PAY_SYSTEM'] = '<p><b>Способ оплаты:</b> <a href="http://www.zakrepi.ru/checkout/?ORDER_ID='.$orderID.'" target="_blank">'.$value.'</a></p>';
                }
                else
                {
                    $arFields['PAY_SYSTEM'] = '<p><b>Способ оплаты:</b> '.$value.'</p>';
                }
            }
        }

        // Получаем склад, указанный при доставке
        $arFields['STORE_LIST'] = '';
        $arFields['STORE_LIST_NEUTRAL'] = '';
        $arFields['STORE_EMAIL'] = '';
        $arStores = array();



        if ($arOrder['DELIVERY_ID'] == 1)
        {
            $dbStores = CCatalogStore::GetList(array(), array('ID'=>1), false, false, array());
            $arStore = $dbStores->Fetch();


            $strStoreList = '';
            if ($arStore)
            {
                // Получаем свойства склада в нужном порядке
                $prop_codes = array('TITLE'=>'', 'ADDRESS'=>'Адрес', 'PHONE'=>'Телефон', 'SCHEDULE'=>'Время работы');
                // Выводим склад
                $strStoreList = '<span style="font-size: 90%">';
                $have_value = false; $prev_value = false;
                foreach($prop_codes as $prop_code=>&$name)
                {
                    if ($prev_value)
                    {
                        $strStoreList .= ', ';
                        $prev_value = false;
                    }

                    if (strlen(trim($arStore[$prop_code])))
                    {
                        $have_value = true;
                        if (strlen($name))
                        {
                            $strStoreList .= $name.': ';
                        }
                        $strStoreList .= trim($arStore[$prop_code]);
                        $prev_value = true;
                    }

                }
                $strStoreList .= '</span><br />';
                // Добавляем поле списка складов в почтовый шаблон
                //$arFields['STORE_LIST_NEUTRAL'] = '<p>Указанный '$strStoreList;
                if (strlen($have_value))
                {
                    $arFields['STORE_LIST_NEUTRAL'] = '<p><b>Пункт выдачи:</b></p>' . $strStoreList;
                    $arFields['STORE_LIST'] = '<p><b>Пожалуйста, сообщите номер вашего заказа для оплаты по адресу:</b></p>' . $strStoreList;
                }

            }
        }
        else if($arOrder['DELIVERY_ID'] > 1)
        {
            $strStoreList = '';
            $arOrderProps = CSaleOrderPropsValue::GetOrderProps($arOrder['ID']);
            while ($arProps = $arOrderProps->Fetch())
            {
                switch ($arProps['CODE']) {
                    case 'CITY':
                        $strStoreList .= $arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'STREET':
                        $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'HOUSE':
                        $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'KORPUS':
                        if($arProps['VALUE']!='')
                            $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'FLAT':
                        if($arProps['VALUE']!='')
                            $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                }
            }

            $arFields['STORE_LIST_NEUTRAL'] = '<div><p><b>Доставка по адресу:</b></p>' . $strStoreList.'</div>';
        }
        else if(is_string($arOrder['DELIVERY_ID']))
        {
            $strStoreList = '';
            $arOrderProps = CSaleOrderPropsValue::GetOrderProps($arOrder['ID']);
            while ($arProps = $arOrderProps->Fetch())
            {
                switch ($arProps['CODE']) {
                    case 'CITY':
                        $strStoreList .= $arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'STREET':
                        $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'HOUSE':
                        $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'KORPUS':
                        if($arProps['VALUE']!='')
                            $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                    case 'FLAT':
                        if($arProps['VALUE']!='')
                            $strStoreList .= '<br/>'.$arProps['NAME'].': '.$arProps['VALUE'];
                        break;
                }
            }

            $arFields['STORE_LIST_NEUTRAL'] = '<div><p><b>Доставка по адресу:</b></p>' . $strStoreList.'</div>';
        }

        //Получение данных пользователя
        $rsUser = CUser::GetByID($arOrder['USER_ID']);
        $arUser = $rsUser->Fetch();

        if(in_array(5, CUser::GetUserGroup($arOrder['USER_ID'])))
        {
            $arFields['STORE_PHONE'] = $arUser['WORK_PHONE'];
            $arFields['STORE_NAME_USER'] = 'Пользователь: '.$arUser['NAME'].' '.$arUser['LAST_NAME'];
        }
        else if(in_array(6, CUser::GetUserGroup($arOrder['USER_ID'])))
        {
            $arFields['STORE_PHONE'] = $arUser['WORK_PHONE'];
            $arFields['STORE_NAME_USER'] = 'Организаци: '.$arUser['WORK_COMPANY'].' Контактное лицо '.$arUser['UF_CONTACT_MANAGER'];
        }
    }
}


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