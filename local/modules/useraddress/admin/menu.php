<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

AddEventHandler("main", "OnBuildGlobalMenu", "userAddress");
function userAddress(&$adminMenu, &$moduleMenu){
    $moduleMenu[] = Array(
        "parent_menu" => "global_menu_store",
        "sort"        => 100,
        "url"         => "user_address_list.php?lang=".LANGUAGE_ID,
        "more_url" => array(
            "user_address_edit.php",
            "user_address_add.php",
        ),
        "text"        => GetMessage("USER_ADDRESS"),
        "icon"        => "sale_menu_icon_buyers", // малая иконка
    );
}
?>