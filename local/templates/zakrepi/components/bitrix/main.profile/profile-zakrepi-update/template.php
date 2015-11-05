<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<?
    $userGroup = CUser::GetUserGroup($USER->GetID());
    $groupFZ = array_search(5, $userGroup);
    $groupUL = array_search(6, $userGroup);
?>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>" />
    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
    <?/*физ лицо*/?>
    <?if($groupFZ!=''):?>
        <div class="row">
            <div class="col l7">
                <div class="base-card register-form">
                    <div class="card-content">
                        <?/*Фамилия*/?>
                        <div class="table-field fl-field">
                            <label class="label">Фамилия</label>
                            <div class="field"><input type="text" class="required" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>"/></div>
                        </div>
                        <?/*Имя*/?>
                        <div class="table-field fl-field">
                            <label class="label">Имя</label>
                            <div class="field"><input type="text" class="required" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>"/></div>
                        </div>
                        <?/*Номер телефона*/?>
                        <div class="table-field">
                            <label class="label">Номер телефона</label>
                            <div class="field"><span class="tel-before">+7</span><input type="tel" class="required numbers" name="WORK_PHONE" value="<?=$arResult["arUser"]["WORK_PHONE"]?>"/></div>
                        </div>
                        <?/*Электронная почта и логин*/?>
                        <div class="table-field">
                            <label class="label">Электронная почта</label>
                            <div class="field">
                                <input type="hidden" name="LOGIN" id="login-name"/>
                                <input type="email" onchange="setLogin(this)" class="required" id="emailregister" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>"/>
                            </div>
                        </div>

                        <p class="color-text text-light password-new-click">Изменить пароль</p>
                        <div class="password-new hide">
                            <div class="table-field">
                                <label class="label">Ваш новый пароль</label>
                                <div class="field"><input type="password" class="pass" autocomplete="off" name="NEW_PASSWORD"/></div>
                            </div>
                            <div class="table-field">
                                <label class="label">Повторите новый пароль</label>
                                <div class="field"><input type="password" class="pass_inp" autocomplete="off" name="NEW_PASSWORD_CONFIRM"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn primary big fullwidth" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
                <?ShowError($arResult["strProfileError"]);?>
                <?
                if ($arResult['DATA_SAVED'] == 'Y')
                    ShowNote(GetMessage('PROFILE_DATA_SAVED'));
                ?>
            </div>
        </div>
    <?/*Юр лицо*/?>
    <?elseif($groupUL):?>
        <div class="row">
            <div class="col l7">
                <div class="base-card register-form">
                    <div class="card-content">
                        <?/*Наименование организации*/?>
                        <div class="table-field ul-field">
                            <label class="label">Назв. организации / ИП</label>
                            <div class="field"><input type="text" class="required" name="WORK_COMPANY" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>"/></div>
                        </div>
                        <?/*Тип организации*/?>
                        <div class="table-field ul-field">
                            <p class="first-field">
                                <input type="radio" <?if($arResult["arUser"]["UF_TYPE_ORGANIZATION"] == 4):?>checked<?endif;?> name="UF_TYPE_ORGANIZATION" value="4" id="comptype-v1"/>
                                <label class="radio-lbl" for="comptype-v1">Организация</label>
                            </p>
                            <p class="field">
                                <input type="radio"   <?if($arResult["arUser"]["UF_TYPE_ORGANIZATION"] == 5):?>checked<?endif;?>  name="UF_TYPE_ORGANIZATION" value="5" id="comptype-v2"/>
                                <label class="radio-lbl" for="comptype-v2">ИП</label>
                            </p>
                        </div>
                        <?/*Номер телефона*/?>
                        <div class="table-field">
                            <label class="label">Номер телефона</label>
                            <div class="field"><span class="tel-before">+7</span><input type="tel" class="required numbers" name="WORK_PHONE" value="<?=$arResult["arUser"]["WORK_PHONE"]?>"/></div>
                        </div>
                        <?/*Электронная почта и логин*/?>
                        <div class="table-field">
                            <label class="label">Электронная почта</label>
                            <div class="field">
                                <input type="hidden" name="LOGIN" id="login-name" value="<?=$arResult["arUser"]["LOGIN"]?>"/>
                                <input type="email" onchange="setLogin(this)" class="required" id="emailregister" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>"/>
                            </div>
                        </div>
                        <?/*Юридический адрес*/?>
                        <div class="table-field ul-field">
                            <label class="label textarea">Юридический адрес</label>
                            <div class="field">
                                <?/*<input type="text" />*/?>
                                <textarea name="UF_LEGAL_ADDRESS" value="<?=$arResult["arUser"]["UF_LEGAL_ADDRESS"]?>"></textarea>
                            </div>
                        </div>
                        <?/*Реквизиты организации*/?>
                        <div class="requisites_organization ul-field">
                            <p class="color-text text-light">Реквизиты организации</p>
                            <div class="table-field cols-2">
                                <span class="label">ИНН / КПП</span>
                                <div class="field"><input type="text" id="inn" class="required numbers" name="UF_INN" value="<?=$arResult["arUser"]["UF_INN"]?>"/><label for="inn" class="textfield-placeholder">ИНН</label></div>/
                                <div class="field"><input type="text" id="kpp" class="required numbers" name="UF_KPP" value="<?=$arResult["arUser"]["UF_KPP"]?>"/><label for="kpp" class="textfield-placeholder">КПП</label></div>
                            </div>
                            <div class="table-field cols-2">
                                <span class="label">ОГРН / ОКПО</span>
                                <div class="field"><input type="text" id="ogrn" class="required numbers" name="UF_OGRN" value="<?=$arResult["arUser"]["UF_OGRN"]?>"/><label for="ogrn" class="textfield-placeholder">ОГРН</label></div>/
                                <div class="field"><input type="text" id="okpo" class="numbers" name="UF_OKPO" value="<?=$arResult["arUser"]["UF_OKPO"]?>"/><label for="okpo" class="textfield-placeholder">ОКПО</label></div>
                            </div>
                        </div>
                        <?/*Банковские реквизиты*/?>
                        <div class="requisites_organization ul-field">
                            <p class="color-text text-light">Банковские реквизиты</p>
                            <div class="table-field cols-2">
                                <span class="label">Банк / БИК банка</span>
                                <div class="field"><input type="text" id="bank" class="required" name="UF_NAME_BANK" value="<?=$arResult["arUser"]["UF_NAME_BANK"]?>"/><label for="bank" class="textfield-placeholder">Банк</label></div>/
                                <div class="field"><input type="text" id="bik" maxlength="9" class="required numbers" name="UF_BIC_BANK" value="<?=$arResult["arUser"]["UF_BIC_BANK"]?>"/><label for="bik" class="textfield-placeholder">БИК банка</label></div>
                            </div>
                            <div class="table-field cols-2">
                                <span class="label">Расчетный счет / Кор. счет</span>
                                <div class="field"><input type="text" id="rs" maxlength="20" class="required numbers" name="UF_CHECKING_ACCOUNT" value="<?=$arResult["arUser"]["UF_CHECKING_ACCOUNT"]?>"/><label for="rs" class="textfield-placeholder">Расчетный счет</label></div>/
                                <div class="field"><input type="text" id="ks" maxlength="20" class="required numbers" name="UF_CORR_ACCOUNT" value="<?=$arResult["arUser"]["UF_CORR_ACCOUNT"]?>"/><label for="ks" class="textfield-placeholder">Кор. счет</label></div>
                            </div>
                        </div>
                        <?/*Дополнительные параметры*/?>
                        <div class="dop_paramentr ul-field">
                            <div class="table-field">
                                <span class="label">Сайт организации</span>
                                <div class="field"><input type="text" id="site"/></div>
                            </div>
                            <?/*Контактное лицо*/?>
                            <div class="table-field">
                                <label class="label">Контактное лицо</label>
                                <div class="field"><input type="text" name="UF_CONTACT_MANAGER" value="<?=$arResult["arUser"]["UF_CONTACT_MANAGER"]?>"/></div>
                            </div>
                        </div>
                        <p class="color-text text-light password-new-click">Изменить пароль</p>
                        <div class="password-new hide">
                            <div class="table-field">
                                <label class="label">Ваш новый пароль</label>
                                <div class="field"><input type="password" class="pass" autocomplete="off" name="NEW_PASSWORD"/></div>
                            </div>
                            <div class="table-field">
                                <label class="label">Повторите новый пароль</label>
                                <div class="field"><input type="password" class="pass_inp" autocomplete="off" name="NEW_PASSWORD_CONFIRM"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn primary big fullwidth" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
                <?ShowError($arResult["strProfileError"]);?>
                <?
                if ($arResult['DATA_SAVED'] == 'Y')
                    ShowNote(GetMessage('PROFILE_DATA_SAVED'));
                ?>
            </div>
        </div>
    <?endif;?>
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
            "UF_OGRN"

            /*"UF_NAME_BANK",
            "UF_BIC_BANK",
            "UF_CHECKING_ACCOUNT",
            "UF_CORR_ACCOUNT"*/
        );

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

        $('.password-new-click').click(function(){
            if($('.password-new').hasClass('hide'))
            {
                $('.password-new').removeClass('hide');
                $(this).remove();
                $('.pass,.pass_inp').val('').removeClass('error');
            }
            else
            {
                $('.password-new').addClass('hide');
                $('.pass,.pass_inp').val('').removeClass('error');
            }
        })
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