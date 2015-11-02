<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
    <?/*
        <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
    */?>
<?endif?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>

<div class="row">
    <div class="col l7">
        <div class="base-card register-form">
            <div class="title big-text">Я регистрируюсь как:</div>
            <div class="card-content">
                <div class="table-field">
                    <p class="first-field">
                        <input type="radio" checked name="REGISTER[UF_USER_TYPE]" value="fz" id="usertype-v1"/>
                        <label class="radio-lbl btn-toggle-block-register" data-type="fl" data-hide-block=".ul-field" data-show-block=".fl-field" for="usertype-v1">Физическое лицо</label>
                    </p>
                    <p class="field">
                        <input type="radio" name="REGISTER[UF_USER_TYPE]" value="ur" id="usertype-v2"/>
                        <label class="radio-lbl btn-toggle-block-register" data-type="ul" data-hide-block=".fl-field" data-show-block=".ul-field" for="usertype-v2">Юридическое лицо</label>
                    </p>
                </div>
                <?/*Фамилия*/?>
                <div class="table-field fl-field">
                    <label class="label">Фамилия</label>
                    <div class="field"><input type="text" class="required" name="REGISTER[LAST_NAME]"/></div>
                </div>

                <?/*Имя*/?>
                <div class="table-field fl-field">
                    <label class="label">Имя</label>
                    <div class="field"><input type="text" class="required" name="REGISTER[NAME]"/></div>
                </div>
                <?/*Наименование организации*/?>
                <div class="table-field ul-field hide">
                    <label class="label">Назв. организации / ИП</label>
                    <div class="field"><input type="text" name="REGISTER[WORK_COMPANY]"/></div>
                </div>
                <?/*Тип организации*/?>
                <div class="table-field ul-field hide">
                    <p class="first-field">
                        <input type="radio" checked name="REGISTER[UF_TYPE_ORGANIZATION]" value="4" id="comptype-v1"/>
                        <label class="radio-lbl" for="comptype-v1">Организация</label>
                    </p>
                    <p class="field">
                        <input type="radio"  name="REGISTER[UF_TYPE_ORGANIZATION]" value="5" id="comptype-v2"/>
                        <label class="radio-lbl" for="comptype-v2">ИП</label>
                    </p>
                </div>
                <?/*Номер телефона*/?>
                <div class="table-field">
                    <label class="label">Номер телефона</label>
                    <div class="field"><span class="tel-before">+7</span><input type="tel" class="required numbers" name="REGISTER[WORK_PHONE]"/></div>
                </div>
                <?/*Электронная почта и логин*/?>
                <div class="table-field">
                    <label class="label">Электронная почта</label>
                    <div class="field">
                        <input type="hidden" name="REGISTER[LOGIN]" id="login-name"/>
                        <input type="email" onchange="setLogin(this)" class="required" id="emailregister" name="REGISTER[EMAIL]"/>
                    </div>
                </div>
                <?/*Юридический адрес*/?>
                <div class="table-field ul-field hide">
                    <label class="label textarea">Юридический адрес</label>
                    <div class="field">
                        <?/*<input type="text" />*/?>
                        <textarea name="REGISTER[UF_LEGAL_ADDRESS]"></textarea>
                    </div>
                </div>
                <?/*Реквизиты организации*/?>
                <div class="requisites_organization ul-field hide">
                    <p class="color-text text-light">Реквизиты организации</p>
                    <div class="table-field cols-2">
                        <span class="label">ИНН / КПП</span>
                        <div class="field"><input type="text" id="inn" class="numbers" name="REGISTER[UF_INN]"/><label for="inn" class="textfield-placeholder">ИНН</label></div>/
                        <div class="field"><input type="text" id="kpp" class="numbers" name="REGISTER[UF_KPP]"/><label for="kpp" class="textfield-placeholder">КПП</label></div>
                    </div>
                    <div class="table-field cols-2">
                        <span class="label">ОГРН / ОКПО</span>
                        <div class="field"><input type="text" id="ogrn" class="numbers" name="REGISTER[UF_OGRN]"/><label for="ogrn" class="textfield-placeholder">ОГРН</label></div>/
                        <div class="field"><input type="text" id="okpo" class="numbers" name="REGISTER[UF_OKPO]"/><label for="okpo" class="textfield-placeholder">ОКПО</label></div>
                    </div>
                </div>
                <?/*Банковские реквизиты*/?>
                <div class="requisites_organization ul-field hide">
                    <p class="color-text text-light">Банковские реквизиты</p>
                    <div class="table-field cols-2">
                        <span class="label">Банк / БИК банка</span>
                        <div class="field"><input type="text" id="bank" name="REGISTER[UF_NAME_BANK]"/><label for="bank" class="textfield-placeholder">Банк</label></div>/
                        <div class="field"><input type="text" id="bik" maxlength="9" class="numbers" name="REGISTER[UF_BIC_BANK]"/><label for="bik" class="textfield-placeholder">БИК банка</label></div>
                    </div>
                    <div class="table-field cols-2">
                        <span class="label">Расчетный счет / Кор. счет</span>
                        <div class="field"><input type="text" id="rs" maxlength="20" class="numbers" name="REGISTER[UF_CHECKING_ACCOUNT]"/><label for="rs" class="textfield-placeholder">Расчетный счет</label></div>/
                        <div class="field"><input type="text" id="ks" maxlength="20" class="numbers" name="REGISTER[UF_CORR_ACCOUNT]"/><label for="ks" class="textfield-placeholder">Кор. счет</label></div>
                    </div>
                </div>
                <?/*Дополнительные параметры*/?>
                <div class="dop_paramentr ul-field hide">
                    <div class="table-field">
                        <span class="label">Сайт организации</span>
                        <div class="field"><input type="text" id="site"/></div>
                    </div>
                    <?/*Контактное лицо*/?>
                    <div class="table-field">
                        <label class="label">Контактное лицо</label>
                        <div class="field"><input type="text" name="REGISTER[UF_CONTACT_MANAGER]"/></div>
                    </div>
                </div>
                <div class="table-field">
                    <label class="label">Ваш пароль</label>
                    <div class="field"><input type="password" class="pass" autocomplete="off" name="REGISTER[PASSWORD]"/></div>
                </div>
                <div class="table-field">
                    <label class="label">Повторите пароль</label>
                    <div class="field"><input type="password" class="pass_inp" autocomplete="off" name="REGISTER[CONFIRM_PASSWORD]"/></div>
                </div>
                <p class="color-text text-light">Нажимая кнопку «Зарегистрироваться», я даю свое согласие на обработку персональных данных в соответствии с <a href="#" class="text-primary">Политикой конфеденциальности</a></p>
            </div>
        </div>
        <input type="submit" class="btn primary big fullwidth" value="Зарегистрироваться" name="register_submit_button">
        <?/*
            <a href="#" class="btn primary big fullwidth">Зарегистрироваться</a>
        */?>
    </div>
</div>
</form>
    <script>
        $(document).ready(function(){

            var fl = new Array(
                "LAST_NAME",
                "NAME",
                "EMAIL",
                "WORK_PHONE"
            );
            var ul = new Array(
                "EMAIL",
                "WORK_PHONE",
                "WORK_COMPANY",

                "UF_LEGAL_ADDRESS",
                "UF_INN",
                "UF_KPP",
                "UF_OGRN",

                "UF_NAME_BANK",
                "UF_BIC_BANK",
                "UF_CHECKING_ACCOUNT",
                "UF_CORR_ACCOUNT"
            );
            var ip = new Array(
                "EMAIL",
                "WORK_PHONE",
                "WORK_COMPANY",

                "UF_LEGAL_ADDRESS",
                "UF_INN",
                "UF_OGRN",

                "UF_NAME_BANK",
                "UF_BIC_BANK",
                "UF_CHECKING_ACCOUNT",
                "UF_CORR_ACCOUNT"
            );
            // show/hide block
            $('.btn-toggle-block-register').click(function(){
                $('input,textarea').removeClass('required');
                $('.table-field input[type="text"],.table-field input[type="tel"],input[type="email"],input[type="password"],.table-field textarea').each(function(){
                    var val = $.trim($(this).val());
                    clearClassError(val,$(this));
                });
                var type = $(this).attr('data-type');
                if(type == 'fl')
                {
                    fl.forEach(function(item){
                       $('*[name*='+item+']').addClass('required');
                    });
                }
                else
                {
                    ul.forEach(function(item){
                        $('*[name*='+item+']').addClass('required');
                    });
                }
                if($(this).attr('data-hide-block')){
                    $($(this).attr('data-hide-block')).addClass('hide');
                }
                if ($(this).attr('data-show-block')) {
                    $($(this).attr('data-show-block')).removeClass('hide');
                }
            });
            /*organization or ip*/
            $('input[name*="UF_TYPE_ORGANIZATION"]').click(function(){
                var val = $(this).val();
                $('input,textarea').removeClass('required');
                if(val == 4)
                {
                    $('.table-field input[type="text"],.table-field input[type="tel"],input[type="email"],input[type="password"],.table-field textarea').each(function(){
                        var val = $.trim($(this).val());
                        clearClassError(val,$(this));
                    });
                    ul.forEach(function(item){
                        $('*[name*='+item+']').addClass('required');
                    });
                }
                else if(val == 5)
                {
                    $('.table-field input[type="text"],.table-field input[type="tel"],input[type="email"],input[type="password"],.table-field textarea').each(function(){
                        var val = $.trim($(this).val());
                        clearClassError(val,$(this));
                    });
                    ip.forEach(function(item){
                        $('*[name*='+item+']').addClass('required');
                    });
                }
            });
            var error = false;
            var error_count = 0;

            /*password*/
            $('body').on('change', '.pass', function(){
                var val = $.trim($(this).val());
                error = checkEmptiness(val, $(this));
                if (error)
                {
                    error_count++;
                }
                else {
                    error = checkPassword(val, $(this));
                    if (error) {
                        error_count++;
                    }
                }
            });

            $('body').on('change', '.pass_inp', function(){
                var val = $.trim($(this).val());
                error = checkEmptiness(val, $(this));
                if (error)
                {
                    error_count++;
                }
                else {
                    error = checkPassword_inp(val, $(this));
                    if (error) {
                        error_count++;
                    }
                }
            });

            /*login email*/
            $('body').on('change', 'input[type="email"]#emailregister', function(){
                var val = $.trim($(this).val());
                error = checkEmptiness(val, $(this));
                if (error)
                {
                    error_count++;
                }
                else {
                    error = checkEmail(val, $(this));
                    if (error) {
                        error_count++;
                    }
                }
            });
            $('body').on('change', 'input[type="text"].required, input[type="tel"]', function(){
                var val = $.trim($(this).val());

                /*inn kpp rs ks ogrn */
                if($(this).hasClass('numbers'))
                {
                    error = checkEmptiness(val, $(this));
                    if (error) {
                        error_count++;
                    }
                    else {
                        error = checkNumbers(val, $(this));
                        if (error) {
                            error_count++;
                        }
                    }
                }
                else {
                    error = checkEmptiness(val, $(this));
                    if (error) {
                        error_count++;
                    }
                }
            });

            /*submit*/
            $('body').on('submit', 'form', function(){
                error_count = 0;
                $('input[type="email"], input[type="text"].required, input[type="text"].required.numbers, input[type="tel"],input[type="password"].pass,input[type="password"].pass_inp').change();
                if (error_count>0)
                {
                    return false;
                }
                else
                {
                    //return false;
                }
            });
        });
    </script>
<?endif?>