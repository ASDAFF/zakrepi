<?
use Bitrix\Main\Localization\Loc;
$module_id = "bannergrid";

/*Установка прав на запись*/
$MODULE_RIGHT = $APPLICATION->GetGroupRight($module_id);

if (! ($MODULE_RIGHT >= "R"))
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
/*Конец установки прав на запись*/
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);
?>
<?
/*Какаие параметры необходимы*/
$arAllOptions = array(
    array("bgIblockId", Loc::getMessage("BANNERGRID_IBLOCK"), "", array("select", "IBLOCK")),
);
/**/

if($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_REQUEST["Update"]) > 0 && check_bitrix_sessid())
{


    foreach($arAllOptions as $arOption)
    {
        $name=$arOption[0];
        $val=$_REQUEST[$name];
        if($arOption[2][0]=="checkbox" && $val!="Y")
            $val="N";
        COption::SetOptionString($module_id, $name, $val, $arOption[1]);
    }
}


$aTabs = array(
    array("DIV" => "edit1", "TAB" => Loc::getMessage("MAIN_TAB_SET"), "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET")),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();
?>
<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=$module_id?>&amp;lang=<?echo LANGUAGE_ID?>">
    <?$tabControl->BeginNextTab();?>
    <?
    foreach($arAllOptions as $arOption):
        $val = COption::GetOptionString($module_id, $arOption[0], $arOption[2]);
        $type = $arOption[3];
        ?>
        <tr>
            <td width="40%" nowrap <?if($type[0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
                <label for="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo $arOption[1]?>:</label>
            <td width="60%">
                <?if($type[0]=="checkbox"):?>
                    <input type="checkbox" id="<?echo htmlspecialcharsbx($arOption[0])?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
                <?elseif($type[0]=="text"):?>
                    <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>">
                <?elseif($type[0]=="textarea"):?>
                    <textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
                <?elseif($type[0]=="select" && $type[1]=="IBLOCK" ):?>
                    <?
                    CModule::IncludeModule('iblock');
                    $res = CIBlock::GetList(
                        Array(),
                        Array(
                            'ACTIVE'=>'Y',
                            "CNT_ACTIVE"=>"Y"
                        ), true
                    );
                    ?>
                    <select name="<?echo $arOption[0]?>">
                        <?
                        while($ar_res = $res->Fetch())
                        {
                            ?>
                            <option value="<?echo $ar_res['ID']?>" <?if(htmlspecialcharsbx($val) == $ar_res['ID']):?>selected<?endif;?>>
                                    <?=$ar_res['NAME'].': '.$ar_res['ELEMENT_CNT'];?>
                            </option>
                            <?
                        }
                            ?>
                    </select>
                <?endif;?>
            </td>
        </tr>
    <?endforeach?>
    <?$tabControl->Buttons();?>
    <input <?if ($MODULE_RIGHT<"W") echo "disabled" ?> type="submit" class="adm-btn-green" name="Update" value="<?=Loc::getMessage("BANNERGRID_OPTION_SAVE")?>" />
    <input type="hidden" name="Update" value="Y" />
    <?=bitrix_sessid_post();?>
    <?$tabControl->End();?>
</form>