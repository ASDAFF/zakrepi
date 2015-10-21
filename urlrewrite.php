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
);

?>