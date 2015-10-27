<?
Class cityfranchise extends CModule
{
    var $MODULE_ID = "cityfranchise";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function cityfranchise()
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
        $this->MODULE_NAME = "Модуль городов и адресов франчайзинга";
        $this->MODULE_DESCRIPTION = "Модуль позволяет добавить несколько адресов одному пользователю";
    }
    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        // Install events
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля CityFranchise", $DOCUMENT_ROOT."/local/modules/cityfranchise/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Удаление модуля CityFranchise", $DOCUMENT_ROOT."/local/modules/cityfranchise/install/unstep.php");
        return true;
    }
}