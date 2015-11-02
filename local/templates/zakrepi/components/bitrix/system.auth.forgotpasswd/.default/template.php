<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<div class="breadcrumbs">
    <a href="/personal/">Вернуться к авторизации</a>
</div>
<div class="workarea">
    <h1 class="page-title">Востановление пароля</h1>
    <div class="row">
        <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <div class="col l7">
                <div class="base-card authorize-form">
                    <div class="card-content">
                        <?
                        if (strlen($arResult["BACKURL"]) > 0)
                        {
                            ?>
                            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                        <?
                        }
                        ?>
                        <input type="hidden" name="AUTH_FORM" value="Y">
                        <input type="hidden" name="TYPE" value="SEND_PWD">
                        <div class="title big-text"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>
                        <p><? ShowMessage($arParams["~AUTH_RESULT"]); ?></p>
                        <div class="table-field">
                            <label class="label">Электронная почта</label>
                            <div class="field"><input type="email" name="USER_EMAIL" id="emailregister" maxlength="255" /></div>
                        </div>
                    </div>

                </div>
                <input type="submit" name="send_account_info" class="btn primary big fullwidth" value="<?=GetMessage("AUTH_SEND")?>" />
                <?/*<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>*/?>
                <script type="text/javascript">
                    document.bform.USER_LOGIN.focus();
                </script>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        var error = false;
        var error_count = 0;

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
        /*submit*/
        $('body').on('submit', 'form', function(){
            error_count = 0;
            $('input[type="email"]#emailregister').change();
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