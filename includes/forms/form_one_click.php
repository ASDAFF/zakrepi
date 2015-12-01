<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?$APPLICATION->IncludeComponent(
			"zakrepi:form.result.new",
			"form-one-click",
			Array(
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "N",
				"CHAIN_ITEM_LINK" => "",
				"CHAIN_ITEM_TEXT" => "",
				"COMPONENT_TEMPLATE" => ".default",
				"EDIT_URL" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"LIST_URL" => "result_list.php",
				"SEF_MODE" => "N",
				"SUCCESS_URL" => "",
				"USE_EXTENDED_ERRORS" => "N",
				"VARIABLE_ALIASES" => Array(
					"RESULT_ID" => "RESULT_ID",
					"WEB_FORM_ID" => "WEB_FORM_ID"
				),
				"WEB_FORM_ID" => "1",
				
				"NAME_PRODUCT" => $_COOKIE['PRODUCT_NAME'],

				"ROUTE" => 'form_one_click',
				"ROUTE_URL" => '/includes/forms/form_one_click.php'
				
			)
		);?>
		
		<script>
			   $("form#forms-form_one_click").submit(function (e) {
					$('#button-form_one_click').hide();
					$('#loader-form_one_click').show();
					$.ajax({
						 url: "/includes/forms/form_one_click.php?AJAX_REQUEST=Y",
						 data: $(this).serialize(),
						 type: 'POST',
						 success: function (data) {
							$('#loader-form_one_click').hide();
							$('#form_one_click').html(data);
						 },
						 error: function (data) {
							alert('Что то пошло не так попробуйте позже'+data);
						 }
					});
					e.preventDefault();
			   });
		</script>