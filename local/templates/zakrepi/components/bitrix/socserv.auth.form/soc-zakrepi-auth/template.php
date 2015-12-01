<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
    $arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
    $arPost = $arParams["~POST"];
}
?>
<?
if($arParams["POPUP"]):
    //only one float div per page
    if(defined("BX_SOCSERV_POPUP"))
        return;
    define("BX_SOCSERV_POPUP", true);
    ?>
    <div style="display:none">
    <div id="bx_auth_float" class="bx-auth-float">
<?endif?>

<?if(($arParams["~CURRENT_SERVICE"] <> '') && $arParams["~FOR_SPLIT"] != 'Y'):?>
    <script type="text/javascript">
        BX.ready(function(){BxShowAuthService('<?=CUtil::JSEscape($arParams["~CURRENT_SERVICE"])?>', '<?=$arParams["~SUFFIX"]?>')});
    </script>
<?endif?>
<?
if($arParams["~FOR_SPLIT"] == 'Y'):?>
    <div class="bx-auth-serv-icons">
        <?foreach($arAuthServices as $service):?>
            <?
            if(($arParams["~FOR_SPLIT"] == 'Y') && (is_array($service["FORM_HTML"])))
                $onClickEvent = $service["FORM_HTML"]["ON_CLICK"];
            else
                $onClickEvent = "onclick=\"BxShowAuthService('".$service['ID']."', '".$arParams['SUFFIX']."')\"";
            ?>
            <a title="<?=htmlspecialcharsbx($service["NAME"])?>" href="javascript:void(0)" <?=$onClickEvent?> id="bx_auth_href_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>"><i class="bx-ss-icon <?=htmlspecialcharsbx($service["ICON"])?>"></i></a>
        <?endforeach?>
    </div>
<?endif;?>
    <div class="bx-auth">
        <form method="post" name="bx_auth_services<?=$arParams["SUFFIX"]?>" target="_top" action="<?=$arParams["AUTH_URL"]?>">
            <ul class="soc-list horizontal">
                <?foreach($arAuthServices as $service):?>
                    <?if(($arParams["~FOR_SPLIT"] != 'Y') || (!is_array($service["FORM_HTML"]))):?>

                        <li class="soc-item">
							<?	$class = '';
								switch($service['ICON'])
								{
									case 'facebook':
										$class = 'fb';
										break;
									case 'vkontakte':
										$class = 'vk';
										break;
									case 'odnoklassniki':
										$class = 'ok';
										break;
								}
							?>
                            <a class="soc-link <?=$class?>" href="javascript:void(0);" onclick="<?=$service['ONCLICK']?>">
                                <svg class="icon">
                                    <use xlink:href="#<?=$service['ICON']?>"/>
                                </svg>
                            </a>
                        </li>
                    <?endif;?>
                <?endforeach?>
            </ul>
            <?foreach($arPost as $key => $value):?>
                <?if(!preg_match("|OPENID_IDENTITY|", $key)):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endif;?>
            <?endforeach?>
            <input type="hidden" name="auth_service_id" value="" />
        </form>
    </div>

<?if($arParams["POPUP"]):?>
    </div>
    </div>
<?endif?>