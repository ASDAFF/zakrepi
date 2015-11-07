<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    $id_product = $_GET['ID_PRODUCT'];
    CModule::IncludeModule('iblock');

    $arSelect = Array("ID", "IBLOCK_ID", "NAME","CODE", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
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
        <span class="sort-text">Сортировать по:</span>
        <input type="radio" class="hide sort-ctrl" name="sort" id="sort-date" value="date"/>
        <label class="sort-item" for="sort-date">дате</label>
        <input type="radio" class="hide sort-ctrl" name="sort" id="sort-rating" value="rating"/>
        <label class="sort-item" for="sort-rating">рейтингу</label>
    </div>
    <button class="btn primary col l2 right btn-toggle-block" data-block="#reviews-form,#reviews-res">Оставить отзыв</button>
</div>
<div class="reviews-list" id="reviews-list">
    <?
        /*$APPLICATION->IncludeFile('/includes/product/reviews/list.php', array(
            "PRODUCT_CODE"=> $product_code
        ),array());*/
    ?>
    <?include($_SERVER['DOCUMENT_ROOT'].'includes/product/reviews/list.php');?>
</div>

<div class="container hide" id="reviews-form">
<div class="subtitle">Ваш отзыв о <?=$arFields['NAME'];?></div>
<div class="row">
    <div class="col l6">
        <div class="table-field top-tf">
            <div class="label">Имя</div>
            <div class="field">
                <input type="text" required />
                <span class="error-text error-required">Укажите свое имя</span>
            </div>
        </div>
        <div class="table-field top-tf">
            <div class="label">Электронная почта</div>
            <div class="field">
                <input type="email" required />
                <!-- 	.error-text - для всех ошибок,
                        .error-required, .error-pattern - можно задать разный текст для разных ошибок
                    -->
                <span class="error-text error-required error-pattern">Укажите электронную почту в формате mymail@mail.ru</span>
            </div>
        </div>
        <div class="table-field top-tf">
            <div class="label">Рейтинг</div>
            <div class="field rating-field">
                <input class="hide rating-value" type="text"/>
                <div class="rating rate-1">
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                    <svg class="star"><use xlink:href="#star"/></svg>
                </div>
            </div>
        </div>
        <div class="table-field top-tf">
            <div class="label">Достоинства</div>
            <div class="field"><textarea></textarea></div>
        </div>
        <div class="table-field top-tf">
            <div class="label">Недостатки</div>
            <div class="field"><textarea></textarea></div>
        </div>
        <div class="table-field top-tf">
            <div class="label">Комментарий</div>
            <div class="field"><textarea></textarea></div>
        </div>
        <div class="table-field action-box">
            <div class="second-field cols-2">
                <button class="btn standart-color btn-toggle-block" data-block="#reviews-form,#reviews-res">Отменить</button>
                <button class="btn primary">Оставить отзыв</button>
            </div>
        </div>
    </div>
</div>
</div>