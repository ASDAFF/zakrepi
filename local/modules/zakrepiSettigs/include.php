<?php
CModule::IncludeModule("zakrepiSettigs");
global $DBType;

$arClasses=array(
    'cSettingsTemplates'=>'classes/general/cSettingsTemplates.php'
);

CModule::AddAutoloadClasses("zakrepiSettigs",$arClasses);
