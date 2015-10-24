<?php
define("ADMIN_MODULE_NAME", "useraddress");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/useraddress/include.php");

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$module_id = "useraddress";

if(!Main\Loader::includeModule($module_id))
{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
    ShowError(Loc::getMessage("SEO_ERROR_NO_MODULE"));
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
$id_user = $_GET['ID_USER'];
$dbAddress = CUserAddress::getAddressId($id);

$dbUser = CUser::GetByID($id_user);
$arUser = $dbUser->Fetch();


$dbUserAddress = CUserAddress::getAddressUser($id_user);
$count = count($dbUserAddress);

$APPLICATION->SetTitle('Редактирование адреса пользователя '.$arUser['NAME'].' '.$arUser['LAST_NAME'].'('.$arUser['LOGIN'].')');
?>
    <div>
        <form method="POST" action="/bitrix/admin/user_address_list.php">
            <input type="hidden" name="ID_USER" value="<?=$id_user?>">
            <table class="adm-detail-content-table edit-table">
                <?if($count == 0):?>
                    <input type="hidden" name="DEFAULT_ADDRESS" value="Y">
                <?else:?>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="DEFAULT_ADDRESS">По умолчанию</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="checkbox" name="DEFAULT_ADDRESS" <?if($count == 0):?>disabled checked <?endif;?>>
                    </td>
                </tr>
                <?endif;?>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="CITY">Город</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="text" name="CITY" value="">
                    </td>
                </tr>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="STREET">Улица</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="text" name="STREET" value="">
                    </td>
                </tr>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="HOME">Дом</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="text" name="HOME" value="">
                    </td>
                </tr>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="HOUSING">Корпус</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="text" name="HOUSING" value="">
                    </td>
                </tr>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <label for="FLAT">Квартира</label>
                    </td>
                    <td class="adm-detail-content-cell-r">
                        <input type="text" name="FLAT" value="">
                    </td>
                </tr>
            </table>

            <input type="submit" class="adm-btn-green" name="ADD" id="save_and_add" value="<?=Loc::getMessage("USER_ADDRESS_SAVE")?>" />
            <input type="submit" class="button" name="CANCEL" id="save_and_add" value="<?=Loc::getMessage("USER_ADDRESS_CANCEL")?>" />
        </form>
    </div>
<?/*
<pre>
    <?print_r($dbAddress);?>
</pre>
*/?>