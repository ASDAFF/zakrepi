<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="page-title">
	Вход
</div>
	<?
	   ShowMessage($arParams["~AUTH_RESULT"]);
	   //ShowMessage($arResult['ERROR_MESSAGE']);
	?>
<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>
    <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?endforeach?>
    <input type="hidden" name="AUTH_FORM" value="Y" />
    <input type="hidden" name="TYPE" value="AUTH" />

    <div class="row">
        <div class="col l7">
            <div class="base-card authorize-form">
                <div class="title big-text">Войти, используя аккаунт</div>
                <p>
                    <?
                    if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
                        ShowMessage($arResult['ERROR_MESSAGE']);
                    ?>
                </p>
                <div class="card-content">

                    <div class="table-field">
                        <label class="label">Электронная почта</label>
                        <div class="field"><input name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" type="text" /></div>
                    </div>
                    <div class="table-field">
                        <label class="label">Пароль</label>
                        <div class="field"><input type="password" name="USER_PASSWORD" maxlength="50" autocomplete="off" /></div>
                    </div>
                    <div class="table-field">
                        <div class="second-field">
                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="Login" class="btn primary big fullwidth" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
        </div>
        <div class="col l4">
            <div class="base-card">
                <div class="card-content no-h-padding">Нет аккаунта? <a href="/personal/registration/"><?=GetMessage("AUTH_REGISTER")?></a></div>
            </div>
            <div class="base-card soc-login">
                <div class="title big-text">Войти через соц. сеть</div>
                <div class="card-content">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "soc-zakrepi-auth",
                        array(
                            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                            "AUTH_URL"=>$arResult["AUTH_URL"],
                            "POST"=>$arResult["POST"],
                            "POPUP"=>"N",
                            "SUFFIX"=>"form",
                        ),
                        $component,
                        array("HIDE_ICONS"=>"Y")
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
