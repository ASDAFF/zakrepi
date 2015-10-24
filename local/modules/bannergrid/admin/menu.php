<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

AddEventHandler("main", "OnBuildGlobalMenu", "bannerGridMenu");
function bannerGridMenu(&$adminMenu, &$moduleMenu){
        $moduleMenu[] = Array(
            "parent_menu" => "global_menu_services",
            "sort"        => 100,
            "url"         => "banner_grid_list.php?lang=".LANGUAGE_ID,
            "text"        => GetMessage("BANNER_GRID"),
            "icon"        => "form_menu_icon", // малая иконка
            //"icon"        => "banner_icon", // малая иконка
            //"title"       => GetMessage("KHAYR_COMMENT"),
        );
}
?>