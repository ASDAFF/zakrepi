<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule('useraddress');
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];

    $module_id = "useraddress";
    $maxCountAddress =  COption::GetOptionString($module_id, 'zCount', 6);

    $res = CUserAddress::removeUserAddress($id,$user_id);

    $dbUserAddress = CUserAddress::getAddressUser($user_id)
?>
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
                    <span onclick="remove(<?=$address['ID']?>,<?=$user_id?>);"><i class="icon-remove"></i></span>
                <?endif;?>
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
        <a class="adm-btn adm-btn-add" href="/bitrix/admin/user_address_add.php?ID_USER=<?=$user_id?>">Добавить</a>
    </div>
<?endif?>
<div class="bg-reload" id="bg-reload-<?=$user_id?>">
    <img src="/local/modules/useraddress/lib/images/loader.png"/>
</div>