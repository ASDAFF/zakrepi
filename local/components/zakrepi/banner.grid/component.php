<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */
if(!CModule::IncludeModule("bannergrid"))
    return;

$elem =  CBannerGrid::getBannerGrid(1);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);
$arResult[0] = array(
    'SIZE' => 'big',
    'SIZE_DIV' => 'big',
    'STYLE' => 'col l6',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);

$elem =  CBannerGrid::getBannerGrid(2);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[1] = array(
    'SIZE' => 'small',
    'NUM' => 1,
    'SIZE_DIV' => 'small',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);


$elem =  CBannerGrid::getBannerGrid(3);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[2] = array(
    'SIZE' => 'small',
    'NUM' => 2,
    'SIZE_DIV' => 'small',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);


$elem =  CBannerGrid::getBannerGrid(4);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[3] = array(
    'SIZE' => 'medium',
    'NUM' => 1,
    'SIZE_DIV' => 'big',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);

$elem =  CBannerGrid::getBannerGrid(5);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[4] = array(
    'SIZE' => 'medium',
    'SIZE_DIV' => 'big',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);

$elem =  CBannerGrid::getBannerGrid(6);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[5] = array(
    'SIZE' => 'small',
    'NUM' => 1,
    'SIZE_DIV' => 'small',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);


$elem =  CBannerGrid::getBannerGrid(7);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);

$arResult[6] = array(
    'SIZE' => 'small',
    'NUM' => 2,
    'SIZE_DIV' => 'small',
    'STYLE' => 'col l3',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);

$elem =  CBannerGrid::getBannerGrid(8);
$arBanner = CBannerGrid::getElementIblockBanner($elem[0]['BG_IDBANERS']);
$URL = CFile::GetPath($arBanner[0]['PREVIEW_PICTURE']);
$arResult[7] = array(
    'SIZE' => 'big',
    'SIZE_DIV' => 'big',
    'STYLE' => 'col l6',
    'IMG_URL' => $URL,
    'LINK' => $arBanner[0]['PROPERTY_LINK_VALUE'],
);
$this->IncludeComponentTemplate();
