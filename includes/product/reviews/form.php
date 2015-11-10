
<div class="container hide" id="reviews-form">
    <div class="hide" id="reviews-form-result">

    </div>

    <form method="POST" action="" id="add-reviews-form">
        <div class="loader-form hide">
            <div class="loader-center">
                <img src="/local/templates/zakrepi/images/svg/loader.svg" width="40"/>
            </div>
        </div>
        <div class="subtitle">Ваш отзыв о гайковерте Hitachi WR14VB-NA 420 Вт</div>
        <input type="hidden" name="CODE_PRODUCT" value="<?=$arResult['CODE']?>"/>
        <input type="hidden" name="NAME_PRODUCT" value="<?=$arResult['NAME']?>"/>
        <div class="row">
            <div class="col l6">
                <div class="table-field top-tf">
                    <div class="label">Имя</div>
                    <div class="field">
                        <input type="text" class="required" name="NAME"/>
                        <span class="error-text error-required error-pattern">Укажите свое имя</span>
                    </div>
                </div>
                <div class="table-field top-tf">
                    <div class="label">Электронная почта</div>
                    <div class="field">
                        <input type="email" class="required" id="emailregister" name="EMAIL"/>
                        <!-- 	.error-text - для всех ошибок,
                                .error-required, .error-pattern - можно задать разный текст для разных ошибок
                            -->
                        <span class="error-text error-required error-pattern">Укажите электронную почту в формате mymail@mail.ru</span>
                    </div>
                </div>
                <div class="table-field top-tf">
                    <div class="label">Рейтинг</div>
                    <div class="field rating-field">
                        <input class="hide rating-value" type="text" name="RATING" value="1"/>
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
                    <div class="field"><textarea NAME="BENEFITS"></textarea></div>
                </div>
                <div class="table-field top-tf">
                    <div class="label">Недостатки</div>
                    <div class="field"><textarea NAME="DISADVANTAGES"></textarea></div>
                </div>
                <div class="table-field top-tf">
                    <div class="label">Комментарий</div>
                    <div class="field"><textarea NAME="COMMENT"></textarea></div>
                </div>
                <div class="table-field action-box">
                    <div class="second-field cols-2">
                        <button class="btn standart-color btn-toggle-block" data-block="#reviews-form,#reviews-res">Отменить</button>
                        <button class="btn primary" onclick="ajax_form_request('reviews-form-result', 'add-reviews-form', '/includes/product/reviews/add_comment.php');return false;">Оставить отзыв</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            error_count = 0;
            $('body').on('change', 'input[type="email"].required', function(){
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
            $('body').on('change', 'input[type="text"].required, input[type="tel"]', function(){
                var val = $.trim($(this).val());


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
        });
    </script>
</div>