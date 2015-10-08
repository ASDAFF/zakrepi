<?
Class zakrepiSettigs extends CModule
{
    var $MODULE_ID = "zakrepiSettigs";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function zakrepiSettigs()
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
        $this->MODULE_NAME = "Настройка свойств сайта";
        $this->MODULE_DESCRIPTION = "Модуль позволяет настроить основные настройки сайта(телефон,время работы и пр.)";
    }
    /*Установка таблицы*/
    /*function InstallDB()
    {
        global $DB;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/local/modules/zakrepi.settings/install/db/mysql/install.sql");
        return true;
    }*/
    /*Копирование дополнительных файлов*/
    /*function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/zakrepi.settigs/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
        //CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/cradobaners/install/panel/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default", true, true);
        return true;
    }*/

    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        // Install events
        //$this->InstallDB();
        //$this->InstallFiles();
        RegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","zakrepiSettings","cSettingsTemplates","onBeforeElementUpdateHandler");
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля zakrepiSettings", $DOCUMENT_ROOT."/local/modules/zakrepiSettigs/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        UnRegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","zakrepiSettings","cSettingsTemplates","onBeforeElementUpdateHandler");
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Удаление модуля zakrepiSettings", $DOCUMENT_ROOT."/local/modules/zakrepiSettigs/install/unstep.php");
        return true;
    }
}