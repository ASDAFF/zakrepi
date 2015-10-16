<?php
use Bitrix\Main\Entity;
class CBannerGrid{
    const MODULE_ID = 'bannergrid';
    public static function getBannerGrid($num){
        global $DB;
        $sql = "SELECT * FROM b_banner_grid WHERE BG_NUMBER = '".$num."'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult[] = $record;
        }
        return $arResult;
    }
    public static function getAllElementIblock(){
        CModule::IncludeModule('iblock');
        $IBLOCK_ID =  COption::GetOptionString(self::MODULE_ID, 'bgIblockId', 1);
        $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
        $arFilter = array(
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE"=>"Y",
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arResult = array();
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            /*$find = self::findBannerGrid($arFields['ID']);
            if(count($find)<=0)
            {*/
                $arResult[] = $arFields;
            //}
        }
        return $arResult;
    }

    public static function getElementIblockBanner($id){
        CModule::IncludeModule('iblock');
        $IBLOCK_ID =  COption::GetOptionString(self::MODULE_ID, 'bgIblockId', 1);
        $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
        $arFilter = array(
            "ID"=> $id,
            "IBLOCK_ID" => $IBLOCK_ID,
            "ACTIVE"=>"Y",
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arResult = array();
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $arResult[] = $arFields;
        }
        return $arResult;
    }

    /*public static function findBannerGrid($id)
    {
        global $DB;
        $sql = "SELECT * FROM b_banner_grid WHERE BG_IDBANERS = '".$id."'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult[] = $record;
        }
        return $arResult;
    }*/
    public static function saveParametrBanner($param)
    {
        /*
         * PARAMETR_X
         * ID_X
         * SIZE_X
         */
        global $DB;
        for($i = 1; $i <= 8; $i++)
        {
            $find = self::findBannerGridID($param['ID_'.$i]);
            $parametr = $param['PARAMETR_'.$i];
            if(count($find)<=0)
            {
                $strSql = "INSERT INTO b_banner_grid (BG_NUMBER,BG_IDBANERS) VALUES('$i','$parametr')";
                $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
            }
            else{
                $strSql = "UPDATE b_banner_grid SET BG_IDBANERS=".IntVal($parametr)." WHERE BG_NUMBER=".IntVal($i);
                $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
            }
        }
    }

    public static function findBannerGridID($id)
    {
        global $DB;
        $sql = "SELECT * FROM b_banner_grid WHERE BG_NUMBER = '".$id."'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult[] = $record;
        }
        return $arResult;
    }
}
?>