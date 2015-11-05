<?if($USER->IsAuthorized()):?>
<div class="auth-box loged-in col l3">
    <div class="col l2 right">
        <a class="auth-link login" id="lk-menu-link" href="/personal/"><svg class="icon"><use xlink:href="#profile"/></svg> Личный кабинет</a>
        <div class="lk-menu tooltip" data-box="#lk-menu-link" data-position="bottom-center">
            <div class="tooltip-tngl"></div>
            <ul class="menu tooltip-content">
                <li class="menu-item"><a href="/personal/orders/" class="menu-link">Мои заказы</a></li>
                <li class="menu-item"><a href="/personal/account/" class="menu-link">Личные данные</a></li>
                <li class="menu-item"><a href="?logout=yes" class="menu-link">Выйти</a></li>
            </ul>
        </div>
    </div>
</div>
<?else:?>
<div class="auth-box col l3">
    <a class="auth-link login" href="/personal/"><svg class="icon"><use xlink:href="#profile"/></svg> Вход</a>
    <a class="auth-link register" href="/personal/registration/">Регистрация</a>
</div>
<?endif;?>

