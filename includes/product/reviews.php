<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    $id_product = $_GET['ID_PRODUCT'];
    CModule::IncludeModule('iblock');

    $arSelect = Array("ID", "IBLOCK_ID","IBLOCK_SECTION_ID", "NAME","CODE", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("ID"=>IntVal($id_product), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
    }

    $product_code = $arFields['CODE'];
?>
<div class="subtitle">Отзывы о <?=$arFields['NAME'];?></div>

<div class="row">
    <div class="sort-box col l6">
        <?/*Сортировка?>

        <span class="sort-text">Сортировать по:</span>
        <input type="radio" class="hide sort-ctrl" name="sort" id="sort-date" value="date"/>
        <label class="sort-item" for="sort-date">дате</label>
        <input type="radio" class="hide sort-ctrl" name="sort" id="sort-rating" value="rating"/>
        <label class="sort-item" for="sort-rating">рейтингу</label>

        <?/*Конец сортировки*/?>
    </div>
    <button class="btn primary col l2 right btn-toggle-block" onclick="data_block(this);" data-block="#reviews-form,#reviews-res">Оставить отзыв</button>
</div>
<div class="reviews-list" id="reviews-list">

    <?include($_SERVER['DOCUMENT_ROOT'].'includes/product/reviews/list.php');?>
</div>