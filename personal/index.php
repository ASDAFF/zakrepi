<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Моя учетная запись');
?>
    <?if($USER->IsAuthorized()):
        header("Location: /personal/account/");
        exit();
endif;?>
    <div class="workarea">
    <?
           
    ?>
        <div class="page-title">Вход</div>
         <?if($_GET['registration'] =='yes')
            {?>
            
                <div class="row">
                    <div class="col l7">
                        <div class="base-card ok-box">
                            <div class="title big-text">Вы были успешно зарегистрированы.</div>
                            <div class="card-content no-g-padding">
                                <p class="medium-text">На указанный в форме e-mail было выслано письмо с информацией о подтверждении регистрации.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
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