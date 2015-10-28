<?php
class CUserAddress{
    const MODULE_ID = 'useraddress';
    public static function getAddressUser($user_id)
    {
        global $DB;
        $sql = "SELECT * FROM b_user_address WHERE ID_USER = '".$user_id."'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult[] = $record;
        }
        return $arResult;
    }
    public static function getUsersId()
    {
        $cUser = new CUser;
        $sort_by = "ID";
        $sort_ord = "ASC";
        $arFilter = array(
            "ACTIVE" => 'Y',
        );
        $dbUsers = $cUser->GetList($sort_by, $sort_ord, $arFilter);
        $dbUsers->NavStart(8);
        return $dbUsers;
    }
    public static function getAddressId($id){
        global $DB;
        $sql = "SELECT * FROM b_user_address WHERE ID = '".$id."'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult[] = $record;
        }
        return $arResult;
    }

    public static function getAddressDefault($user_id){
        global $DB;
        $sql = "SELECT * FROM b_user_address WHERE ID_USER = '".$user_id."' AND DEFAULT_ADDRESS = 'Y'";
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult = $record;
        }
        return $arResult;
    }

    public static function updateUserAddress($parametr){
        global $DB;
        $default = (isset($parametr['DEFAULT_ADDRESS'])) ? 'Y' : 'N';
        $date = date('Y-m-d H:i:s');
        if($default == 'Y')
        {
            $sql = "UPDATE b_user_address SET
                DEFAULT_ADDRESS= 'N'
                WHERE ID_USER=".IntVal($parametr['ID_USER'])." AND DEFAULT_ADDRESS = 'Y'";
            $DB->Query($sql);
        }
        $sql = "UPDATE b_user_address SET
                ID_USER=".IntVal($parametr['ID_USER']).",
                DEFAULT_ADDRESS='".$default."',
                CITY='".$parametr['CITY']."',
                STREET='".$parametr['STREET']."',
                HOME='".$parametr['HOME']."',
                HOUSING='".$parametr['HOUSING']."',
                FLAT='".$parametr['FLAT']."',
                DATE_UPDATE='".$date."'
                 WHERE ID=".IntVal($parametr['ID']);
        $DB->Query($sql);
        return 'OK';
    }

    public static function setUserAddress($parametr){
        global $DB;
        $default = (isset($parametr['DEFAULT_ADDRESS'])) ? 'Y' : 'N';
        $date = date('Y-m-d H:i:s');
        if($default == 'Y')
        {
            $sql = "UPDATE b_user_address SET
                DEFAULT_ADDRESS= 'N'
                WHERE ID_USER=".IntVal($parametr['ID_USER'])." AND DEFAULT_ADDRESS = 'Y'";
            $DB->Query($sql);
        }
        $sql = "INSERT INTO b_user_address (
                  ID_USER,
                  DEFAULT_ADDRESS,
                  CITY,
                  STREET,
                  HOME,
                  HOUSING,
                  FLAT,
                  DATE_CREATE
                  ) VALUES(
                  ".IntVal($parametr['ID_USER']).",
                  '".$default."',
                  '".$parametr['CITY']."',
                  '".$parametr['STREET']."',
                  '".$parametr['HOME']."',
                  '".$parametr['HOUSING']."',
                  '".$parametr['FLAT']."',
                  '".$date."'
                  )";
        $DB->Query($sql);
        return 'OK';
    }

    public static function setUserAddressDefault($id,$user_id){
        global $DB;
        $date = date('Y-m-d H:i:s');

        $check = self::checkUserAddress($id,$user_id);
        if($check == 'true') {
            $sql = "UPDATE b_user_address SET
                DEFAULT_ADDRESS= 'N',
                DATE_UPDATE = '" . $date . "'
                WHERE ID_USER=" . IntVal($user_id) . " AND DEFAULT_ADDRESS = 'Y'";
            $DB->Query($sql);

            $sql = "UPDATE b_user_address SET
                DEFAULT_ADDRESS= 'Y',
                DATE_UPDATE = '" . $date . "'
                WHERE ID_USER=" . IntVal($user_id) . " AND ID = " . IntVal($id);
            $DB->Query($sql);
        }
    }

    public static function removeUserAddress($id,$user_id){
        global $DB;
        $check = self::checkUserAddress($id,$user_id);
        if($check == 'true') {
            $sql = "DELETE FROM b_user_address WHERE ID=" . $id;
            $DB->Query($sql);
        }
    }

    /*Проверка на принадлежность пользователя к данному адресу*/
    public static function checkUserAddress($id,$user_id){
        global $DB;
        $sql = "SELECT * FROM b_user_address WHERE ID_USER = '".$user_id."' AND ID =".$id;
        $result = $DB->Query($sql);
        $arResult = array();
        while ($record = $result->fetch()) {
            $arResult = $record;
        }
        if (!empty($arResult)){
            return 'true';
        }else{
            return 'false';
        }
    }
    /**/
}