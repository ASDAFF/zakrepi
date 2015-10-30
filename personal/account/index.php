<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>
    <?
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();

        /*address*/
        CModule::IncludeModule("useraddress");
        $default_address = CUserAddress::getAddressDefault($USER->GetID());
        $address = 'г. '.$default_address['CITY'].', ул. '.$default_address['STREET'].' '.$default_address['HOME'];
        if($default_address['HOUSING']!='')
            $address .= ', корп. '.$default_address['HOUSING'];
        if($default_address['FLAT']!='')
            $address .= ', кв. '.$default_address['FLAT'];
        /*end address*/
    ?>
    <h1 class="page-title">Личный кабинет</h1>
    <p class="page-note-text">Здравствуйте, <b><?=$USER->GetFullName()?></b>, добро пожаловать в Ваш личный кабинет!</p>
<?/*orders*/?>
<div class="base-card">
    ORDERS
</div>
<?/*end orders*/?>

<?/*personal*/?>
<div class="row h-boxes lk-boxes">
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Личные данные</div>
            <div class="card-content no-g-padding">
                <p class="medium-text"><?=$USER->GetFullName()?></p>
                <p><?=$arUser['EMAIL']?></p>
                <p><?=$arUser['PERSONAL_PHOTO']?></p>
            </div>
            <div class="link-box">
                <p><a href="/personal/account/update/">Изменить личные данные</a></p>
                <p><a href="/personal/account/password/">Изменить пароль</a></p>
            </div>
        </div>
    </div>
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Адресная книга</div>
            <div class="card-content no-g-padding">
                <p class="color-text text-light">Адрес по умолчанию</p>
                <p class="medium-text">
                    <?=$address?>
                </p>
            </div>
            <div class="link-box">
                <p><a href="/personal/address/update/?id=<?=$default_address['ID']?>">Изменить адрес по умолчанию</a></p>
                <p><a href="/personal/address/add/">Добавить новый адрес</a></p>
            </div>
        </div>
    </div>

    <?/*физ лицо*/?>
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Рассылка новостей</div>
            <div class="card-content no-g-padding">
                <p class="medium-text">Вы не подписаны ни на одну рассылку новостей</p>
            </div>
            <div class="link-box">
                <p><a href="#">Настроить рассылку</a></p>
            </div>
        </div>
    </div>
    <?/*end физ лицо*/?>
    <?/*юр лицо?>
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Ваш менеджер</div>
            <div class="card-content no-g-padding">
                <p class="medium-text">Екатерина Иванова</p>
                <p><a href="mailto:#">e.ivanova@zakrepi.ru</a></p>
                <p>+7 (922) 123-45-67</p>
            </div>
        </div>
    </div>
    <?/*end юр лицо*/?>
</div>
<?/*end personal*/?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>