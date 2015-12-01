<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	 foreach($arResult as $a=>$arItem){
		$level = $arItem['DEPTH_LEVEL'];
		if($level != ''){
			$i = $a+1;
			while($i<=count($arResult))
			{
				if ($level == $arResult[$i]['DEPTH_LEVEL']){
					break(1);
				}
				elseif($level + 1 < $arResult[$i]['DEPTH_LEVEL']){
					$arResult[$a]['HAVE_CHILD'] = 'Y';
					break(1);
				}
				$i++;
			}
		}
	 }
?>