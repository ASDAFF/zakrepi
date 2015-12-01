<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");

$style = (is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])) ? "" : "display:none";
?>

<div style="<?=$style?>">
	<? //PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"], Array())?>

	<?if (count($arResult["USER_ADDRESS"]) > 0):?>
	
	<input type="hidden" name="IS_ADDRESS_CHANGE" value="<?=$arResult['IS_ADDRESS_CHANGE']?>" />
	<input type="hidden" name="IS_ADDRESS_NEW" value="<?=$arResult['IS_ADDRESS_NEW']?>" />
    <input type="hidden" name="SELECTED_USER_ADDRESS" value="<?=$arResult["SELECTED_USER_ADDRESS"]?>" />
	<input type="hidden" name="IS_ADDRESS_SAVE" value="<?=$arResult["IS_ADDRESS_SAVE"]?>" />
	<div class="table-field delivery-address loged-in clearfix">
		<label class="label"><?=GetMessage("SOA_TEMPL_DELIVERY_ADDRESS");?></label>
		<div class="select-box hide-on-large-only">
			<select id="del-addr" name="del-addr-sel" onchange="setNewLocation(this)">
				<?
					$a = 0;
                    $sel = 1;
					$i=0;
				?>
				<?foreach ($arResult["USER_ADDRESS"] as $arAddress) {
					$selected = '';
					$i++;
					if ($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"])
						{
						      $selected = 'selected';
						}
                    elseif($arResult["SELECTED_USER_ADDRESS"] == 0 && $a <= 0 && $arResult["SELECTED_USER_ADDRESS"] != 'last')
                        {
                            $selected = 'selected';
                            $a++;
                            $sel = 0;
                        }
					 elseif($arResult["SELECTED_USER_ADDRESS"] == 'last' && count($arResult["USER_ADDRESS"]) == $i)
                        {
                            $selected = 'selected';
                            /*$a++;
                            $sel = 0;*/
                        }	
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
				<?
				$i=0;
				foreach ($arResult["USER_ADDRESS"] as $arAddress):
					$i++;
				?>
					<li class="dropdown-item" 
						<?if($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"]):?>data-active="active"<?endif;?>
						<?if($arResult["SELECTED_USER_ADDRESS"] == 0 && $sel == 0 && $arResult["SELECTED_USER_ADDRESS"] != 'last'):?>data-active="active"<?$sel++; endif;?>
						<?if($arResult["SELECTED_USER_ADDRESS"] == 'last' && count($arResult["USER_ADDRESS"]) == $i):?>data-active="active"<?endif;?>
					>
						<input type="radio" class="dropdown-inp" name="del-addr" value="<?=$arAddress["ID"]?>" id="del-addr-rad-<?=$arAddress["ID"]?>" <?if($arAddress["ID"] == $arResult["SELECTED_USER_ADDRESS"]):?>checked="checked"<?endif;?> data-value-text="<?=$arAddress["ADDRESS_VIEW"]?>"/>
						<label class="dropdown-title" for="del-addr-rad-<?=$arAddress["ID"]?>" >
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
			<?
				CModule::IncludeModule("useraddress");
				$maxCountAddress =  COption::GetOptionString('useraddress', 'zCount', 6);
				if(count($arResult["USER_ADDRESS"]) < IntVal($maxCountAddress)):?>
					<a href="javascript:void(0)" onclick="newAddressBlock()"><?=GetMessage("SOA_TEMPL_NEW_ADDRESS");?></a>
				<?endif;?>
		</div>
	</div>
	<?else:?>
		<input type="hidden" name="IS_ADDRESS_CHANGE" value="" />
		<input type="hidden" name="IS_ADDRESS_NEW" value="Y" />
	<?endif;?>

	<div class="delivery-address change-addr <?if (count($arResult["USER_ADDRESS"]) > 0 && $arResult["SHOW_ADDRESS_FORM"] != 'Y' || $arResult["IS_ADDRESS_SAVE"] == 'Y'):?>hide<?endif;?>">
		<input type="hidden" id="ID_CITY" name="ID_CITY" value="<?=$arResult['ID_CITY']?>"/>
		<input type="hidden" id="NAME_CITY" name="NAME_CITY" value="<?=$arResult['NAME_CITY']?>"/>
		<div class="table-field">
			<span class="label">Город / Поселок / Деревня</span>
			<div class="field">
			<?
				$city = $arResult["ORDER_PROP"]["RELATED"]["CITY"]["VALUE"];
				$street = $arResult["ORDER_PROP"]["RELATED"]["STREET"]["VALUE"];
				$house = $arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["VALUE"];
				$kourps = $arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["VALUE"];
				$flat = $arResult["ORDER_PROP"]["RELATED"]["FLAT"]["VALUE"];
			?>
				<input type="text" onkeyup="getCity(this);" onblur="setCity(this);" autocomplete="off" name="<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["FIELD_NAME"]?>" value="<?=$city?>" class="addr-name-city PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["CODE"]?> <?if($city != ''):?>dirty<?endif;?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["ID"]?>" <?/*if (count($arResult["USER_ADDRESS"]) > 0):?>readonly<?endif;*/?> />
                <label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["ID"]?>" class="textfield-placeholder <?if($city != ''):?>active<?endif;?>">Например: Тюмень</label>
                <span class="error-text error-required error-pattern">Укажите населенный пункт</span>
				<span class="input-loader" style="display:none;">
                    <div>
                        <img src="/local/templates/zakrepi/images/svg/loader.svg" width="25"/>
                    </div>
                </span>
				<ul class="dropdown-list select-synh hide-on-med-and-down get-city-result" id="getCityResult">
				
				</ul>
            </div>
		</div>
		<div class="table-field">
			<span class="label">Улица </span>
			<div class="field">
				<input type="text" name="<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["FIELD_NAME"]?>" value="<?=$street?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["ID"]?>" class="addr-name-street PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["CODE"]?> <?if($street != ''):?>dirty<?endif;?>" />
				<label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["STREET"]["ID"]?>" class="textfield-placeholder <?if($street != ''):?>active<?endif;?>">Например: Мельникайте</label>
				<span class="error-text error-required error-pattern">Укажите улицу</span>
				
			</div>
		</div>
		<div class="table-field cols-3">
			<span class="label">Дом / Корпус / Квартира</span>
			<div class="field">
				<input name="<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["FIELD_NAME"]?>" type="text" value="<?=$house?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["ID"]?>" class="addr-name-house PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["CODE"]?> <?if($house != ''):?>dirty<?endif;?>"/>
				<label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["HOUSE"]["ID"]?>" class="textfield-placeholder <?if($house != ''):?>active<?endif;?>">Дом</label>
				<span class="error-text error-required error-pattern">Укажите дом</span>
				
			</div>/
			<div class="field">
				<input name="<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["FIELD_NAME"]?>" value="<?=$kourps?>" type="text" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["CODE"]?> <?if($kourps != ''):?>dirty<?endif;?>"/>
				<label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["KORPUS"]["ID"]?>" class="textfield-placeholder <?if($kourps != ''):?>active<?endif;?>">Корпус</label>
			</div>/
			<div class="field">
				<input name="<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["FIELD_NAME"]?>" type="text" value="<?=$flat?>" id="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["ID"]?>" class="PROP_INPUT_<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["CODE"]?> <?if($flat != ''):?>dirty<?endif;?>"/>
				<label for="addr-<?=$arResult["ORDER_PROP"]["RELATED"]["FLAT"]["ID"]?>" class="textfield-placeholder <?if($flat != ''):?>active<?endif;?>">Квартира</label>
			</div>
		</div>
		<?if (count($arResult["USER_ADDRESS"]) > 0):?>
			<div>
				<a href="javascript:void(0);" onclick="saveAddr();">Сохранить</a>
			</div>
		<?endif;?>
	</div>
</div>


<script type="text/javascript">

    var timer;
	BX.addCustomEvent('onAjaxSuccess', function () {
		top.$('.dropdown-box').each(function(){
	        var value = top.$(this).find('.dropdown-item[data-active="active"]').find('[data-value-text]');
	        top.$(this).find('.dropdown-value > .item-text').html(value.attr('data-value-text'));
	    });
    });
    function getCity(obj){
		
		$(obj).parent().find('.input-loader').show();
        var city_name = $(obj).val();
		$('[name="NAME_CITY"]').val(city_name);
        postdata = {'CITY_NAME': city_name};

		window.clearTimeout(timer);
		
		timer = window.setTimeout(function() {
			BX.ajax({
				url: '<?=$templateFolder?>/ajax.php',
				method: 'POST',
				data: postdata,
				dataType: 'json',
				onsuccess: function(result)
				{
					 var resHTML = '';
					 result['LOCATION_ID'].forEach(function(item){
						resHTML += '<li class="dropdown-item"><label class="dropdown-title" onclick="setLocation('+item['ID']+',\''+item['NAME']+'\')" data-name-city="'+item['NAME']+'" for="del-addr-rad-'+item['ID']+'"><div class="item-text">'+item['NAME']+', <span class="region">'+item['REGION']+'</span></div></label></li>';
					 });
					 $(obj).parent().find('.input-loader').hide();
					$('#getCityResult').html(resHTML);
					$('#getCityResult').show();
				}
		});
		},1000);
		
    }
    function setLocation(id,name_city)
	{
		$('#getCityResult').hide();
		$("[name=IS_ADDRESS_CHANGE]").val("N");
        $("[name=IS_ADDRESS_NEW]").val("N");
		$('[name="ID_CITY"]').val(id);
		$('[name="NAME_CITY"]').val(name_city);
		//$('input[name="<?=$arResult["ORDER_PROP"]["RELATED"]["CITY"]["FIELD_NAME"]?>"]').val(name_city); 
		$('input.addr-name-city').val(name_city); 
		//setCity();
	}
	function setCity(obj)
	{
		$('#delivery-loader').show();
		//alert($('input.addr-name-city').val());
		submitForm();
	}
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
            top.$(this).find("input").removeClass('dirty');
		  	top.$(this).find(".textfield-placeholder").show();
		});
    }

    function setNewLocation(obj){
		$("[name=IS_ADDRESS_CHANGE]").val("N");
        $("[name=IS_ADDRESS_NEW]").val("N");
        $("[name=NAME_CITY]").val("");
		var addressID = $(obj).val();
        $("[name=SELECTED_USER_ADDRESS]").val(addressID);
		if (addressID > 0){
			postdata = {'ADDRESS_ID': addressID};
			
			$('#delivery-loader').show();
			//BX.showWait();
			BX.ajax({
				url: '<?=$templateFolder?>/ajax.php',
				method: 'POST',
				data: postdata,
				dataType: 'json',
				onsuccess: function(result)
				{
					setValueForInput(addressID);
					changePlaceholderView();
					//BX.closeWait();
					//$('#delivery-loader').hide();
					
					submitForm();
				}
			});
		}
	}

	function openAddressBlock(){
		var addressID = top.$("[name=del-addr-sel]").val();
		setValueForInput(addressID);
		$('[name=IS_ADDRESS_SAVE]').val('');
		top.$("[name=IS_ADDRESS_CHANGE]").attr("value", "Y");
		top.$("[name=IS_ADDRESS_NEW]").attr("value", "N");
		top.$(".delivery-address").removeClass('hide');
//		top.$(".PROP_INPUT_CITY").attr('readonly', 'readonly');
	}

	function newAddressBlock(){
		clearInput();
		$('[name=IS_ADDRESS_SAVE]').val('');
		top.$("[name=IS_ADDRESS_CHANGE]").attr("value", "N");
		top.$("[name=IS_ADDRESS_NEW]").attr("value", "Y");
		top.$(".delivery-address").removeClass('hide');
		top.$(".PROP_INPUT_CITY").removeAttr('readonly');
	}
	function saveAddr()
	{
		if($("[name=IS_ADDRESS_CHANGE]").val() == 'Y'){	$('[name=IS_ADDRESS_SAVE]').val('Y');setCity();}
		if($("[name=IS_ADDRESS_NEW]").val() == 'Y'){	$('[name=IS_ADDRESS_SAVE]').val('Y');setCity();}
	}
	top.$(document).ready(function(){

	});
	
</script>