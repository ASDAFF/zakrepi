<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Моя учетная запись');
?>
    <?if($USER->IsAuthorized()):
        header("Location: /personal/account/");
        exit();
endif;?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>