<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?php
    $IBLOCK_ID = 8;
    CModule::IncludeModule('iblock');
    $product_code = $_POST['CODE_PRODUCT'];

    /*Ищим раздел в отзывах*/
    $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y','CODE'=>$_POST['CODE_PRODUCT']);
    $section = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);

    $arResult = array(
        "NAME" => $_POST['NAME'],
        "EMAIL" => $_POST['EMAIL'],
        "RATING" => $_POST['RATING'],
        "BENEFITS" => $_POST['BENEFITS'],
        "DISADVANTAGES" => $_POST['DISADVANTAGES'],
        "COMMENT" => $_POST['COMMENT']
    );

    $ar_result = $section->GetNext();

    if( !empty($ar_result) )
    {
        $ID_SECTION = $ar_result['ID'];
        $idElement = addElementReview($arResult,$ID_SECTION,$IBLOCK_ID);

    }
    else {
        $ID_SECTION = addSectionReview($_POST['NAME_PRODUCT'],$_POST['CODE_PRODUCT'],$IBLOCK_ID);
        $idElement = addElementReview($arResult,$ID_SECTION,$IBLOCK_ID);
    }
    echo '<div class="page-empty">
		  	<div class="title large-text color-text text-light light center-align">Вы оставили отзыв. После модерации Ваш отзыв будет опубликрван.
		  	<div><button class="btn standart-color btn-toggle-block" onclick="data_block(this);" data-block="#reviews-form,#reviews-res">Вернутся к отзывам</button></div>
		  	</div>
		</div>';

function addSectionReview($NAME,$CODE,$IBLOCK_ID){
    CModule::IncludeModule('iblock');
    $bs = new CIBlockSection;
    $arFields = Array(
        "ACTIVE" => 'Y',
        "IBLOCK_ID" => $IBLOCK_ID,
        "NAME" => $NAME,
        "CODE" => $CODE
    );
    $ID = $bs->Add($arFields);
    $res = ($ID>0);
    if(!$res)
        echo $bs->LAST_ERROR;
    return $ID;

}
function addElementReview($arResult,$ID_SECTION,$IBLOCK_ID){
    CModule::IncludeModule('iblock');
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"RATING","VALUE"=>$arResult['RATING']));
    while($rating = $property_enums->GetNext())
    {
        $arRating = $rating["ID"];
    }
    $current_date = dateActiveFrom(date('d.m.Y'));
    $NAME = $current_date.' '.$arResult['NAME'];
    $arFields = array(
        "ACTIVE" => "N",
        "IBLOCK_ID" => $IBLOCK_ID,
        "IBLOCK_SECTION_ID" => $ID_SECTION,
        "NAME" => $NAME,
        "DETAIL_TEXT" => "Описание элемента",
        "PROPERTY_VALUES" => array(
            "NAME" =>   $arResult['NAME'],
            "EMAIL" =>  $arResult['EMAIL'],
            "RATING" => array('VALUE' => $arRating),
            "BENEFITS" =>   $arResult['BENEFITS'],
            "DISADVANTAGES" =>  $arResult['DISADVANTAGES'],
            "COMMENT"=> $arResult['COMMENT']
        )
    );
    $oElement = new CIBlockElement();
    $idElement = $oElement->Add($arFields, false, false, true);
    return $idElement;
}
?>