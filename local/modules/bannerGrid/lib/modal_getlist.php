<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule('bannergrid');
    $banner = CBannerGrid::getAllElementIblock();
    $num = $_POST['num'];
?>
    <div class="close_modal" onclick="closeModal();"><img src="/local/modules/bannergrid/images/close-modal.png"/></div>
    <select id="banner-select">
        <option value="null">
            Ничего не выбрано
        </option>
        <?foreach($banner as $item):?>
            <option value="<?=$item['ID']?>">
                <?=$item['NAME'];?> | ID:<?=$item['ID']?>
            </option>
        <?endforeach;?>
    </select>
    <input type="button" id="apply_banner_list" class="adm-btn" value="Применить" onclick="applyBanner(<?=$num?>);"/>
