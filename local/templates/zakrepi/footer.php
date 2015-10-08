<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!--/div> <!-- /.workarea -->
</div><!-- /.workarea-wrapper -->
<div class="footer-wrapper">
    <!--subscribe-->
    <div class="subscribe-box">
        <div class="container row">
            <div class="sbscr-text col l6">Подпишись на новости, скидки и акции компании</div>
            <div class="sbscr-form col l6 no-padding">
                <div class="col l4">
                    <input type="email" class="inputtext" id="sbscr-field"/>
                    <label for="sbscr-field" class="textfield-placeholder">Введите свой email</label>
                </div>
                <div class="col l2">
                    <input type="submit" class="btn primary fullsize" value="Подписаться"/>
                </div>
            </div>
        </div>
    </div>
    <!--end subscribe-->
    <div class="footer container row">
        <!--footer company menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Компания</div>
            <ul class="menu vertical-menu">
                <li class="menu-item"><a class="menu-link" href="#">История компании</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Структура компании</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Новости компании</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Вакансии</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Франшиза</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Наши магазины</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Контакты</a></li>
            </ul>
        </div>
        <!--end footer company menu-->
        <!--footer buyer menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Покупателю</div>
            <ul class="menu vertical-menu">
                <li class="menu-item"><a class="menu-link" href="#">Акции</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Помощь в выборе товара</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Тест-драйв</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Сервисный центр</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Бренды</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Крепыж-бонус</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Подарочные сертификаты</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Центр поддержки пенсионеров-садоводов</a></li>
            </ul>
        </div>
        <!--end footer buyer menu-->
        <!--footer information menu-->
        <div class="footer-menu col l3">
            <div class="menu-title box-title">Информация</div>
            <ul class="menu vertical-menu">
                <li class="menu-item"><a class="menu-link" href="#">Оплата и доставка</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Гарантия и возврат</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Политика конфиденциальности</a></li>
                <li class="menu-item"><a class="menu-link" href="#">Договор-оферта</a></li>
            </ul>
        </div>
        <!--end footer information menu-->
        <div class="contact-box col l3">
            <!--footer phone-->
            <div class="phone-box">
                <div class="box-title">Обратная связь</div>
                <a href="callto:<?=$arZSettings['PHONE_CALLTO']?>" class="nostyle phone-link xbig-text"><?=$arZSettings['PHONE'];?></a><br/>
                <span class="small light-color small-text">Звонок по России бесплатный</span>
            </div>
            <!--end footer phone-->
            <!--mode-->
            <div class="schedule-box">
                <div class="box-title">Режим работы</div>
                <?/*<p>Будние дни: с 8:00 до 20:00</p>
                <p>Суббота: с 8:00 до 20:00</p>
                <p>Воскресенье: с 9:00 до 19:00</p>*/?>
                <?=$arZSettings['TIME_WORK'];?>
            </div>
            <!--end mode-->
            <!--social link-->
            <div class="soc-box">
                <ul class="soc-list horizontal">
                    <li class="soc-item"><a class="soc-link" href="#">fb</a></li>
                    <li class="soc-item"><a class="soc-link" href="#">vk</a></li>
                    <li class="soc-item"><a class="soc-link" href="#">ok</a></li>
                    <li class="soc-item"><a class="soc-link" href="#">yt</a></li>
                </ul>
            </div>
            <!--end social link-->
        </div>
    </div>
    <div class="bottombar">
        <div class="container row">
            <div class="col l6">© Крепыж, 2004 — <?=date('Y');?></div>
            <!--creator-->
            <div class="col l6 right-align"><a href="http://legacystudio.ru" class="img-link" target="_blank"><img src="images/logo-legacy.png" /></a></div>
            <!--end creator-->
        </div>
    </div>
</div>
</div> <!-- /.page -->
</div> <!-- /.layout -->
	</body>
</html>