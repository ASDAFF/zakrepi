<?php
define("ADMIN_MODULE_NAME", "useraddress");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/useraddress/include.php");

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$module_id = "useraddress";
$maxCountAddress =  COption::GetOptionString($module_id, 'zCount', 6);

if(!Main\Loader::includeModule($module_id))
{
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
    ShowError(Loc::getMessage("SEO_ERROR_NO_MODULE"));
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
$APPLICATION->SetTitle(Loc::getMessage("USER_ADDRESS_TITLE"));

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $update = (isset($_POST['UPDATE'])) ? 'Y' : 'N';
    if($update == 'Y'){
        $res = CUserAddress::updateUserAddress($_POST);
        if($res == 'OK')
        {
        ?>
        <div class="adm-info-message-wrap adm-info-message-green">
            <div class="adm-info-message">
                <?=Loc::getMessage("USER_ADDRESS_OK_UPDATE")?>
                <div class="adm-info-message-icon"></div>
            </div>
        </div>
        <?
        }
        else{
        ?>
            <div class="adm-info-message-wrap adm-info-message-red">
                <div class="adm-info-message">
                    <?=Loc::getMessage("USER_ADDRESS_ERROR")?>
                    <div class="adm-info-message-icon"></div>
                </div>
            </div>
        <?
        }
    }
    $add = (isset($_POST['ADD'])) ? 'Y' : 'N';
    if($add == 'Y'){
            $res = CUserAddress::setUserAddress($_POST);
            if($res == 'OK')
            {
                ?>
                <div class="adm-info-message-wrap adm-info-message-green">
                    <div class="adm-info-message">
                        <?=Loc::getMessage("USER_ADDRESS_OK_UPDATE")?>
                        <div class="adm-info-message-icon"></div>
                    </div>
                </div>
            <?
            }
            else{
                ?>
                <div class="adm-info-message-wrap adm-info-message-red">
                    <div class="adm-info-message">
                        <?=Loc::getMessage("USER_ADDRESS_ERROR")?>
                        <div class="adm-info-message-icon"></div>
                    </div>
                </div>
            <?
            }

    }
}
$dbUsers = CUserAddress::getUsersId();
?>
<link rel="stylesheet" href="/local/modules/useraddress/lib/css/style.css">
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>Адреса</th>
            </tr>
        </thead>
        <tbody>
        <?
            /*user*/
            foreach($dbUsers->arResult as $user){
                /*address user*/
                ?>
                    <tr>
                        <td>
                            <b><?=$user['NAME']?> <?=$user['LAST_NAME']?></b> (<?=$user['LOGIN']?>)
                        </td>
                        <td id="user_address_<?=$user['ID']?>" class="rel">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Город</th>
                                        <th>Улица</th>
                                        <th>Дом</th>
                                        <th>Корпус</th>
                                        <th>Квартира</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $dbUserAddress = CUserAddress::getAddressUser($user['ID']);
                                    foreach($dbUserAddress as $address)
                                    {
                                    ?>
                                        <tr  <?if($address['DEFAULT_ADDRESS'] == 'Y'):?>class="default"<?endif;?>>
                                            <td><?=$address['CITY']?></td>
                                            <td><?=$address['STREET']?></td>
                                            <td><?=$address['HOME']?></td>
                                            <td><?=$address['HOUSING']?></td>
                                            <td><?=$address['FLAT']?></td>
                                            <td class="icon">
                                                <a href="/bitrix/admin/user_address_edit.php?ID=<?=$address['ID']?>"><i class="icon-pencil"></i></a>
                                                <?if($address['DEFAULT_ADDRESS'] != 'Y'):?>
                                                    <span onclick="removed(<?=$address['ID']?>,<?=$user['ID']?>);"><i class="icon-remove"></i></span>                                                <?endif;?>
                                                <?if($address['DEFAULT_ADDRESS'] == 'Y'):?>
                                                    <span class="def">По умолчанию</span>
                                                <?endif;?>
                                            </td>
                                        </tr>
                                    <?
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?if(count($dbUserAddress) < IntVal($maxCountAddress)):?>
                                <div style="text-align: right;">
                                    <a class="adm-btn adm-btn-add" href="/bitrix/admin/user_address_add.php?ID_USER=<?=$user['ID']?>">Добавить</a>
                                </div>
                            <?endif?>
                            <div class="bg-reload" id="bg-reload-<?=$user['ID']?>">
                                <img src="/local/modules/useraddress/lib/images/loader.png"/>
                            </div>
                        </td>
                    </tr>
                <?
            }
        ?>
        </tbody>
    </table>
</div>
<?
    echo $dbUsers->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию
    while($dbUsers->NavNext(true, "f_")) :
        echo "[".$f_ID."] (".$f_LOGIN.") ".$f_NAME." ".$f_LAST_NAME."<br>";
    endwhile;
?>
<script src="/local/modules/useraddress/lib/js/jquery-1.11.3.min.js"></script>
<script>
    function removed(id,user_id)
    {
        $('#bg-reload-'+user_id).show();
        $.ajax({
            type: "POST",
            url: '/local/modules/useraddress/lib/function/remove_address_user.php',
            data: "id=" + id +"&user_id="+user_id,
            success: function(msg){
                $('#bg-reload-'+user_id).hide();
                $('#user_address_'+user_id).html(msg);
            }
        });
    }
</script>