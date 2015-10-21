<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

foreach ($arResult["ITEMS"] as &$arItem)
{
    $res = CIBlockElement::GetByID($arItem['ID']);
    if($ar_res = $res->GetNext())
        $arItem['DATE_ACTIVE_PROMO'] = dateActive($ar_res['DATE_ACTIVE_FROM'],$ar_res['DATE_ACTIVE_TO']);

}
?>