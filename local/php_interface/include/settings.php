<?php
    //Свойства сайта в модуле "Настройка свойств сайта" Данные свойства закешированы
    $module_id = "zakrepiSettigs";

    $obCache = new CPHPCache();
    $cacheLifetime = 86400*7;
    $cacheID = 'ZSettings'; $cachePath = '/'.$cacheID;

    if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
    {
        $vars = $obCache->GetVars();
        extract($vars);
        // или же
        $arZSettings = $vars['arZSettings'];
    }
    elseif( $obCache->StartDataCache()  )
    {

        $arZSettings['PHONE'] = COption::GetOptionString($module_id, 'zPhoneSite');
        $arZSettings['PHONE_CALLTO']=COption::GetOptionString($module_id, 'zPhoneSiteCallTo');
        $arZSettings['TIME_WORK'] = COption::GetOptionString($module_id, 'zTimeWork');
        $arZSettings['TIME_SLIDER'] = COption::GetOptionString($module_id, 'zTimeSlider',3000);

        /*social*/
        if(COption::GetOptionString($module_id, 'zSocFB','')!='')  {
            $arZSettings['SOCIAL']['FB']['LINK'] = COption::GetOptionString($module_id, 'zSocFB','');
            $arZSettings['SOCIAL']['FB']['ID_SVG'] = '#fb';
        }
        if(COption::GetOptionString($module_id, 'zSocVK','')!='')  {
            $arZSettings['SOCIAL']['VK']['LINK'] = COption::GetOptionString($module_id, 'zSocVK','');
            $arZSettings['SOCIAL']['VK']['ID_SVG'] = '#vk';
        }
        if(COption::GetOptionString($module_id, 'zSocOK','')!='')  {
            $arZSettings['SOCIAL']['OK']['LINK'] = COption::GetOptionString($module_id, 'zSocOK','');
            $arZSettings['SOCIAL']['OK']['ID_SVG'] = '#ok';
        }
        if(COption::GetOptionString($module_id, 'zSocYouTube','')!='')  {
            $arZSettings['SOCIAL']['YOUTUBE']['LINK'] = COption::GetOptionString($module_id, 'zSocYouTube','');
            $arZSettings['SOCIAL']['YOUTUBE']['ID_SVG'] = '#youtube';
        }
       /*end social*/



        $obCache->EndDataCache(array('arZSettings' => $arZSettings));
    }
?>