/*
* route - путь до компонента /include/promo/list.php
* page_number - номер страницы для подгрузки материала
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
/*для регистрации*/
function setLogin(event)
{
    $('input#login-name').val($(event).val());
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
