<?
Class zakrepisettigs extends CModule
{
    var $MODULE_ID = "zakrepisettigs";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function zakrepisettigs()
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
    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        RegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","zakrepisettigs","cSettingsTemplates","onBeforeElementUpdateHandler");
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля zakrepiSettings", $DOCUMENT_ROOT."/local/modules/zakrepisettigs/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        UnRegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","zakrepisettigs","cSettingsTemplates","onBeforeElementUpdateHandler");
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Удаление модуля zakrepiSettings", $DOCUMENT_ROOT."/local/modules/zakrepisettigs/install/unstep.php");
        return true;
    }
}