<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Регистрация');
?>
<?if($USER->IsAuthorized()):
    header("Location: /personal/account/");
    exit();
endif;?>

<?
    $show_field = array(
        "LAST_NAME",
        "NAME",
        "WORK_PHONE",
        "WORK_COMPANY",
        "UF_TYPE_ORGANIZATION",
        "UF_CONTACT_MANAGER",
        "UF_LEGAL_ADDRESS",
        "UF_INN",
        "UF_KPP",
        "UF_OGRN",
        "UF_OKPO",
        "UF_CHECKING_ACCOUNT",
        "UF_CORR_ACCOUNT",
        "UF_NAME_BANK",
        "UF_BIC_BANK",
        "UF_USER_TYPE"
    );
?>
<div class="workarea">
    <h1 class="page-title">Регистрация</h1>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.register",
        "registration",
		//"",
        Array(
            //"COMPONENT_TEMPLATE" => "",
            "SHOW_FIELDS" => $show_field,
            "REQUIRED_FIELDS" => array(),
            "AUTH" => "Y",
            "USE_BACKURL" => "N",
            "SUCCESS_PAGE" => "/personal/?registration=yes",
            "SET_TITLE" => "Y",
            "USER_PROPERTY" => array(),
            "USER_PROPERTY_NAME" => ""
        )
    );?>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>