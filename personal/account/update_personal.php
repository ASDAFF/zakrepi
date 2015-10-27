<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Изменение личных данных');
?>
    <?if(!$USER->IsAuthorized()):
        header("Location: /personal/");
        exit();
    endif;?>
    update personal
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>