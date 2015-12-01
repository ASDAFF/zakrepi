<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule('sale');
if (!class_exists('LegacyProcess') && file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/sale/payment/legacy.gazprombank/LegacyProcess.php')) {
    include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/sale/payment/legacy.gazprombank/LegacyProcess.php');
}

$arOrder = LegacyProcess::l__0((int)$_GET['o_order_id'], $_GET);
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment.receive",
    "",
    Array(
        "PAY_SYSTEM_ID" => $arOrder["PAY_SYSTEM_ID"],
        "PERSON_TYPE_ID" => $arOrder["PERSON_TYPE_ID"]
    ),
    false
);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');