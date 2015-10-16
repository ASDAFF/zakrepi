<?
Class useraddress extends CModule
{
    var $MODULE_ID = "useraddress";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function useraddress()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME = "Адреса пользователей";
        $this->MODULE_DESCRIPTION = "Модуль позволяет добавить несколько адресов одному пользователю";
    }
    /*Установка таблицы*/
    function InstallDB()
    {
        global $DB;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/local/modules/userAddress/install/db/mysql/install.sql");
        return true;
    }
    /*Копирование дополнительных файлов*/
    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/userAddress/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
        return true;
    }

    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        // Install events
        $this->InstallDB();
        $this->InstallFiles();
       // RegisterModuleDependences("main","OnAfterIBlockElementUpdate","bannerGrid","cBannerGrid","onBeforeElementUpdateHandler");
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля userAddress", $DOCUMENT_ROOT."/local/modules/userAddress/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        //UnRegisterModuleDependences("main","OnAfterIBlockElementUpdate","bannerGrid","cBannerGrid","onBeforeElementUpdateHandler");
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Удаление модуля userAddress", $DOCUMENT_ROOT."/local/modules/userAddress/install/unstep.php");
        return true;
    }
}