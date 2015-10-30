/*
* route - путь до компонента /include/promo/list.php
* page_number - номер страницы для подгрузки материала
* */
function ajax(route,page_number)
{
    var url = '/includes/'+route+'/list.php?PAGEN_1='+page_number;
    $('.btn-more').hide();
    $('.loader').show();
    $.ajax({
        url: url,
        success: function(data) {
            $('.pagination-'+route).remove();
            $('#'+route+'-list').append(data);
        }
    });

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
    if (val != null && val != "")
    {
        if (!isValidEmail(val))
        {
            obj.addClass("error");
        }
        else
        {
            obj.removeClass("error");
        }
    }
    else
    {
        obj.removeClass("error");
    }
}

function checkNumbers(val, obj){
    if (val != null && val != "")
    {
        if(isNumeric(val))
        {
            obj.removeClass("error");
        }
        else
        {
            obj.addClass("error");
        }
    }
    else
    {
        obj.removeClass("error");
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
    if (val != null && val != "")
    {
        if(isRussian(val))
        {
            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').addClass("error_row").find('.latin_field').show();
            obj.closest('.row_form').removeClass("ok_row");
        }
        else if(val.length < 6)
        {
            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').addClass("error_row").find('.length_field').show();
            obj.closest('.row_form').removeClass("ok_row");
        }
        else
        {
            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').addClass("ok_row");
            //obj.closest('.row_form').find('.latin_field').show();
        }
    }
    else
    {
        obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
    }
}
function checkPassword_inp(val, obj){
    if (val != null && val != "")
    {
        if(val != obj.parent().prev().children('.paswd').val())
        {
            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').addClass("error_row").find('.pass_field').show();
            obj.closest('.row_form').removeClass("ok_row");
        }
        else
        {
            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
            obj.closest('.row_form').addClass("ok_row");
            //obj.closest('.row_form').find('.latin_field').show();
        }
    }
    else
    {
        obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
    }
}

function clearClassError(val, obj)
{
    obj.removeClass('error');
    obj.val('');
}
