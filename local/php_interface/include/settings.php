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

        $obCache->EndDataCache(array('arZSettings' => $arZSettings));
    }
?>