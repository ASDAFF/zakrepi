<?php
class CCityFranchise {
    const MODULE_ID = 'cityfranchise';
    const HOST_DB = '194.58.107.242';
    const USER = 'legacy_zakrepi';
    const PASSWORD = '7A3eea29';
    const NAME_DB = 'legacy_zakrepi_franchise_city';

    public static function getListCity()
    {
        $db = mysql_connect(self::HOST_DB, self::USER, self::PASSWORD);
        mysql_query("set names utf8", $db);
        mysql_select_db(self::NAME_DB,$db)  or die("Нет соединения с БД".mysql_error());
        $result = mysql_query("SELECT * FROM b_franchise_city",$db);
        $arResult = array();
        while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
             $arResult[] = $row;
        }
        return $arResult;
    }
}