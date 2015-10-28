<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('useraddress');
$id = $_POST['id'];
$user_id = $_POST['user_id'];

if($_POST['remove'] == 'Y') {
    CUserAddress::removeUserAddress($id,$user_id);
    echo 'ok';
}
if($_POST['default'] == 'Y')
{
    CUserAddress::setUserAddressDefault($id,$user_id);
    echo 'ok';
}

?>