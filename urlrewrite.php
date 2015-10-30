<?
$arUrlRewrite = array(
    array(
        "CONDITION" => "#^/news/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/news/detail.php",
    ),
    array(
        "CONDITION" => "#^/promo/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/promo/detail.php",
    ),
    array(
        "CONDITION" => "#^/brand/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/brand/detail.php",
    ),
    /*personal*/
    array(
        "CONDITION" => "#^/personal/account/update/#",
        "PATH" => "/personal/account/update_personal.php",
    ),
    array(
        "CONDITION" => "#^/personal/account/password/#",
        "PATH" => "/personal/account/update_password.php",
    ),
    array(
        "CONDITION" => "#^/personal/registration/?#",
        "PATH" => "/personal/registration.php",
    ),
    /*end personal*/

    /*address*/
    array(
        "CONDITION" => "#^/personal/address/add/#",
        "PATH" => "/personal/address/add_address.php",
    ),
    array(
        "CONDITION" => "#^/personal/address/update/?#",
        "PATH" => "/personal/address/update_address.php",
    ),
    /*end address*/
);

?>