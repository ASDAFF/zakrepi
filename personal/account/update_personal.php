<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Изменение личных данных');
?>
    <?if(!$USER->IsAuthorized()):
        header("Location: /personal/");
        exit();
    endif;?>
    <div class="breadcrumbs">
        <a href="/personal/account/">Вернуться в личный кабинет</a>
    </div>
<div class="workarea">
    <h1 class="page-title">Редактирование личных данных</h1>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.profile",
        "profile-zakrepi-update",
        Array(
            "COMPONENT_TEMPLATE" => ".default",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "SET_TITLE" => "Y",
            "USER_PROPERTY" => array(),
            "SEND_INFO" => "N",
            "CHECK_RIGHTS" => "N",
            "USER_PROPERTY_NAME" => ""
        )
    );?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>