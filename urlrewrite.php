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
     array(
        "CONDITION" => "#^/vacancy/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/vacancy/detail.php",
    ),
    
    array(
        "CONDITION" => "#^/articles/post/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:news.detail",
        "PATH" => "/articles/detail.php",
    ),
    /*personal*/
    array(
        "CONDITION" => "#^/personal/account/update/#",
        "PATH" => "/personal/account/update_personal.php",
    ),
    array(
        "CONDITION" => "#^/personal/registration/?#",
        "PATH" => "/personal/registration.php",
    ),
    array(
        "CONDITION" => "#^/personal/auth/?#",
        "PATH" => "/personal/auth.php",
    ),
    array(
        "CONDITION" => "#^/personal/favorites/?#",
        "PATH" => "/personal/favorites.php",
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

    /*catalog*/
    array(
        "CONDITION" => "#^/catalog/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:catalog.section",
        "PATH" => "/catalog/index.php",
    ),
    array(
        "CONDITION" => "#^/item/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:catalog.section",
        "PATH" => "/catalog/detail.php",
    ),

    /*end catalog*/

    /*static page*/
    array(
        "CONDITION" => "#^/delivery/#",
        "PATH" => "/static_page/delivery.php",
    ),
     array(
        "CONDITION" => "#^/warranty-and-returns/#",
        "PATH" => "/static_page/warranty-and-returns.php",
    ),
      array(
        "CONDITION" => "#^/organization/#",
        "PATH" => "/static_page/organization.php",
    ),
       array(
        "CONDITION" => "#^/shops/#",
        "PATH" => "/static_page/shops.php",
    ),

    array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/static_page/history.php",
    ),
     array(
        "CONDITION" => "#^/structura/#",
        "PATH" => "/static_page/structura.php",
    ),
     array(
        "CONDITION" => "#^/contacts/#",
        "PATH" => "/static_page/contacts.php",
    ),

    /*
      array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
       array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
        array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
         array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
          array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
           array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
            array(
        "CONDITION" => "#^/history/#",
        "PATH" => "/content/history.php",
    ),
    /*array(
        "CONDITION" => "#^/item/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
        "RULE" => "code=\$1",
        "ID" => "bitrix:catalog.section",
        "PATH" => "/catalog/detail.php",
    ),*/
    /*end static page*/
);

?>