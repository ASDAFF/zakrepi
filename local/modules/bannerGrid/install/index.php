<?
Class bannergrid extends CModule
{
    var $MODULE_ID = "bannergrid";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function bannergrid()
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
        $this->MODULE_NAME = "Баннерная сетка";
        $this->MODULE_DESCRIPTION = "Модуль позволяет вывести элементы банерной сетки";
    }
    /*Установка таблицы*/
    function InstallDB()
    {
        global $DB;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/local/modules/bannerGrid/install/db/mysql/install.sql");
        return true;
    }
    /*Копирование дополнительных файлов*/
    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/bannerGrid/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
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
        $APPLICATION->IncludeAdminFile("Установка модуля bannerGrid", $DOCUMENT_ROOT."/local/modules/bannerGrid/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        //UnRegisterModuleDependences("main","OnAfterIBlockElementUpdate","bannerGrid","cBannerGrid","onBeforeElementUpdateHandler");
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Удаление модуля bannerGrid", $DOCUMENT_ROOT."/local/modules/bannerGrid/install/unstep.php");
        return true;
    }
}