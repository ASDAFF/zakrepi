<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");

$style = (is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])) ? "" : "display:none";
?>

<?/*<input type="text" name="ADDRESS_ID" value="<?=$arResult["SELECTED_USER_ADDRESS"]?>" />*/?>

<div style="<?=$style?>">
	<? //PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"], Array())?>

	<?if (count($arResult["USER_ADDRESS"]) > 0):?>
	
	<input type="hidden" name="IS_ADDRESS_CHANGE" value="" />
	<input type="hidden" name="IS_ADDRESS_NEW" value="" />

	<div class="table-field delivery-address loged-in clearfix">
		<label class="label"><?=GetMessage("SOA_TEMPL_DELIVERY_ADDRESS");?></label>
		<div class="select-box hide-on-large-only">
			<select id="del-addr" name="del-addr-sel" onchange="setNewLocation(this)">
				<?foreach ($arResult["USER_ADDRESS"] as $arAddress) {
					$selected = '';
					if ($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"])
						$selected = 'selected';
					echo '<option value="'.$arAddress["ID"].'" '.$selected.'>'.$arAddress["ADDRESS_VIEW"].'</option>';
				}?>
			</select>
			<div class="triangle"></div>
		</div>
		<div class="dropdown-box hide-on-med-and-down">
			<div class="dropdown-value">
				<div class="item-text"></div>
				<div class="triangle"></div>
			</div>
			<ul class="dropdown-list select-synh hide-on-med-and-down" data-select="del-addr">
				<?foreach ($arResult["USER_ADDRESS"] as $arAddress):?>
				<li class="dropdown-item" <?if($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"]):?>data-active="active"<?endif;?>>
					<input type="radio" class="dropdown-inp" name="del-addr" value="<?=$arAddress["ID"]?>" id="del-addr-rad-<?=$arAddress["ID"]?>" <?if($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"]):?>checked="checked"<?endif;?> data-value-text="<?=$arAddress["ADDRESS_VIEW"]?>"/>
					<label class="dropdown-title" for="del-addr-rad-<?=$arAddress["ID"]?>">
						<div class="item-text"><?=$arAddress["ADDRESS_VIEW"]?></div>
					</label>
				</li>
				<?endforeach;?>
			</ul>
		</div>
		<div class="addr-actions second-field">
			<?/*
			<a class="btn-toggle-block" href="#" data-show-block=".delivery-address.change-addr" data-hide-block=".delivery-address.new-addr"><?=GetMessage("SOA_TEMPL_CHANGE_ADDRESS");?></a>
			<a class="btn-toggle-block" href="#" data-show-block=".delivery-address.new-addr" data-hide-block=".delivery-address.change-addr"><?=GetMessage("SOA_TEMPL_NEW_ADDRESS");?></a>
			*/?>
			<a href="javascript:void(0)" onclick="openAddressBlock()"><?=GetMessage("SOA_TEMPL_CHANGE_ADDRESS");?></a>
			<a href="javascript:void(0)" onclick="newAddressBlock()"><?=GetMessage("SOA_TEMPL_NEW_ADDRESS");?></a>
		</div>
	</div>
	<?else:?>
		<input type="hidden" name="IS_ADDRESS_CHANGE" value="" />
		<input type="hidden" name="IS_ADDRESS_NEW" value="Y" />
	<?endif;?>

	<div class="delivery-address change-addr <?if (count($arResult["USER_ADDRESS"]) > 0):?>hide<?endif;?>">
		<div class="table-field">
			<span class="label">Город / Поселок / Деревня</span>
			<div class="field">
				<input type="text" name="<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["FIELD_NAME"]?>" value="<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["VALUE"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["CODE"]?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["ID"]?>" <?if (count($arResult["USER_ADDRESS"]) > 0):?>readonly<?endif;?> /><label for="addr-city" class="textfield-placeholder">Например: Тюмень</label>
			</div>
		</div>
		<div class="table-field">
			<span class="label">Улица </span>
			<div class="field">
				<input type="text" name="<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["FIELD_NAME"]?>" value="<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["VALUE"]?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["CODE"]?>" /><label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["ID"]?>" class="textfield-placeholder">Например: Мельникайте</label>
			</div>
		</div>
		<div class="table-field cols-3">
			<span class="label">Дом / Корпус / Квартира</span>
			<div class="field"><input name="<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["FIELD_NAME"]?>" type="text" value="<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["VALUE"]?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["CODE"]?>"/><label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["ID"]?>" class="textfield-placeholder">Дом</label></div>/
			<div class="field"><input name="<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["FIELD_NAME"]?>" value="<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["VALUE"]?>" type="text" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["CODE"]?>"/><label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["ID"]?>" class="textfield-placeholder">Корпус</label></div>/
			<div class="field"><input name="<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["FIELD_NAME"]?>" type="text" value="<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["VALUE"]?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["CODE"]?>"/><label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["ID"]?>" class="textfield-placeholder">Квартира</label></div>
		</div>
	</div>

</div>


<script type="text/javascript">

	BX.addCustomEvent('onAjaxSuccess', function () {
		top.$('.dropdown-box').each(function(){
	        var value = top.$(this).find('.dropdown-item[data-active="active"]').find('[data-value-text]');
	        top.$(this).find('.dropdown-value > .item-text').html(value.attr('data-value-text'));
	    });
    });

    function setValueForInput(addressID){
    	postdata = {'getAddressData': 'Y'};
	    BX.ajax({
			url: '<?=$templateFolder?>/ajax.php',
			method: 'POST',
			data: postdata,
			dataType: 'json',
			onsuccess: function(result)
			{
				arAddress = result;
				$(".PROP_INPUT_CITY").attr("value", arAddress[addressID]["CITY"]);
		    	$(".PROP_INPUT_STREET").attr("value", arAddress[addressID]["STREET"]);
				$(".PROP_INPUT_HOUSE").attr("value", arAddress[addressID]["HOUSE"]);
				$(".PROP_INPUT_KORPUS").attr("value", arAddress[addressID]["KORPUS"]);
				$(".PROP_INPUT_FLAT").attr("value", arAddress[addressID]["FLAT"]);

				changePlaceholderView();
			}
		});
    }

    function changePlaceholderView(){
    	top.$(".delivery-address .field").each(function(indx){
		  	var curVal = top.$(this).find("input").val();
		  	if (curVal.length > 0)
		  		top.$(this).find(".textfield-placeholder").hide();
		  	else
		  		top.$(this).find(".textfield-placeholder").show();
		});
    }

    function clearInput(){
    	top.$(".delivery-address .field").each(function(indx){
		  	top.$(this).find("input").attr('value', '');
		  	top.$(this).find(".textfield-placeholder").show();
		});
    }

    function setNewLocation(obj){
		var addressID = $(obj).val();
		if (addressID > 0){
			postdata = {'ADDRESS_ID': addressID};
			BX.showWait();
			BX.ajax({
				url: '<?=$templateFolder?>/ajax.php',
				method: 'POST',
				data: postdata,
				dataType: 'json',
				onsuccess: function(result)
				{
					setValueForInput(addressID);
					changePlaceholderView();
					BX.closeWait();
					
					submitForm();
				}
			});
		}
	}

	function openAddressBlock(){
		var addressID = top.$("[name=del-addr-sel]").val();
		setValueForInput(addressID);
		top.$("[name=IS_ADDRESS_CHANGE]").attr("value", "Y");
		top.$("[name=IS_ADDRESS_NEW]").attr("value", "N");
		top.$(".delivery-address").removeClass('hide');
		top.$(".PROP_INPUT_CITY").attr('readonly', 'readonly');
	}

	function newAddressBlock(){
		clearInput();
		top.$("[name=IS_ADDRESS_CHANGE]").attr("value", "N");
		top.$("[name=IS_ADDRESS_NEW]").attr("value", "Y");
		top.$(".delivery-address").removeClass('hide');
		top.$(".PROP_INPUT_CITY").removeAttr('readonly');
	}

	top.$(document).ready(function(){

	});
	
</script>