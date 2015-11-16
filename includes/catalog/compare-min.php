<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
    $arCompare = $_SESSION["CATALOG_COMPARE_LIST"][$arZSettings['CATALOG_ID']]["ITEMS"];
    $countCompare = count($arCompare);

if($_POST['checkCompare'] != 'Y'){
?>
    <?if($countCompare == 0){?>
        <span class="compare-text"><svg class="icon"><use xlink:href="#stat"/></svg> Нет товаров к сравнению</span>
    <?}else{?>

        <span class="compare-text">
                        <svg class="icon"><use xlink:href="#stat"/></svg>
            <? echo $countCompare." ".wordForm($countCompare,'товар','товара','товаров')." к ";?><a href="/compare/" class="compare-text">сравнению</a>
                   </span>
    <?}?>
<?}else{
    if(count($arCompare) < 5)
    {
        echo 'N';
    }
    else
    {
        echo 'Y';
    }

}?>