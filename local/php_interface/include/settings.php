<?php
	//Свойства, которые надо бы вынести в настройки и значения которых должны по идее зависеть от выбранного города
    //Свойства сайта в модуле "Настройка свойств сайта" Данные свойства закешированы
    $module_id = "zakrepisettigs";

    $obCache = new CPHPCache();
    $cacheLifetime = 86400*7;
    $cacheID = 'ZSettings'; $cachePath = '/'.$cacheID;

    if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
    {
        $vars = $obCache->GetVars();
        extract($vars);
        // или же
        $arZSettings = $vars['arZSettings'];
        
        define("ORDER_MIN_SUMM", $arZSettings['ORDER_MIN_SUMM']); //минимальная сумма заказа 
        define("FREE_DELIVERY_SUMM", $arZSettings['FREE_DELIVERY_SUMM']); //сумма заказа для бесплатной доставки 
    }
    elseif( $obCache->StartDataCache()  )
    {

        $arZSettings['PHONE'] = COption::GetOptionString($module_id, 'zPhoneSite');
        $arZSettings['PHONE_CALLTO']=COption::GetOptionString($module_id, 'zPhoneSiteCallTo');
        $arZSettings['TIME_WORK'] = COption::GetOptionString($module_id, 'zTimeWork');
        $arZSettings['TIME_SLIDER'] = COption::GetOptionString($module_id, 'zTimeSlider',3000);
        $arZSettings['CATALOG_ID'] = COption::GetOptionString($module_id, 'zCatalogId',6);

        /*social*/
        if(COption::GetOptionString($module_id, 'zSocFB','')!='')  {
            $arZSettings['SOCIAL']['FB']['LINK'] = COption::GetOptionString($module_id, 'zSocFB','');
            $arZSettings['SOCIAL']['FB']['ID_SVG'] = '#fb';
			$arZSettings['SOCIAL']['FB']['CLASS'] = 'fb';
        }
        if(COption::GetOptionString($module_id, 'zSocVK','')!='')  {
            $arZSettings['SOCIAL']['VK']['LINK'] = COption::GetOptionString($module_id, 'zSocVK','');
            $arZSettings['SOCIAL']['VK']['ID_SVG'] = '#vk';
			$arZSettings['SOCIAL']['VK']['CLASS'] = 'vk';
        }
        if(COption::GetOptionString($module_id, 'zSocOK','')!='')  {
            $arZSettings['SOCIAL']['OK']['LINK'] = COption::GetOptionString($module_id, 'zSocOK','');
            $arZSettings['SOCIAL']['OK']['ID_SVG'] = '#ok';
			$arZSettings['SOCIAL']['OK']['CLASS'] = 'ok';
        }
        if(COption::GetOptionString($module_id, 'zSocYouTube','')!='')  {
            $arZSettings['SOCIAL']['YOUTUBE']['LINK'] = COption::GetOptionString($module_id, 'zSocYouTube','');
            $arZSettings['SOCIAL']['YOUTUBE']['ID_SVG'] = '#yt';
			$arZSettings['SOCIAL']['YOUTUBE']['CLASS'] = 'yt';
        }

        $arZSettings['ORDER_MIN_SUMM'] = COption::GetOptionString($module_id, 'zOrderMinSumm',1000);
        $arZSettings['FREE_DELIVERY_SUMM'] = COption::GetOptionString($module_id, 'zFreeDeliverySumm',10000);

        $arZSettings['YANDEX_METRIKA'] = COption::GetOptionString($module_id, 'zYandexMetrik');
        $arZSettings['GOOGLE_ANALYTICS'] = COption::GetOptionString($module_id, 'zGoogleAnalytics');

        define("ORDER_MIN_SUMM", $arZSettings['ORDER_MIN_SUMM']); //минимальная сумма заказа 
        define("FREE_DELIVERY_SUMM", $arZSettings['FREE_DELIVERY_SUMM']); //сумма заказа для бесплатной доставки 
       /*end social*/



        $obCache->EndDataCache(array('arZSettings' => $arZSettings));
    }
?>