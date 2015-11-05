<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Моя учетная запись');
?>
    <?if($USER->IsAuthorized()):
        header("Location: /personal/account/");
        exit();
endif;?>
    <div class="workarea">
        <div class="page-title">Вход</div>

        <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","zakrepi-auth",Array(
                "REGISTER_URL" => "/personal/registration/",
                "FORGOT_PASSWORD_URL" => "/personal/auth/",
                "PROFILE_URL" => "/personal/account/",
                "SHOW_ERRORS" => "Y"
            )
        );?>


    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>