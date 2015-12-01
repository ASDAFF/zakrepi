<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component;
if (is_object($cp))
{
	CModule::IncludeModule('iblock');

	if(empty($arResult['ERRORS']['FATAL']))
	{

		$hasDiscount = false;
		$hasProps = false;
		$productSum = 0;
		$basketRefs = array();

		$noPict = array(
			'SRC' => $this->GetFolder().'/images/no_photo.png'
		);

		if(is_readable($nPictFile = $_SERVER['DOCUMENT_ROOT'].$noPict['SRC']))
		{
			$noPictSize = getimagesize($nPictFile);
			$noPict['WIDTH'] = $noPictSize[0];
			$noPict['HEIGHT'] = $noPictSize[1];
		}

		foreach($arResult["BASKET"] as $k => &$prod)
		{
			if(floatval($prod['DISCOUNT_PRICE']))
				$hasDiscount = true;

			// move iblock props (if any) to basket props to have some kind of consistency
			if(isset($prod['IBLOCK_ID']))
			{
				$iblock = $prod['IBLOCK_ID'];
				if(isset($prod['PARENT']))
					$parentIblock = $prod['PARENT']['IBLOCK_ID'];

				foreach($arParams['CUSTOM_SELECT_PROPS'] as $prop)
				{
					$key = $prop.'_VALUE';
					if(isset($prod[$key]))
					{
						// in the different iblocks we can have different properties under the same code
						if(isset($arResult['PROPERTY_DESCRIPTION'][$iblock][$prop]))
							$realProp = $arResult['PROPERTY_DESCRIPTION'][$iblock][$prop];
						elseif(isset($arResult['PROPERTY_DESCRIPTION'][$parentIblock][$prop]))
							$realProp = $arResult['PROPERTY_DESCRIPTION'][$parentIblock][$prop];
						
						if(!empty($realProp))
							$prod['PROPS'][] = array(
								'NAME' => $realProp['NAME'], 
								'VALUE' => htmlspecialcharsEx($prod[$key])
							);
					}
				}
			}

			// if we have props, show "properties" column
			if(!empty($prod['PROPS']))
				$hasProps = true;

			$productSum += $prod['PRICE'] * $prod['QUANTITY'];

			$basketRefs[$prod['PRODUCT_ID']][] =& $arResult["BASKET"][$k];

			if(!isset($prod['PICTURE']))
				$prod['PICTURE'] = $noPict;
		}

		$arResult['HAS_DISCOUNT'] = $hasDiscount;
		$arResult['HAS_PROPS'] = $hasProps;

		$arResult['PRODUCT_SUM_FORMATTED'] = $productSum;

		if($img = intval($arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE_ID']))
		{

			$pict = CFile::ResizeImageGet($img, array(
				'width' => 150,
				'height' => 90
			), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

			if(strlen($pict['src']))
				$pict = array_change_key_case($pict, CASE_UPPER);

			$arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE'] = $pict;
		}
	
		foreach($arResult["ORDER_PROPS"] as $prop){
			
			if($prop["SHOW_GROUP_NAME"] == "Y"){
				switch($prop['GROUP_NAME']){
					case 'Контактные данные':
						$prop_name = 'CONTACT_PROP';
					break;
					case 'Данные доставки':
						$prop_name = 'DELIVERY_PROP';
					break;
				}
				$arResult['ORDER_PROPS_GROUP'][$prop_name]['GROUP_NAME'] = $prop['GROUP_NAME'];
				$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] = '';
			}
			switch($prop['CODE']){
					case 'STREET':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= 'ул. ';
					break;
					case 'HOUSE':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= 'д. ';
					break;
					case 'KORPUS':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= 'корп. ';
					break;
					case 'FLAT':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= 'кв. ';
					break;
				}
				
			$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= $prop['VALUE'];
			
				switch($prop['CODE']){
					case 'LASTNAME':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ' ';
					break;
					case 'EMAIL':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ' ';
					break;
					case 'STREET':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ', ';
					break;
					case 'HOUSE':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ', ';
					break;
					case 'KORPUS':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ', ';
					break;
					case 'FLAT':
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= ', ';
					break;
					default:
						$arResult['ORDER_PROPS_GROUP'][$prop_name]['VALUE'] .= '<br/>';
				}
			
		}
	}
}
?>