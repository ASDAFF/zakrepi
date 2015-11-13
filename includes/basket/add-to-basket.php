<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$id_product = intval(htmlspecialchars($_POST['id_product']));
$delay = $_POST['delay'];
CModule::IncludeModule('iblock');
$res = CIBlockElement::GetByID($id_product);
if($ar_res = $res->GetNext())
    $name = $ar_res['NAME'];

if (CModule::IncludeModule("catalog"))
{
    /*if (($action == "ADD2BASKET" || $action == "BUY") && IntVal($PRICE_ID)>0)
    {*/
    if($delay != 'Y') {
        Add2BasketByProductID(
            $id_product,
            1,
            array()
        );
    echo $name;
    }
    else{
        Add2BasketByProductID(
            $id_product,
            1,
            array("DELAY" => "Y"),
            array()
        );
        echo $name.'delay';
    }
    //}
}
?>