<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>
    <div id="address-list">
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/personal/address/list.php')?>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>