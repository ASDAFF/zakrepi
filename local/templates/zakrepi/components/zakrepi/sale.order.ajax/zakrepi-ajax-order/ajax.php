<?
use Bitrix\Sale\Location;
use Bitrix\Sale\Location\Admin\LocationHelper;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);

require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');


$arRes = Array();

if (isset($_POST['EMAIL'])){
	$email = trim($_POST['EMAIL']);
	if (strlen($email) > 0){
		$rsUser = CUser::GetByLogin($email);
		if (intval($rsUser->SelectedRowsCount())>0)
			$arRes["RESULT"] = "Y";
		else
			$arRes["RESULT"] = "N";
	}
}
elseif(isset($_POST['ADDRESS_ID']) && CModule::IncludeModule("useraddress") && CModule::IncludeModule("sale"))
{
	$addressID = intval($_POST['ADDRESS_ID']);
	$addressInfo = CUserAddress::getAddressId($addressID);
	
	//поиск LOCATION по названию города
	$db_vars = CSaleLocation::GetList(
        array(),
        array("LID" => LANGUAGE_ID, "CITY_NAME" => trim($addressInfo[0]["CITY"])),
        false,
        false,
        array("ID")
    );
	while ($vars = $db_vars->Fetch()):
		$arRes["LOCATION_ID"] = $vars["ID"];
	endwhile;
}
elseif(isset($_POST["getAddressData"])){
	include($_SERVER["DOCUMENT_ROOT"].'/local/components/zakrepi/sale.order.ajax/functions.php');
	$arResult = Array();
	getJsUserAddress($arResult, $USER->GetID());

	$arRes = $arResult["JS_USER_ADDRESS"];
}
elseif(isset($_POST["CITY_NAME"])&& CModule::IncludeModule("useraddress") && CModule::IncludeModule("sale")){
    
    $city_name = "%".$_POST["CITY_NAME"]."%";
    
    $res = \Bitrix\Sale\Location\LocationTable::getList(array(
        'filter' => array('=NAME.LANGUAGE_ID' => LANGUAGE_ID,"NAME_RU"=>$city_name,"!CITY_ID"=>''),
        'select' => array('*', 'NAME_RU' => 'NAME.NAME', 'TYPE_CODE' => 'TYPE.CODE')
    ));
  
		$arRes["LOCATION_ID"] = array();
        $i=0;
		while($item = $res->Fetch())
        {
			$ID = CSaleLocation::getLocationIDbyCODE($item['CODE']);
			$arVal = CSaleLocation::GetByID( $ID, LANGUAGE_ID); 
			
			//$arRes["LOCATION_ID"][$i] = $item;
			$arRes["LOCATION_ID"][$i]['ID'] = $item['CITY_ID'];
            $arRes["LOCATION_ID"][$i]['NAME'] = $item['NAME_RU'];
			$arRes["LOCATION_ID"][$i]['REGION'] = $arVal['REGION_NAME_LANG'];
            $i++;
        }
           
}

$APPLICATION->RestartBuffer();
header('Content-Type: application/json; charset='.LANG_CHARSET);
echo CUtil::PhpToJSObject($arRes);
die();