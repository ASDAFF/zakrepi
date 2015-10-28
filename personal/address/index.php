<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>
    <div id="address-list">
        <?include($_SERVER['DOCUMENT_ROOT'].'/includes/personal/address/list.php')?>
    </div>
    <script>
        function removed(id,user_id)
        {
            $('.address-loader').show();
            $.ajax({
                type: "POST",
                url: '/local/modules/useraddress/lib/function/component/function_component.php',
                data: "id=" + id +"&user_id="+user_id+"&remove=Y",
                success: function(){
                    $.ajax({
                        url: '/includes/personal/address/list.php',
                        success: function(msg){
                            $('#address-list').html(msg);
                            $('.address-loader').hide();
                        }
                    });
                }
            });
        }
        function set_default_address(id,user_id)
        {
            $('.address-loader').show();
            $.ajax({
                type: "POST",
                url: '/local/modules/useraddress/lib/function/component/function_component.php',
                data: "id=" + id +"&user_id="+user_id+"&default=Y",
                success: function(){
                    $.ajax({
                        url: '/includes/personal/address/list.php',
                        success: function(msg){
                            $('#address-list').html(msg);
                            $('.address-loader').hide();
                        }
                    });
                }
            });
        }
    </script>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>