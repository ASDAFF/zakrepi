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