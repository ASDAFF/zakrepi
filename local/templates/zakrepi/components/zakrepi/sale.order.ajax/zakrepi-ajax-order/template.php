<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			$APPLICATION->RestartBuffer();
			?>
			<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}

	}
}

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
?>

<a name="order_form"></a>

<div id="order_form_div">
	<NOSCRIPT>
		<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
	</NOSCRIPT>

	<?
	if (!function_exists("getColumnName"))
	{
		function getColumnName($arHeader)
		{
			return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
		}
	}

	if (!function_exists("cmpBySort"))
	{
		function cmpBySort($array1, $array2)
		{
			if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
				return -1;

			if ($array1["SORT"] > $array2["SORT"])
				return 1;

			if ($array1["SORT"] < $array2["SORT"])
				return -1;

			if ($array1["SORT"] == $array2["SORT"])
				return 0;
		}
	}
	?>

	<?
	if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if(!empty($arResult["ERROR"]))
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		}
		elseif(!empty($arResult["OK_MESSAGE"]))
		{
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) == 0)
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
			echo '<div class="page-title">'.GetMessage("SOA_TEMPL_HEADER").'</div><div class="row"><div class="col l7">';
			echo '<p class="page-note-text">'.GetMessage("ORDER_NOTICE").'</p>';
			?>
			<script type="text/javascript">

			<?if(CSaleLocation::isLocationProEnabled()):?>

				<?
				// spike: for children of cities we place this prompt
				$city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
				?>

				BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
					'source' => $this->__component->getPath().'/get.php',
					'cityTypeId' => intval($city['ID']),
					'messages' => array(
						'otherLocation' => '--- '.GetMessage('SOA_OTHER_LOCATION'),
						'moreInfoLocation' => '--- '.GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
						'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.GetMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
							'#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
							'#ANCHOR_END#' => '</a>'
						)).'</div>'
					)
				))?>);

			<?endif?>

			var BXFormPosting = false;
			function submitForm(val)
			{
				if (BXFormPosting === true)
					return true;

				BXFormPosting = true;
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');
				BX.showWait();

				<?if(CSaleLocation::isLocationProEnabled()):?>
					BX.saleOrderAjax.cleanUp();
				<?endif?>

				BX.ajax.submit(orderForm, ajaxResult);

				return true;
			}
            /*reload delivery*/
            function submitFormDelivery(idDOM)
            {
                $('#'+idDOM).show();
                submitForm();
            }

			function ajaxResult(res)
			{
				var orderForm = BX('ORDER_FORM');
				try
				{
					// if json came, it obviously a successfull order submit

					var json = JSON.parse(res);
					BX.closeWait();

					if (json.error)
					{
						BXFormPosting = false;
						return;
					}
					else if (json.redirect)
					{
						window.top.location.href = json.redirect;
					}
				}
				catch (e)
				{
					// json parse failed, so it is a simple chunk of html

					BXFormPosting = false;
					BX('order_form_content').innerHTML = res;

					<?if(CSaleLocation::isLocationProEnabled()):?>
						BX.saleOrderAjax.initDeferredControl();
					<?endif?>
				}

                $('#delivery-loader').hide();
                $('#paysystem-loader').hide();

				BX.closeWait();
				BX.onCustomEvent(orderForm, 'onAjaxSuccess');
			}

			function checkUserEmail(obj){
				var email = obj.value;
                $(obj).removeClass('invalid-pattern');
				if (isValidEmail(email)){
                    $(obj).parent().find('.input-loader').show();
					postdata = {'EMAIL': email};
					BX.ajax({
						url: '<?=$templateFolder?>/ajax.php',
						method: 'POST',
						data: postdata,
						dataType: 'json',
						onsuccess: function(result)
						{
                            if(result['RESULT'] == 'Y') {
                                $(obj).addClass('invalid-pattern');
                            }
                            $(obj).parent().find('.input-loader').hide();
						}
					});
				}
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}
			</script>
			<?if($_POST["is_ajax_post"] != "Y")
			{
				?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				<div id="order_form_content">
				<?
			}
			else
			{
				$APPLICATION->RestartBuffer();
			}

			if($_REQUEST['PERMANENT_MODE_STEPS'] == 1)
			{
				?>
				<input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
				<?
			}

			if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
			{
				foreach($arResult["ERROR"] as $v)
					echo ShowError($v);
				?>
				<script type="text/javascript">
					top.BX.scrollToNode(top.BX('ORDER_FORM'));
				</script>
				<?
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
			if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
				echo '<div class="base-card"><div class="title big-text">'.GetMessage("SOA_TEMPL_DELIVERY").'</div><div class="card-content">';
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
				echo '</div></div>';
			}
			else
			{
				?>
                    <div class="base-card">
                        <span class="btn flat fullsize btn-more loader order-loader" id="delivery-loader" style="display:none;">
                            <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
                        </span>
                        <div class="title big-text"><?=GetMessage("SOA_TEMPL_DELIVERY")?></div>
                        <div class="card-content">
                <?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
				?></div></div><?
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
			if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
				echo $arResult["PREPAY_ADIT_FIELDS"];
			?>

			<?if($_POST["is_ajax_post"] != "Y")
			{
				?>
					</div>
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
					<input type="hidden" name="json" value="Y">
					<a href="javascript:void();" <?/*?>onclick="submitForm('Y'); return false;"<?*/?> id="ORDER_CONFIRM_BUTTON" class="btn primary big fullwidth btn-checkout"><?=GetMessage("SOA_TEMPL_BUTTON")?></a>
				</form>
				<?
				if($arParams["DELIVERY_NO_AJAX"] == "N")
				{
					?>
					<div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
					<?
				}
			}
			else
			{
				?>
				<script type="text/javascript">
					top.BX('confirmorder').value = 'Y';
					top.BX('profile_change').value = 'N';
				</script>
				<?
				die();
			}
			echo '</div></div>';
		}
	}
	?>
</div>

<?if(CSaleLocation::isLocationProEnabled()):?>

	<div style="display: none">
		<?// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.steps", 
			".default", 
			array(
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.search", 
			".default", 
			array(
			),
			false
		);?>
	</div>

<?endif?>

<script type="text/javascript">
	$('body').on('change', '.select-synh input[type="radio"]', function(e){
	    var select = $(this).parents('.select-synh').attr('data-select');
	    if(($(window).outerWidth() > 992) || (!$('#'+select).hasClass('mobile-synh'))){
	        $('#'+select).val($(this).val());
	        $('#'+select).change();
	    }
	});

	$('body').on('click', '.dropdown-box', function(e){
	    $('.dropdown-box').not($(this)).removeClass('open');
	    $(this).toggleClass('open');
	    e.stopPropagation();
	});

	$('body').on('click', '.page', function(e){
	    $('.dropdown-box').removeClass('open');
	});
	// dropdown change
	$('body').on('click', '.dropdown-box .dropdown-item', function(e){
	    var value = $(this).find('[data-value-text]');
	    var box = $(this).parents('.dropdown-box');
	    $(this).attr('data-active', 'active').siblings().removeAttr('data-active');
	    box.find('.dropdown-value > .item-text').html(value.attr('data-value-text'));
	    e.stopPropagation();
	    box.removeClass('open');
	});

	$('.inputtext, input:not([type="submit"])').keyup(function(){
        if($(this).val().length > 0){
            $(this).addClass('dirty');
        } else {
            $(this).removeClass('dirty');
        }
    });

	$('body').on('keyup', '.inputtext, input:not([type="submit"])', function(e){
        if($(this).val().length > 0){
            $(this).addClass('dirty');
        } else {
            $(this).removeClass('dirty');
        }
    });


    $(document).ready(function(){
        var fl = new Array(
            "ORDER_PROP_1",
            "ORDER_PROP_2",
            "ORDER_PROP_3",
            "ORDER_PROP_4"
        );

        fl.forEach(function(item){
            $('*[name*='+item+']').addClass('required');
        });
        var error = false;
        var error_count = 0;
        $('body').on('change', 'input[type="text"].required, input[type="tel"]', function(){
            var val = $.trim($(this).val());

            /*inn kpp rs ks ogrn */
            if($(this).hasClass('numbers'))
            {
                error = checkEmptiness(val, $(this));
                if (error) {
                    error_count++;
                }
                else {
                    error = checkNumbers(val, $(this));
                    if (error) {
                        error_count++;
                    }
                }
            }
            else {
                error = checkEmptiness(val, $(this));
                if (error) {
                    error_count++;
                }
            }
        });

        $('body').on('change', 'input[type="email"]', function(){
            var val = $.trim($(this).val());
            error = checkEmptiness(val, $(this));
            if (error)
            {
                error_count++;
            }
            else {
                error = checkEmail(val, $(this));
                if (error) {
                    error_count++;
                }
            }
        });

        $('#ORDER_CONFIRM_BUTTON').click(function(){
            error_count = 0;
            $('input[type="email"].required, input[type="text"].required, input[type="tel"].required.numbers').change();
            if (error_count>0)
            {
                return false;
            }
            else
            {
                submitForm('Y');
            }
        })

    })
</script>