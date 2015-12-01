<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>

<?=$arResult["FORM_HEADER"]?>


<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
    <div class="title">Купить в 1 клик</div>
    <p class="note-text">Укажите Ваши данные, и наш менеджер свяжется с Вами для оформления заказа.</p>
    
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			?>
				<input type="hidden" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$arParams["NAME_PRODUCT"]?>">
			<?
		}
		else
		{
	?>
			<?switch($arQuestion['STRUCTURE'][0]['FIELD_TYPE']){
				case 'text':
					?>
						<div class="table-field">
							<span class="label"><?=$arQuestion["CAPTION"]?></span>
							<div class="field">
								<?if($arQuestion['CODE'] != 'PHONE'):?>
									<input type="text" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>"/>
								<?else:?>
									<input type="tel" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>"/>
								<?endif;?>
							</div>
						</div>
					<?
				break;
				case 'radio':
					?>
						<div class="table-field time-field">
							<span class="label"><?=$arQuestion["CAPTION"]?></span>
							<?foreach ($arQuestion['STRUCTURE'] as $arItemRadio)
							{
							?>
								<div class="first-field">
									<input type="radio" <?=$arItemRadio['FIELD_PARAM']?> name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['CODE']?>" value="<?=$arItemRadio['ID']?>" id="radio_<?=$arItemRadio['ID']?>"/>									
									<label class="radio-lbl" for="radio_<?=$arItemRadio['ID']?>"><?=$arItemRadio['MESSAGE']?></label>
								</div>
							<?
							}
							?>
						</div>
					<?
				break;
			}?>
			
	
	<?
		}
	}
	?>
	<input type="hidden" name="web_form_apply" value="Y" />
	<input type="submit" class="btn primary big bigsize center" <?/*?>onclick="ajax_FormResultNew('<?=$arParams['ROUTE']?>','<?=$arParams['ROUTE_URL']?>',this);return false;"<?*/?> id="button-<?=$arParams['ROUTE']?>" name="web_form_apply" value="Купить" />
	<div class="loader center-align" id="loader-<?=$arParams['ROUTE']?>" style="display:none;    height: 50px;    padding: 0;"><img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/></div>
	
				
<?}?>
<?/*
<table class="form-table data-table">
	<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>


	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				<?if ($arResult["F_RIGHT"] >= 15):?>
				&nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
				<?endif;?>
				&nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
			</th>
		</tr>
	</tfoot>
</table>
*/?>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>