/*
* route - путь до компонента /include/promo/list.php
* page_number - номер страницы для подгрузки материала
* route_param - параметры которые необходимо передать для подгрузки нужного контента является не обязательным параметром
* */
function ajax(route,route_url,page_number,route_param)
{
    if(route_param===undefined)
        var url = route_url+'?PAGEN_1='+page_number;
    else
        var url = route_url+'?'+route_param+'&PAGEN_1='+page_number;
    $('.btn-more').hide();
    $('.btn-more.loader').show();
    $.ajax({
        url: url,
        success: function(data) {
            $('.pagination-'+route).remove();
            $('#'+route+'-list').append(data);
        }
    });

}

/*
*
*   Загрузка дополнительной информации продукта (Технические характеристики, Аксессуары, Отзывы о товаре, Наличие в магазинах)
*   id - ID продукта
*   route - параметр к классу и id элемента для подгрузки
*   route_url - путь к странице подгрузки дополнительных материалов
*
*/
function ajax_more_information_product(id,route, route_url){

    /*Проверяем загружали этот материал до этого*/
    if(!$('#route-'+route).hasClass('upload')) {
        var url = route_url + '?ID_PRODUCT=' + id;
        //$('.btn-more').hide();
        $('.loader-' + route).show();
        $.ajax({
            url: url,
            success: function (data) {
                $('.loader-' + route).hide();
                $('#route-' + route).addClass('upload');
                $('#route-' + route).html(data);
            }
        });
    }
}
/*
*   Форма отрабатывается по ajax
*   id_result = #id_result DOM
*   id_form = #id_form DOM
*   action = путь до php обработки
*/
function ajax_form_request(id_result,id_form,action){

    error_count = 0;

    $("#"+id_form+" .required").each(function(){
        $(this).change();
    });
    //$('input[type="email"].required, input[type="text"].required, input[type="text"].required.numbers').change();
    if (error_count>0)
    {
        return false;
    }
    else {
        $("#"+id_form+" .loader-form").removeClass('hide');
        $.ajax({
            url: action,
            type: "POST",
            dataType: "html",
            data: $("#" + id_form).serialize(),
            success: function (data) {
                $("#"+id_form).addClass('hide');
                $("#" + id_result).html(data);
                $("#" + id_result).removeClass('hide');
            }
        });
    }
}
/*Показать скрытые блоки*/
function data_block($this)
{
    if($($this).attr('data-hide-block')){
        $($($this).attr('data-hide-block')).addClass('hide');
    }
    if ($($this).attr('data-show-block')) {
        $($($this).attr('data-show-block')).removeClass('hide');
    }
    if ($($this).attr('data-block')){
        $($($this).attr('data-block')).toggleClass('hide');
    }
    if($($this).is('a')){
        return false;
    }
}

/*для регистрации*/
function setLogin(event)
{
    $('input#login-name').val($(event).val());
}

/*Выбор свойства у товара*/
function select_prop(sel_id,id_elem,detail)
{

    var id_product = $('#'+sel_id).val();
    var price_product = $('#'+sel_id+' option:selected').attr('data-price');
    /*Пересчет параметров для favorites*/
    var favorite = "favorite_product('"+id_product+"')";

    $('#favorite-'+id_elem).attr('onclick',favorite);
    /*if(detail == 'Y')
    {
        $('.shop_yes').hide();
        var shops = $('#'+sel_id+' option:selected').attr('data-list-store');
        var shopsList = shops.split(',');
        for (var item in shopsList) {
            $('#id_store_'+shopsList[item]).show();
        }
    }*/
    $('#price_'+id_elem).html(priceShow(price_product));
    var onclick = "add_basket('"+id_product+"','"+id_elem+"')";
    $('#'+id_elem).attr('onclick',onclick);
}

/*Аналог php функции function priceShow($str)*/
function priceShow(price)
{
    var result = '';
    if(isInteger(price))
    {
        result = price.toFixed(0) + '&nbsp;<i class="rouble">i</i>';
    }
    else
    {
        result = price.toFixed(2) + '&nbsp;<i class="rouble">i</i>';
    }
    return result;
}
/*Проверка является ли число целым*/
function isInteger(num) {
    return (num ^ 0) === num;
}
/*Добавление в корзину товара*/
function add_basket(id_product,id_elem)
{
    $('#'+id_elem).hide();
    $('#loader-'+id_elem).show();
    $('.loader-small-basket').show();
    $.ajax({
        type: "POST",
        url: "/includes/basket/add-to-basket.php",
        data: "id_product="+id_product,
        success: function(msg){
            /*BX.onCustomEvent('basket_update');
            $('.modal .name-products').html(msg);
            $('#add_basket_ok,.eclipse').show();*/
            //$('.loader-small-basket').show();
            uploadSmallBasket(id_elem);
        }
    });
}
/*Обновление малой корзины*/
function uploadSmallBasket(id_elem)
{
    $.ajax({
        type: "POST",
        url: "/includes/header/small-basket.php",
        success: function(msg){

            $('#'+id_elem).show();
            $('#loader-'+id_elem).hide();
            $('#minicard-popup').addClass('show');

            $('#small-basket-ajax').html(msg);
        }
    });
}

/*Добавление в сравниение товара*/
function compare_product(id_product,url_compare)
{
    /*Проверка на превышение сравниваемых товаров*/
        if ($('#compare_today_' + id_product).prop('checked')) {
             $.ajax({
                    type: "POST",
                    url: '' + url_compare + '',
                    data: {id: id_product, action: "ADD_TO_COMPARE_LIST"},
                    success: function (msg) {
                        $('#compare_today_' + id_product).removeClass('no-check');
                        $('#compare_today_' + id_product).addClass('checked');
                        checkCompare();
                        updateCompareMin();
                    }
                });

        } else {
            $.ajax({
                type: "POST",
                url: '' + url_compare + '',
                data: {ID: id_product, action: "DELETE_FROM_COMPARE_RESULT"},
                success: function (msg) {
                    $('#compare_today_' + id_product).addClass('no-check');
                    $('#compare_today_' + id_product).removeClass('checked');
                    checkCompare();
                    updateCompareMin();
                }
            });
        }
}
/*Проверка на возможность добавить в сравнение*/
function compare_product_check(id)
{
    if($('#'+$(id).attr('for')).prop('disabled') == true){
        $('#compare-full-notification').css('top',$(id).offset().top - 500);
        $('.dark-bg, #compare-full-notification').fadeIn(500);
        return false;
    }
}
/*обновить малую иконку сравнения*/
function updateCompareMin()
{
    $.ajax({
        type: "POST",
        url: "/includes/catalog/compare-min.php",
        success: function(msg){
            $('#compare-small').html(msg);
        }
    });
}
/*Проверка на превышение сравниваемых товаров*/
function checkCompare(){
    $.ajax({
        type: "POST",
        url: '/includes/catalog/compare-min.php',
        data: {checkCompare: "Y"},
        success: function (msg) {
            if(msg == 'Y') $('.compare-input.no-check').attr('disabled','disabled');
            else  $('.compare-input.no-check').removeAttr('disabled');
        }
    });
}

/*Добавление в избранное*/
function favorite_product(id_product){
    $.ajax({
        type: "POST",
        url: "/includes/basket/add-to-basket.php",
        data: "id_product="+id_product+'&delay=Y',
        success: function(html){
            $('#favcnt').html(html);
        }
    });
};
/*Удаление из избранного*/
function remove_favorite(id)
{
    $('#loader-favorite-'+id).removeClass('hide');
    $.ajax({
        type: "POST",
        url: "/personal/favorites/",
        data: "action=delete&"+"id=" + id,
        success: function(html){
            //$(th).addClass('favactive');
            $('#favorite-'+id).remove();
        }
    });
}
/*Добавление товара в корзину из избранного*/
function add_basket_in_favorite(id)
{
    $('#loader-favorite-'+id).removeClass('hide');
    $('.loader-small-basket').show();
    $.ajax({
        type: "POST",
        url: "/personal/favorites/",
        data: "action=add&id="+id,
        success: function(msg){
            uploadSmallBasket_in_favorite(id);
        }
    });
}
function uploadSmallBasket_in_favorite(id){
    $.ajax({
        type: "POST",
        url: "/includes/header/small-basket.php",
        success: function(msg){

            $('#favorite-'+id).remove();
            $('#minicard-popup').addClass('show');
            $('#small-basket-ajax').html(msg);
        }
    });
}
/*Показать окно о том что нужно авторизоваться*/
function showPopupAuthorized(){
    alert("Только авторизованный пользователь может добавить товар в избранное");
}
/*Показать окно о заказе товара в 1 клик*/
function buyInOneClick(id)
{
    $('input[name="PRODUCT_ID"]').val(id);
    $('.dark-bg').show();
    $('#one-click-form_product-id').show();
}


/*Валидация форм*/
function isValidEmail (email, strict)
{
    if ( !strict ) email = email.replace(/^s+|s+$/g, '');
    return (/^([a-z0-9_-]+.)*[a-z0-9_-]+@([a-z0-9][a-z0-9-]*[a-z0-9].)+[a-z]{2,4}$/i).test(email);
}

function isNumeric(value){
    return (/^[\d]+$/g).test(value);
}

function isRussian(value){
    return (/[а-яА-Я]+/g).test(value);
}

function checkEmail(val, obj){
    var error = false;
    if (val != null && val != "")
    {
        if (!isValidEmail(val))
        {
            obj.addClass("invalid-pattern");
            error = true;
            return error;
        }
        else
        {
            obj.removeClass("invalid-pattern");
            return error;
        }
    }
    else
    {
        obj.removeClass("invalid-pattern");
        return error;
    }
}

function checkNumbers(val, obj){
    var error = false;
    if (val != null && val != "")
    {
        if(isNumeric(val))
        {
            obj.removeClass("invalid-pattern");
            return error;
        }
        else
        {
            obj.addClass("invalid-pattern");
            error = true;
            return error;
        }
    }
    else
    {
        obj.removeClass("invalid-pattern");
        return error;
    }
}

function checkLatin(val, obj){
    if (val != null && val != "")
    {
        if(!isRussian(val))
        {
            obj.closest('.row_form').removeClass("error_row").find('.latin_field').hide();
        }
        else
        {
            obj.closest('.row_form').addClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').find('.latin_field').show();
        }
    }
    else
    {
        obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
    }
}

function checkPassword(val, obj){
    var error = false;
    if (val != null && val != "")
    {
        if(isRussian(val))
        {
            obj.addClass("invalid-pattern");
            error = true;
            return error;
        }
        else if(val.length < 6)
        {
            obj.addClass("invalid-pattern");
            error = true;
            return error;
        }
        else
        {
            obj.removeClass("invalid-pattern");

            return error;
        }
    }
    else
    {
        obj.removeClass("invalid-pattern");
        return error;
    }
}
function checkPassword_inp(val, obj){
    var error = false;
    if (val != null && val != "")
    {
        if(val != $('.pass').val())
        {
            obj.addClass("invalid-pattern");
            error = true;
            return error;
        }
        else
        {
            obj.removeClass("invalid-pattern");
            return error;
        }
    }
    else
    {
        obj.removeClass("invalid-pattern");
        return error;
    }
}

function checkEmptiness(val, obj)
{
    var error = false;
    if (val == null || val == "")
    {
        obj.addClass("invalid-pattern");
        error = true;
        return error;
    }
    else{
        obj.removeClass("invalid-pattern");
        return error;
    }
}

function clearClassError(val, obj)
{
    obj.removeClass('invalid-pattern');
    obj.val('');
}

function number_format( number, decimals, dec_point, thousands_sep ) {	// Format a number with grouped thousands

	var i, j, kw, kd, km;

	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");

	return km + kw + kd;
}

function isInteger(num) {
  return (num ^ 0) === num;
}

function priceShow(str)
{
    var newStr = parseFloat(str);
	var result = '';
	
    //if(str.indexOf(".") != -1)
	if (!isInteger(newStr))
        result = number_format(newStr, 2, '.', ' ') + '&nbsp;<i class="rouble">i</i>';
    else
        result = number_format(newStr, 0, '.', ' ') + '&nbsp;<i class="rouble">i</i>';
	
	return result;
}
