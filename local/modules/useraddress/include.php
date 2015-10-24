<?php
CModule::IncludeModule("useraddress");
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arClasses=array(
    "CUserAddress"=>"classes/general/cUserAddress.php"
);

CModule::AddAutoloadClasses("useraddress",$arClasses);