<?php
CModule::IncludeModule("bannergrid");
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arClasses=array(
    "CBannerGrid"=>"classes/general/cbannergrid.php"
);

CModule::AddAutoloadClasses("bannergrid",$arClasses);