<?php

AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");

/*Регистрация нового пользоваателя в нужную группу ФЗ или ЮР*/
function OnBeforeUserUpdateHandler(&$arFields)
{

    if($arFields['UF_USER_TYPE'] == 'fz') {
        $arFields["GROUP_ID"] = array(5);
    }

    elseif($arFields['UF_USER_TYPE'] == 'ur') {
        $arFields["GROUP_ID"] = array(6);
    }
}
?>